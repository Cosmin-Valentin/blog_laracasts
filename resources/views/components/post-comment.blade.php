@props(['comment'])
<x-panel class="bg-gray-50">
    <article class="space-x-4 flex">
        <div class="flex-shrink-0">
            <img class="rounded-xl" src="https://i.pravatar.cc/60?u={{$comment->user_id}}" width="60" height="60" alt="">
        </div>
        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>
    
                <p class="text-xs">Posted 
                    <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
                </p>
            </header>
            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
    @auth
        @if ($comment->user_id === auth()->user()->id)
            <form action="/comments/{{$comment->id}}" method="post" class="flex justify-end">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-red-500">Delete</button>
            </form>
        @endif
    @endauth
</x-panel>
