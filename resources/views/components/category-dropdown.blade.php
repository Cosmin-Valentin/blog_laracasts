<x-dropdown>
    <x-slot name="trigger">
        <button 
            class="py-2 pl-3 pr-9 text-left text-sm font-semibold w-full lg:w-32 z-50 inline-flex">
            {{ isset($currentCategory) ? $currentCategory->name : 'Categories' }}
            <x-down-arrow class="absolute pointer-events-none"/>
        </button>
    </x-slot>

    <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" :active="request()->routeIs('home')">
        All
    </x-dropdown-item>
    
    @foreach ($categories as $category)
        <x-dropdown-item 
            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
            :active="request()->is('categories/' . $category->slug)"
        >{{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>