<x-layout>

    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            @foreach ($posts as $post)
                <x-post-card 
                    :post="$post" 
                    class="col-span-6"
                />
            @endforeach
        @else
            <p class="text-center">No bookmarks yet.</p>
        @endif
    </main>

</x-layout>