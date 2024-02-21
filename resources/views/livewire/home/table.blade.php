<?php

use function Livewire\Volt\layout;
use function Livewire\Volt\mount;
use Illuminate\Support\Facades\Auth;

mount(function () {
  if (!Auth::check()) {
    return redirect()->route('login');
  }
});

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
          <livewire:tables.examples-table />
        </div>

      </section>
    </div>
  </div>
</div>