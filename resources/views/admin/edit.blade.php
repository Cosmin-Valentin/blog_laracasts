<x-layout>
    <x-setting :heading="'Edit Post: '. $post->title">
        <form x-data="{ message: '{{$post->status}}' }" action="/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="old('title', $post->title)" />
            <x-form.input name="slug" :value="old('slug', $post->slug)" />
            <x-form.input name="thumbnail" type="file" required="" :value="old('thumbnail', $post->thumbnail)" />
            <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>
            <div class="mb-6">
                <x-form.label name="category" />
                <select name="category_id" id="category">
                    @php
                        $categories = \App\Models\Category::all()
                    @endphp
                    @foreach ($categories as $category)
                        <option 
                            value="{{$category->id}}" 
                            {{old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>
                                {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="category" />
            </div>
            <div class="mb-6">
                <x-form.label name="author" />
                <select name="user_id" id="author">
                    @php
                        $authors = \App\Models\User::all()
                    @endphp
                    @foreach ($authors as $author)
                        <option 
                            value="{{$author->id}}" 
                            {{old('user_id', $post->user_id) == $author->id ? 'selected' : ''}}>
                                {{ ucwords($author->name) }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="author" />
            </div>
            <x-form.button>Update</x-form.button>
            <input type="hidden" name="status" x-model="message">
            @if ($post->status === 'draft')
                <x-form.publish />
            @endif
        </form>
    </x-setting>
</x-layout>