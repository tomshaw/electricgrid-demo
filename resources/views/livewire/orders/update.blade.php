<?php

use function Livewire\Volt\{layout, mount, state};
use App\Enums\OrderStatus;
use App\Models\Order;
use Carbon\Carbon;

state([
  'order' => '',
  'status' => '',
  'options' => [],
]);

mount(function (Order $order) {
  $this->order = $order;
  $this->status = $order->status;
  $this->options = OrderStatus::toOptions();
});

$save = function () {

  $rules = [
    'status' => ['required', 'integer'],
  ];

  $validated = $this->validate($rules);

  $this->order->status = $validated['status'];

  $this->order->save();

  session()->flash('message', 'Order updated successfully!', 'success');
};

layout('layouts.app');
?>

<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    @include('livewire.flash.message')

    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <div class="max-w-xl">
        <section>

          <header>
            <h2 class="flex items-center text-lg font-medium text-gray-900 dark:text-gray-100">
              <span class="flex items-center text-gray-700 leading-none pr-3">
                <i class="fas fa-cog"></i>
              </span>
              <span class="flex items-center text-gray-700 leading-snug text-lg font-medium">
                {{$order->user->name}} &dash; {{OrderStatus::from($order->status)->name()}}
              </span>
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
              Order #{{$order->id}} placed on {{ Carbon::parse($order->created_at)->format('F j, Y, g:i a')}} &dash; {{Carbon::parse($order->created_at)->format('F j, Y, g:i a')}}.
            </p>
          </header>

          <form wire:submit="save" class="mt-6 space-y-6">

            <div>
              <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="roles">Order Status</label>
              <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="status" wire:model.live="status">
                @foreach($options as $key => $value)
                <option value="{{$key}}">{{ $value }}</option>
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