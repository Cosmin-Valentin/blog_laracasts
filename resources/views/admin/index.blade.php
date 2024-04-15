<x-layout>
    <x-setting heading="Manage Posts">
        <div class="flex flex-col justify-center h-full">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Customers</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach ($posts as $post)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium text-gray-800">
                                            <a href="/posts/{{$post->slug}}" class="text-blue-500 hover:text-blue-600">
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full {{ $post->status !== 'draft' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $post->status }}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap text-right">
                                        <a href="/admin/posts/{{$post->id}}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>
                                    <td class="p-2 whitespace-nowrap text-right">
                                        <form action="/admin/posts/{{$post->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-400 hover:text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>