<div class="flex items-center space-x-4">
  <div class="overflow-hidden w-[40px]">
    <img src="{{ $model->user->gravatar }}" alt="{{$model->name}}" class="object-cover w-full h-full">
  </div>
  <div class="flex flex-col space-y-1">
    <a href="{{ route('orders.update', $model) }}" class="text-gray-600 font-semibold">{{$model->user->name}}</a>
    <span class="text-gray-600">{{ $model->user->email }}</span>
  </div>
</div>