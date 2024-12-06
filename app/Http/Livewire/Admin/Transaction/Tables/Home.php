<?php

namespace App\Http\Livewire\Admin\Transaction\Tables;

use App\Models\Transaction;
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

    public $status, $user_id, $remark;

    public function setUp(): array
    {
        $this->showCheckBox();

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
                ])
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return Transaction::query()
            ->join("users", "users.id", "transactions.user_id")
            ->latest()
            ->when($this->status != 'all', function ($q) {
                $q->where('status', $this->status);
            })
            ->when($this->remark, function ($q) {
                $q->where('remark', $this->remark);
            })
            ->when($this->user_id, function ($q) {
                $q->where('user_id', $this->user_id);
            })
            ->selectRaw("transactions.*, users.first_name");
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('formatted_date', function (Transaction $model) {
                return $model->created_at->setTimezone('America/New_York')->format("d M, Y h:i A");
            })
            ->addColumn('amount_formatted', function (Transaction $model) {
                return ac() . number_format($model->amount, 2);
            })
            ->addColumn('status_formatted', function (Transaction $model) {
                if ($model->status === "pending") {
                    return "<span class='bg-info text-white btn btn-xs'>Pending</span>";
                } else if ($model->status === "failed") {
                    return "<span class='bg-danger text-white btn btn-xs'>Failed</span>";
                } else if ($model->status === "cancelled") {
                    return "<span class='bg-warning text-white btn btn-xs'>Cancelled</span>";
                } else if ($model->status === "completed") {
                    return "<span class='bg-success text-white btn btn-xs'>Completed</span>";
                } else {
                    return "<span class='bg-primary text-white btn btn-xs'>{$model->status}</span>";
                }
            })
            ->addColumn('customer_information', function (Transaction $model) {
                $link = route("admin.user.show", ['id' => $model->user->id]);
                return "<a href='$link'><strong>{$model->user->fullname}</strong><br />
                        <span>{$model->user->email}</span></a>";
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
                ->title('Transaction Date')
                ->field('formatted_date', 'created_at')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Transaction ID')
                ->field('trx')
                ->searchable()
                // ->makeInputText('id')
                ->sortable(),

            Column::add()
                ->title('Customer Information')
                ->field('customer_information', 'first_name')
                ->searchable()
                ->visibleInExport(visible: false)
                ->sortable(),

            Column::add()
                ->title('Customer Information')
                ->field('first_name')
                ->visibleInExport(visible: true),



            Column::add()
                ->title('Amount')
                ->field('amount_formatted', 'amount')
                ->searchable()
                ->sortable(),


            // Column::add()
            //     ->title('Price')
            //     ->field('price')
            //     ->searchable()
            //     ->sortable(),


            Column::add()
                ->title('Quantity')
                ->field('quantity')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Ip Address')
                ->field('ip_address')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Timezone')
                ->field('timezone')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Status')
                ->field('status_formatted', 'status')
                ->searchable()
                ->visibleInExport(visible: false)
                ->sortable(),

            Column::add()
                ->title('Status')
                ->field('status')
                ->searchable()
                ->visibleInExport(visible: true)
                ->sortable(),

            Column::add()
                ->title('Remark')
                ->field('remark')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title('Transaction Details')
                ->field('details')
                ->searchable()
                ->sortable(),


        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('amount'),
            Filter::inputText('charge'),
            Filter::inputText('status'),
            Filter::inputText('trx'),
            Filter::inputText('ip_address'),
            Filter::inputText('timezone'),
            Filter::inputText('first_name'),
            Filter::inputText('remark'),
            Filter::datetimepicker('created_at')
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
                ->caption("View Transaction Details")
                ->class('bg-indigo-500 action-btn')
                ->route('admin.transaction.show', ['id' => 'id']),

            Button::add('destroy')
                ->caption('Delete')
                ->class('bg-danger action-btn')
                ->dispatch('trigger-delete-modal', [
                    'id' => 'id',
                    'model' => Transaction::class,
                    'title' => 'Are you sure?',
                    'message' => 'Are you sure you want to delete this Transaction?'
                ]),
        ];
    }

    public function actionRules(): array
    {
        return [
            // Rule::button('show')
            //     ->when(fn ($model) => in_array($model->remark, [']))
            //     ->hide(),

            Rule::button('destroy')
                ->when(fn() => auth()->user()->cannot('delete_orders'))
                ->hide(),
        ];
    }
}
