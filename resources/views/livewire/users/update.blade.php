<?php

use function Livewire\Volt\{layout, mount, state};
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

state([
  'user' => '',
  'name' => '',
  'email' => '',
  'password' => '',

  'options' => [],
  'roles' => [],
]);

mount(function (User $user) {
  $this->user = $user;
  $this->name = $user->name;
  $this->email = $user->email;

  $this->roles = $user->roles->pluck('name');
  $this->options = Role::all()->pluck('name');
});

$save = function () {

  $rules = [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
  ];

  if ($this->password) {
    $rules['password'] = ['required', 'string', Password::defaults()];
  }

  $validated = $this->validate($rules);

  $this->user->fill($validated);

  if ($this->user->isDirty('email')) {
    $this->user->email_verified_at = null;
  }

  $this->user->syncRoles($this->roles);

  $this->user->save();

  $this->password = '';

  session()->flash('message', 'User updated successfully!', 'success');
};

layout('layouts.app');
?>

<div class="py-12">
  <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <section>

        <header>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Users Information
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Here you can see all the users information.
          </p>
        </header>

        <div class="mt-6 space-y-6">
          <div class="card">

            <form wire:submit="save">

              <div class="card-header">
                <div class="card-title">
                  <div class="flex items-center">
                    <span class="flexed items-center text-gray-500 leading-none pr-3 hidden">
                      <i class="la la-gear"></i>
                    </span>
                    <h3 class="flex items-center text-gray-700 leading-snug text-lg font-medium">
                      {{$user->name}}
                    </h3>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="mb-4">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" class="form-control" wire:model="name" id="name" required="required" autofocus="autofocus">
                  @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control" wire:model="email" id="email" required="required">
                  @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" class="form-control" wire:model="password" id="password">
                  @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                  <label class="form-label" for="roles">Roles</label>
                  <select class="form-control" id="roles" wire:model="roles" multiple>
                    @foreach($options as $key => $value)
                    <option value="{{$value}}">{{ ucfirst($value) }}</option>
                    @endforeach
                  </select>
                  @error('roles')<div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>@enderror
                </div>


              </div>

              <div class="card-footer">
                <div class="flex items-center justify-between">
                  <button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="btn btn-success btn-rounded">
                    <span wire:loading wire:target="save">Updating...</span>
                    <span wire:loading.remove wire:target="save">Submit</span>
                  </button>
                </div>
              </div>

            </form>

          </div>
        </div>

      </section>
    </div>
  </div>
</div>