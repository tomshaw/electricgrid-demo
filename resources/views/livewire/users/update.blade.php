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
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <div class="max-w-xl">
        <section>
          <header>
            <h2 class="flex items-center text-lg font-medium text-gray-900 dark:text-gray-100">
              <span class="flex items-center text-gray-700 leading-none pr-3">
                <i class="fas fa-cog"></i>
              </span>
              <span class="flex items-center text-gray-700 leading-snug text-lg font-medium">
                {{$user->name}}
              </span>
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
              Update customer profile and account information.
            </p>
          </header>

          <form wire:submit="save" class="mt-6 space-y-6">

            <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="name">Name</label>
              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" wire:model="name" id="name" name="name" type="text" required="required" autofocus="autofocus" autocomplete="name">
            </div>

            <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">Email</label>
              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" wire:model="email" id="email" name="email" type="email" required="required" autocomplete="username">
            </div>

            <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="password">Password</label>
              <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" wire:model="password" id="password" name="password" type="password">
            </div>

            <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="roles">Roles</label>
              <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="roles" wire:model="roles" multiple>
                @foreach($options as $key => $value)
                <option value="{{$value}}">{{ ucfirst($value) }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex items-center gap-4">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Save</button>
            </div>

          </form>

        </section>
      </div>
    </div>
  </div>
</div>