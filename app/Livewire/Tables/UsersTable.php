<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use TomShaw\ElectricGrid\Action;
use TomShaw\ElectricGrid\Column;
use TomShaw\ElectricGrid\Component;
use TomShaw\ElectricGrid\Filters\Filter;

class UsersTable extends Component
{
    public bool $showCheckbox = true;

    public bool $showPagination = true;

    public bool $showPerPage = true;

    public bool $showToggleColumns = true;

    public array $searchTermColumns = ['name'];

    public array $letterSearchColumns = ['name'];

    public function builder(): Builder
    {
        return User::with('roles');
    }

    protected function setup(): void
    {
        $this->addInlineAction('Update', 'users.update', ['user' => 'id']);
    }

    public function columns(): array
    {
        return [
            Column::add('id', 'ID')
                ->sortable()
                ->stylable('text-start w-4')
                ->exportable(),

            Column::add('name', 'Customer')
                ->searchable()
                ->sortable()
                ->exportable(),

            Column::add('roles.id', 'Roles')
                ->callback(function (User $user) {
                    return $user->roles->pluck('name')->map(function ($name) {
                        return ucfirst($name);
                    })->implode(', ');
                })
                ->sortable()
                ->exportable(),

            Column::add('created_at', 'Created At')
                ->callback(fn (User $user) => Carbon::parse($user->created_at)->format('F j, Y, g:i a'))
                ->sortable()
                ->exportable(),

            Column::add('updated_at', 'Updated At')
                ->callback(fn (User $user) => Carbon::parse($user->updated_at)->format('F j, Y, g:i a'))
                ->sortable()
                ->exportable()
                ->visible(false),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::number('id'),
            Filter::text('name'),
            Filter::multiselect('roles.id')->options([1 => 'Admin', 2 => 'Member']),
            Filter::datepicker('created_at'),
        ];
    }

    public function actions(): array
    {
        return [
            Action::groupBy('Export Options', function () {
                return [
                    Action::make('csv', 'Export CSV')->export('UsersTable.csv'),
                    Action::make('pdf', 'Export PDF')->export('UsersTable.pdf'),
                    Action::make('html', 'Export HTML')->export('UsersTable.html'),
                    Action::make('xlsx', 'Export XLSX')->export('UsersTable.xlsx'),
                ];
            }),
        ];
    }
}
