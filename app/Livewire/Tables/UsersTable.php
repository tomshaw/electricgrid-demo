<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use TomShaw\ElectricGrid\Action;
use TomShaw\ElectricGrid\Column;
use TomShaw\ElectricGrid\Component;
use TomShaw\ElectricGrid\Filters\Filter;
use Spatie\Permission\Models\Role;

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
        return User::with(['roles', 'profile']);
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
                ->callback(function (Model $model) {
                    return view('livewire.tables.users-customer', ['model' => $model]);
                })
                ->searchable()
                ->sortable()
                ->exportable(false),

            Column::add('profile.billing_address_line_1', 'Address')
                ->callback(function (Model $model) {
                    return ($model->profile ? $model->profile->billing_address_line_1 : null);
                })
                ->searchable()
                ->sortable()
                ->exportable(),

            Column::add('roles.id', 'Roles')
                ->callback(function (Model $model) {
                    return $model->roles->pluck('name')->map(function ($name) {
                        return ucfirst($name);
                    })->implode(', ');
                })
                ->sortable()
                ->exportable(),

            Column::add('roles.name', 'Role Name')
                ->callback(function (Model $model) {
                    return $model->roles->pluck('name')->map(function ($name) {
                        return ucfirst($name);
                    })->implode(', ');
                })
                ->sortable()
                ->exportable()
                ->visible(false),

            Column::add('profile.newsletter', 'Newsletter')
                ->callback(function (Model $model) {
                    return ($model->profile ? ($model->profile->newsletter ? 'Yes' : 'No') : null);
                })
                ->searchable()
                ->sortable()
                ->exportable(),

            Column::add('profile.profile_time', __('Profile Time'))
                ->callback(fn (Model $model) => Carbon::parse($model->profile->profile_time)->format('g:i a'))
                ->searchable()
                ->sortable()
                ->exportable()
                ->visible(false),

            Column::add('profile.profile_date', __('Profile Date'))
                ->callback(fn (Model $model) => Carbon::parse($model->profile->profile_date)->format('m-d-Y'))
                ->searchable()
                ->sortable()
                ->exportable()
                ->visible(false),

            Column::add('profile.created_at', 'Created At')
                ->callback(fn (Model $model) => Carbon::parse($model->profile->created_at)->format('F j, Y, g:i a'))
                ->sortable()
                ->exportable(),

            Column::add('updated_at', 'Updated At')
                ->callback(fn (Model $model) => Carbon::parse($model->updated_at)->format('F j, Y, g:i a'))
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
            Filter::text('profile.billing_address_line_1'),
            Filter::multiselect('roles.id')->options($this->roles),
            Filter::text('roles.name'),
            Filter::boolean('profile.newsletter')->labels('Yes', 'No'),
            Filter::timepicker('profile.profile_time'),
            Filter::datepicker('profile.profile_date'),
            Filter::datetimepicker('profile.created_at'),
            Filter::datetimepicker('updated_at'),
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

    public function getRolesProperty()
    {
        return Role::pluck('name', 'id')->toArray();
    }
}
