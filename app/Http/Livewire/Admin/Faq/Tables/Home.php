<?php

namespace App\Http\Livewire\Admin\Faq\Tables;

use App\Models\Faq;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
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
        return Faq::query();
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name');
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->index(),

            Column::add()
                ->title('Question')
                ->field('question')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Answer')
                ->field('answer')
                ->searchable()
                ->sortable()
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
                ->route('admin.faq.edit', ['id' => 'id']),

            Button::add('destroy')
                ->caption('Delete')
                ->class('bg-danger action-btn')
                ->dispatch('trigger-delete-modal', [
                    'id' => 'id',
                    'model' => Faq::class,
                    'title' => 'Are you sure?',
                    'message' => 'Are you sure you want to delete this Faq?'
                ]),
        ];
    }

    public function actionRules(): array
    {
        return [];
    }
}
