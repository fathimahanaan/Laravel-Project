<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex">
                <p class="opacity-70 sm:px-6">
                    <strong>Created: </strong> {{ $vacancy->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $vacancy->updated_at->diffForHumans() }}
                </p>
                <a href="{{route('vacancies.edit', $vacancy) }}" class="btn-link ml-auto">Edit Vacancy</a>
                <form action="{{ route('vacancies.destroy', $vacancy) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to move this to trash?')">Move to Trash</button>
   </form>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $vacancy->title }}
                </h2>
                <p class="mt-6 whitespace-pre-wrap">{{ $vacancy->body }}</p>
                <div class="mt-2">
                    <img src="{{ $vacancy->image_path }}" alt="image url: {{ $vacancy->image_path }}">
                </div>
            </div>
            <livewire:comments :model="$vacancy"/>
        </div>
    </div>
</x-app-layout>
