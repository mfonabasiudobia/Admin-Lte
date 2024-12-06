<?php

namespace App\Http\Livewire\Admin\Employee\Tables;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class Home extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public $is_deleted = false;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return User::query()
            ->whereHas('roles', function ($query) {
                $query->whereNotIn('name', ['normal']);
            })
            ->when($this->is_deleted == true, function ($q) {
                $q->onlyTrashed();
            });
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('role_formatted', function (User $model) {
                return $model->roles[0]->name ?? 'No Role';
            });
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('SNO')
                ->field('id')
                ->index(),

            Column::add()
                ->title('First Name')
                ->field('first_name')
                ->searchable()
                // ->makeInputText('first_name')
                ->sortable(),

            Column::add()
                ->title('Last Name')
                ->field('last_name')
                ->searchable()
                // ->makeInputText('first_name')
                ->sortable(),


            Column::add()
                ->title('Email')
                ->field('email')
                ->searchable()
                // ->makeInputText('email')
                ->sortable(),

            Column::add()
                ->title('Mobile Number')
                ->field('mobile_number')
                ->searchable()
                // ->makeInputText('email')
                ->sortable(),

            Column::add()
                ->title('Wallet Balance')
                ->field('wallet_balance')
                ->searchable()
                // ->makeInputText('email')
                ->sortable(),

            Column::add()
                ->title('Role')
                ->field('role_formatted')
        ];
    }


    public function filters(): array
    {
        return [
            Filter::inputText('fullname'),
            Filter::inputText('mobile_number'),
            Filter::inputText('email'),
            Filter::inputText('wallet_balance'),
            Filter::datepicker('created_at'),
            Filter::inputText('referral_code'),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */


    public function actions(): array
    {
        return [
            Button::add('edit')
                ->caption("Edit")
                ->class('bg-indigo-500 action-btn')
                ->route('admin.employee.edit', ['id' => 'id']),

            Button::add('destroy')
                ->caption('Delete')
                ->class('bg-danger action-btn')
                ->dispatch('trigger-delete-modal', [
                    'id' => 'id',
                    'model' => User::class,
                    'title' => 'Are you sure?',
                    'message' => 'Are you sure you want to delete this User?'
                ]),

            Button::add('restore')
                ->caption('Restore User')
                ->class('bg-indigo-500 action-btn')
                ->dispatch('trigger-restore-modal', [
                    'id' => 'id',
                    'model' => User::class,
                    'title' => 'Are you sure?',
                    'message' => 'Are you sure you want to restore this User?'
                ]),

            Button::add('force_delete')
                ->caption('Permanently delete')
                ->class('bg-danger action-btn')
                ->dispatch('trigger-force-delete-modal', [
                    'id' => 'id',
                    'model' => User::class,
                    'title' => 'Are you sure?',
                    'message' => 'Are you sure you want to permanently delete this User?'
                ]),
        ];
    }

    public function actionRules(): array
    {
        return [
            Rule::button('edit')
                ->when(fn($data) => auth()->user()->cannot('manage_employee') || $data->deleted_at)
                ->hide(),

            Rule::button('destroy')
                ->when(fn($data) => auth()->user()->cannot('manage_employee') || $data->deleted_at)
                ->hide(),


            Rule::button('restore')
                ->when(fn($data) => auth()->user()->cannot('manage_employee') || !$data->deleted_at)
                ->hide(),

            Rule::button('force_delete')
                ->when(fn($data) => auth()->user()->cannot('manage_employee') || !$data->deleted_at)
                ->hide(),

        ];
    }
}
