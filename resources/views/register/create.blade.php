<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl mb-10">Register</h1>
                <form action="/register" method="POST">
                    @csrf
                    <x-form.input name="name" />
                    <x-form.input name="username" />
                    <x-form.input name="email" type="email" />
                    <x-form.input name="password" type="password" />
                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>