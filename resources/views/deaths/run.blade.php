<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Death Counter - version 1.0
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <p class="text-4xl m-4">Dark Souls 3 - Run #{{ $run->run }}</p>
                <hr>
                <div class="flex justify-center">
                <table class="table-fixed w-5/6 m-4">
                    <thead>
                        <tr>
                            <th class="w-1/2 px-4 py-2">Boss</th>
                            <th class="w-1/4 px-4 py-2">Deaths</th>
                            <th class="w-1/4 px-4 py-2">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deaths as $death)
                        <form action="/save-deaths" method="POST">
                            @csrf
                            <input type="hidden" name="death_id" value="{{ $death->id }}">
                            <input type="hidden" name="run_id" value="{{ $run->id }}">
                            <input type="hidden" name="boss_id" value="{{ $death->boss->id }}">
                            <tr>
                                <td class="border px-4 py-2">
                                    <p class="text-xl">{{ $death->boss->name }}</p>
                                    <p class="text-lg text-gray-500">Boss #{{ $death->boss->order }}</p>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex items-center border-b border-teal-500 py-2 mb-2">
                                        <input class="appearance-none bg-transparent border-none w-auto text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="deaths" name="death_count" value="{{ $death->death_count }}" aria-label="Deaths">
                                    </div>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex flex-col items-center">
                                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="10" name="notes">{{ $death->notes }}</textarea>
                                    </div>
                                </td>
                                <td>
                                    <button class="bg-green-400 hover:bg-green-200 text-gray-800 font-bold m-3 py-2 px-4" type="submit">
                                        Save
                                    </button>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
