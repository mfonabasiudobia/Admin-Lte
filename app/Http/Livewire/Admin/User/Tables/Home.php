<?php

namespace App\Http\Livewire\Admin\User\Tables;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class Home extends PowerGridComponent
{
    use ActionButton, WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */

    public $is_deleted = false, $blocked = false;

    public $join_waitlist;

    public bool $deferLoading = true;

    public int $perPage = 30;

    //Custom per page values
    public array $perPageValues = [0, 5, 50, 100, 150, 200, 300];

    public string $loadingComponent = 'components.inline-loading';

    public function setUp(): array
    {
        $this->persist(['columns', 'filters']);

        // $this->showCheckBox();

        // $this->persist(
        //     tableItems: ['columns', 'filters', 'sort'],
        //     prefix: auth()->id()
        // );

        return [
            Exportable::make('export')
                ->striped()
                ->columnWidth([
                    2 => 30,
                    3 => 30,
                    4 => 30,
                    5 => 30,
                    6 => 30,
                    7 => 30,
                    8 => 30,
                    9 => 30,
                    10 => 30,
                    11 => 30,
                    12 => 30,
                    13 => 30,
                    14 => 30,
                    15 => 30,
                ])
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSoftDeletes()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }


    public function datasource(): ?Builder
    {
        return User::latest()
            ->when($this->is_deleted == true, function ($q) {
                $q->onlyTrashed();
            })
            ->when($this->blocked == true, function ($q) {
                $q->where("account_status", "blocked");
            })
            ->role('normal');
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('total_transactions_formatted', function ($q) {
                return  number_format($q->transactions()->count());
            })
            ->addColumn('total_cards_formatted', function ($q) {
                return  number_format($q->cards()->count());
            })
            ->addColumn('total_spend_formatted', function ($q) {
                return  ac() . number_format($q->transactions()->completed()->sum('amount'));
            })
            ->addColumn('created_at_formatted', function ($q) {
                // return $q->createdAt();
                return $q->created_at->setTimezone('America/New_York')->format("d M, Y h:i A");
            })
            ->addColumn('id');
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
                // ->makeInputText('email')
                ->sortable(),

            Column::add()
                ->title('Last Name')
                ->field('last_name')
                ->searchable()
                // ->makeInputText('email')
                ->sortable(),

            Column::add()
                ->title('Email')
                ->field('email')
                ->searchable()
                // ->makeInputText('email')
                ->sortable(),

            Column::add()
                ->title('Total Transactions')
                ->field('total_transactions_formatted'),

            Column::add()
                ->title('Cards Created')
                ->field('total_cards_formatted'),

            Column::add()
                ->title('Total Spend')
                ->field('total_spend_formatted'),

            Column::add()
                ->title('Date Joined')
                ->field('created_at_formatted', 'created_at')
                ->searchable()
                // ->makeInputText('referral_code')
                ->sortable()
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('first_name'),
            Filter::inputText('mobile_number'),
            Filter::inputText('last_name'),
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
            Button::add('show')
                ->caption("Show")
                ->class('bg-indigo-500 action-btn')
                ->route('admin.user.show', ['id' => 'id']),

            Button::add('edit')
                ->caption("Edit")
                ->class('bg-indigo-500 action-btn')
                ->route('admin.user.edit', ['id' => 'id']),

            Button::add('destroy')
                ->caption('Delete')
                ->class('bg-danger action-btn')
                ->dispatch('trigger-delete-modal', [
                    'id' => 'id',
                    'model' => User::class,
                    'title' => 'Are you sure?',
                    'message' => 'Are you sure you want to temporary delete this User?'
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
                ->when(fn($data) => auth()->user()->cannot('edit_user') || $data->deleted_at)
                ->hide(),

            Rule::button('destroy')
                ->when(fn($data) => auth()->user()->cannot('delete_user') || $data->deleted_at)
                ->hide(),

            Rule::button('show')
                ->when(fn($data) => auth()->user()->cannot('view_user') || $data->deleted_at)
                ->hide(),

            Rule::button('restore')
                ->when(fn($data) => auth()->user()->cannot('delete_user') || !$data->deleted_at)
                ->hide(),

            Rule::button('force_delete')
                ->when(fn($data) => auth()->user()->cannot('delete_user') || !$data->deleted_at)
                ->hide(),


        ];
    }
}
