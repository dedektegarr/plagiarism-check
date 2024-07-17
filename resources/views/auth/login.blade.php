<x-layouts.auth>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container min-h-screen flex items-center justify-center">
        <div class="flex flex-wrap w-full">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                <div
                    class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                        <h5>Login</h5>
                    </div>

                    <livewire:auth.login-form />
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
