@auth
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="POST">
            @csrf
            <header class="flex items-center">
                <img class="rounded-full" src="https://i.pravatar.cc/40?u={{ Auth::user()->id }}" width="40" height="40" alt="">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-5">
                <textarea 
                    placeholder="Think of something to type..." 
                    class="w-full text-sm focus:outline-none focus:ring" 
                    name="body"
                    rows="5"
                    required></textarea>

                @error('body')
                    <span class="text-xs text-red">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6"> 
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a class="text-blue-500 hover:underline" href="/login">Log In to leave a comment.</a>
    </p>
@endauth