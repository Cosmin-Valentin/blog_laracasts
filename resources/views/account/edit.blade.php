<x-layout>
    <x-setting heading="Edit Your Account">
        <form action="/settings" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.input name="username" />
            <x-form.input name="avatar" type="file" />
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>