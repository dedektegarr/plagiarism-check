<div>
    @if (session('success'))
        <div class="mx-6 p-4 rounded-md border border-green-400 bg-green-400/20">
            <p class="text-sm text-green-400 mb-0">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="mx-6 p-4 rounded-md border invalid-input bg-red-400/20">
            <p class="text-sm text-red-400 mb-0">{{ session('error') }}</p>
        </div>
    @endif
    <div class="flex-auto p-6">
        <form role="form text-left" wire:submit.prevent="authenticate">
            @csrf
            <div class="mb-4">
                <input type="text" wire:model="username"
                    class="@error('username') invalid-input @enderror uppercase placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                    placeholder="NIP / NPM" aria-label="username" aria-describedby="username-addon">
                @error('username')
                    <span class="text-sm text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <input type="password" wire:model="password"
                    class="@error('password') invalid-input @enderror placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                    placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                @error('password')
                    <span class="text-sm text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <div role="status" class="hidden" wire:loading.class="!block">
                    <svg aria-hidden="true"
                        class="inline w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                    class="inline-block w-full px-5 py-2.5 mt-6 mb-2 font-bold text-center text-white align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:-translate-y-px hover:shadow-xs leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                    Login</button>
            </div>
            <p class="mt-4 mb-0 leading-normal text-sm">Belum punya akun? <a href="/register"
                    class="font-bold text-slate-700">Register</a></p>
        </form>
    </div>
</div>
