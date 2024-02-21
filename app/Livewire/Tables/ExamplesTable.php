<?php

namespace App\Livewire\Tables;

use App\Models\Example;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use TomShaw\ElectricGrid\Column;
use TomShaw\ElectricGrid\Component;
use Carbon\Carbon;

class ExamplesTable extends Component
{
    public bool $showCheckbox = false;

    public function builder(): Builder
    {
        return Example::query();
    }

    public function columns(): array
    {
        return [
            Column::add('id', 'ID')->style('text-center')->align('justify-center'),
            Column::add('title', 'Title'),
            Column::add('description', 'Description'),
            Column::add('created_at', __('Created At'))->callback(fn (Model $model) => Carbon::parse($model->created_at)->format('F j, Y, g:i a')),
            Column::add('updated_at', __('Updated At'))->callback(fn (Model $model) => Carbon::parse($model->updated_at)->format('F j, Y, g:i a')),
            Column::add('', 'Actions')->callback(function (Model $model) {
                return view('livewire.tables.actions.examples', ['model' => $model]);
            })->actionable()->align('justify-center'),
        ];
    }
}
