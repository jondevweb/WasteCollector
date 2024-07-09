<x-layout>
    <x-slot:title>
        Custom Title
    </x-slot>
 
    @foreach ($tasks as $task)
        {{ $task }}
    @endforeach
</x-layout>