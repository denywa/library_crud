<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Librarian Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-4">
                        <a href="{{ route('books.index') }}" class="text-blue-500 hover:underline">Manage Books</a>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('journals.index') }}" class="text-blue-500 hover:underline">Manage Journals</a>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('newspapers.index') }}" class="text-blue-500 hover:underline">Manage Newspapers</a>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('cds.index') }}" class="text-blue-500 hover:underline">Manage CDs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
