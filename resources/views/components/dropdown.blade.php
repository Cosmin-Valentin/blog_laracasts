@props(['trigger'])

<div x-data="{ show: false }" class="py-2 relative" @click.away="show = false">
    {{-- Trigger --}}
    <div @click="show = ! show">
        {{ $trigger }}
    </div>

    <div x-show="show" class="absolute bg-gray-100 w-full mt-2 rounded-xl overflow-auto max-h-52"  style="display: none">
        {{-- Links --}}
        {{ $slot }}
    </div>
</div>