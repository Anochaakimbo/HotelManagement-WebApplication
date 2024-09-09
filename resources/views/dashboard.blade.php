<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
                <h1>Your Room</h1>
@if (Auth::user()->room)
    <p>Room Name: {{ Auth::user()->room->room_number }}</p>
@else
    <p>You do not have any rooms assigned.</p>
@endif
            </div>
        </div>
    </div>
</x-app-layout>
