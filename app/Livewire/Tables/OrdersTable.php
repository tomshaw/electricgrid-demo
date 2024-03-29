<?php

namespace App\Livewire\Tables;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use TomShaw\ElectricGrid\Action;
use TomShaw\ElectricGrid\Column;
use TomShaw\ElectricGrid\Component;
use TomShaw\ElectricGrid\Filters\Filter;
use NumberFormatter;
use App\Enums\OrderStatus;

class OrdersTable extends Component
{
    public bool $showCheckbox = true;

    public bool $showPagination = true;

    public bool $showTableInfo = true;

    public bool $showPerPage = true;

    public bool $showToggleColumns = true;

    public array $searchTermColumns = ['user.name'];

    public array $letterSearchColumns = ['user.name'];

    protected function setup(): void
    {
    }

    public function builder(): Builder
    {
        return Order::with('user');
    }

    public function columns(): array
    {
        $numberFormat = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        return [
            Column::add('id', __('ID'))
                ->sortable()
                ->exportable()
                ->style('w-3'),

            Column::add('user.name', __('Customer'))
                ->searchable()
                ->sortable()
                ->exportable(),

            Column::add('status', __('Status'))
                ->callback(function (Model $model) {
                    return OrderStatus::from($model->status)->name();
                })
                ->sortable()
                ->exportable(),

            Column::add('total', __('Total'))
                ->callback(fn (Model $model) => $numberFormat->formatCurrency($model->total, 'USD'))
                ->searchable()
                ->sortable()
                ->exportable(),

            Column::add('invoiced', __('Invoiced'))
                ->callback(fn (Model $model) => $model->invoiced ? 'Yes' : 'No')
                ->sortable()
                ->exportable(),

            Column::add('order_time', __('Order Time'))
                ->sortable()
                ->exportable(),

            Column::add('order_date', __('Order Date'))
                ->sortable()
                ->exportable(),

            Column::add('created_at', __('Created At'))
                ->callback(fn (Model $model) => Carbon::parse($model->created_at)->format('F j, Y, g:i a'))
                ->sortable()
                ->exportable(),

            Column::add('', 'Actions')->callback(function (Model $model) {
                return view('livewire.tables.actions.orders', ['model' => $model]);
            })->actionable()->align('justify-center'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::number('id'),
            Filter::text('user.name'),
            Filter::select('status')->options(OrderStatus::toOptions()),
            Filter::number('total'),
            Filter::boolean('invoiced'),
            Filter::timepicker('order_time'),
            Filter::datepicker('order_date'),
            Filter::datetimepicker('created_at')->addDataAttribute('date-format', 'H:i'),
        ];
    }

    public function actions(): array
    {
        return [
            Action::make(OrderStatus::STATUS_NEW->name, 'Mark New')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::make(OrderStatus::STATUS_APPROVED->name, 'Mark Approved')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::make(OrderStatus::STATUS_COMPLETED->name, 'Mark Completed')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::make(OrderStatus::STATUS_CANCELLED->name, 'Mark Canceled')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::make(OrderStatus::STATUS_REMINDED->name, 'Send Reminder')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::make(OrderStatus::STATUS_PROCESSING->name, 'Mark Processing')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::make(OrderStatus::STATUS_SEEN->name, 'Mark Seen')
                ->group('Status Options')
                ->callback(fn ($status, $selected) => $this->updateStatusHandler($status, $selected)),

            Action::groupBy('Export Options', function () {
                return [
                    Action::make('csv', 'Export CSV')->export('SalesOrders.csv'),
                    Action::make('pdf', 'Export PDF')->export('SalesOrders.pdf'),
                    Action::make('html', 'Export HTML')->export('SalesOrders.html'),
                    Action::make('xlsx', 'Export XLSX')->export('SalesOrders.xlsx')->styles($this->exportStyles)->columnWidths($this->exportWidths),
                ];
            }),
        ];
    }

    public function getExportStylesProperty()
    {
        return [
            '1'  => ['font' => ['bold' => true]],
            'B2' => ['font' => ['italic' => true]],
            'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function getExportWidthsProperty()
    {
        return [
            'A' => 20,
            'B' => 30,
        ];
    }

    public function updateStatusHandler(string $optionName, array $selectedItems)
    {
        $status = OrderStatus::fromName($optionName);

        foreach ($selectedItems as $index => $modelId) {
            // event(new OrderStatusEvent($status->value, $modelId));
            // Order::where('id', $modelId)->update(['status' => $status->value]);
        }
    }
}
