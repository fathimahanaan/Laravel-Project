<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($vacancies as $vacancy)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    {{ $vacancy->title }}
                </h2>

                <p class="pt-4 italic">
                    Categories:
                    @forelse ($vacancy->categories as $category)
                    {{ $category->topic }} @if(!$loop->last),@endif
                    @empty
                    <span>No Categories defined for this Vacancy</span>
                    @endforelse
                </p>

                <p class="mt-2">
                    {{ Str::limit($vacancy->body, 50) }}
                </p>

                @foreach ($comments as $comment)
                    @if ($comment->commentable_id == $vacancy->id)
                    <p class="mt-1 p-2">{{ Str::limit($comment->body, 10) }}</p>
                    @endif
                @endforeach

                <span class="block mt-4 text-sm opacity-70">{{ $vacancy->updated_at->diffForHumans() }}</span>
            </div>
        @empty
            <p>You have no notes yet.</p>
        @endforelse

        {{ $vacancies->links() }}
        </div>
    </div>
</x-app-layout>
