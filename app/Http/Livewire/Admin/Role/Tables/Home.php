<?php

namespace App\Http\Livewire\Admin\Role\Tables;

use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class Home extends PowerGridComponent
{
    use ActionButton;

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
        return Role::query();
    }

   
    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('permissions_formatted', function(Role $model){
                return implode(", ", $model->permissions->pluck('name')->toArray());
            });
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->index(),

            Column::add()
                ->title('Name')
                ->field('name')
                ->searchable()
                // ->makeInputText('name')
                ->sortable(),

            Column::add()
                ->title('Permissions')
                ->field('permissions_formatted')
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
               ->route('admin.role.edit', ['id' => 'id']),

           Button::add('destroy')
               ->caption('Delete')
               ->class('bg-danger action-btn')
               ->dispatch('trigger-delete-modal', [
                'id' => 'id', 
                'model' => Role::class,
                'title' => 'Are you sure?',
                'message' => 'Are you sure you want to delete this Role?'
            ]),
        ];
    }

    public function actionRules(): array
    {
        return [
            // Rule::button('edit')
            // ->when(fn() => auth()->user()->cannot('manage_employee'))
            // ->hide(),

            // Rule::button('destroy')
            // ->when(fn() => auth()->user()->cannot('manage_employee'))
            // ->hide(),
        ];
    }
    

}
