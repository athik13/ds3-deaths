<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Death Counter - version 1.0
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <p class="text-4xl m-4">Dark Souls 3</p>
                <hr>
                @foreach ($runs as $run)
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-3 rounded" onclick="window.location.href = '/death-counter/{{ $run->id }}'">
                        Run #{{ $run->run }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>