<div x-data="documentUpload()">
    <form wire:submit.prevent="uploadDocument">
        @csrf
        <div class="flex flex-wrap -mx-3 gap-4 lg:gap-0">
            <div class="w-full max-w-full px-3 mt-0 flex-1">
                <div x-show="!fileUrl" x-transition:enter.duration.500ms class="flex items-center justify-center w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer dark:bg-slate-850 dark:hover:bg-slate-900 dark:border-slate-700">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik
                                    untuk
                                    upload</span> atau seret dan lepas</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PDF</p>
                        </div>
                        <input @change="previewPdf" wire:model="file" id="dropzone-file" type="file"
                            class="hidden" />
                    </label>
                </div>
                <div x-show="fileUrl" x-transition:enter.duration.500ms class="pdf-preview mb-4">
                    <iframe :src="fileUrl" type="application/pdf" width="100%" class="h-[80vh]"></iframe>
                </div>
            </div>

            {{-- tampilkan ketika file sudah di load --}}
            <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none" x-show="fileUrl"
                x-transition:enter.duration.500ms>
                <div
                    class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    {{-- <div class="p-4 pb-0 rounded-t-4 flex">
                        <h6 class="mb-0 dark:text-white" x-text="title"></h6>
                        <span class="text-sm font-bold mt-1 flex-1">.pdf</span>
                    </div> --}}
                    <div class="flex-auto p-4">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            <li
                                class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                                        <i class="text-white fas fa-user relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Judul
                                        </h6>
                                        {{-- <span class="text-xs leading-tight dark:text-white/80" x-text="title"></span> --}}

                                        <textarea name="title" id="title" x-model="title" @input="updateMetadata"
                                            class="outline-none border-slate-500 bg-transparent rounded-sm w-56 text-sm" autofocus></textarea>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                                        <i class="text-white fas fa-user relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Penulis
                                        </h6>
                                        {{-- <span class="text-xs leading-tight dark:text-white/80" x-text="author"></span> --}}

                                        <input type="text" name="author" id="author" x-model="author"
                                            autocomplete="false" @input="updateMetadata" row="0"
                                            class="outline-none border-slate-500 bg-transparent rounded-sm w-56 text-sm" />

                                    </div>
                                </div>
                            </li>
                            <li
                                class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-b-lg rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                                        <i class="text-white fas fa-file relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Halaman
                                        </h6>
                                        <span class="text-xs leading-tight dark:text-white/80" x-text="pages"></span>
                                        <input type="hidden" name="pages" x-model="pages">
                                    </div>
                                </div>
                            </li>
                            <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                                        <i class="text-white fas fa-save relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Ukuran
                                        </h6>
                                        <span class="text-xs leading-tight dark:text-white/80" x-text="size"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        @if (session('success'))
                            <x-ui.alert-box status="success" :message="session('success')" />
                        @endif
                        @if (session('error'))
                            <x-ui.alert-box status="error" :message="session('error')" />
                        @endif

                        <button type="submit" wire:loading.attr="disabled" wire:target="file, uploadDocument"
                            class="mt-3 w-full block px-3 py-3 mr-3 font-bold text-center text-white align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl 
                        from-blue-500 to-violet-500 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 hover:-translate-y-px 
                        active:opacity-85 hover:shadow-md disabled:opacity-40 disabled:cursor-wait">
                            <div wire:loading.class="!hidden" wire:target="uploadDocument">
                                <i class="fas fa-upload mr-1"></i>
                                <span>Submit</span>
                            </div>

                            <div role="status" class="hidden" wire:loading.class="!block" wire:target="uploadDocument">
                                <svg aria-hidden="true"
                                    class="inline w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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


                        </button>

                        <button type="button" @click="cancel"
                            class="mt-3 w-full block px-3 py-3 mr-3 font-bold text-center text-white align-middle transition-all rounded-lg cursor-pointer bg-slate-700 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 hover:-translate-y-px 
                        active:opacity-85 hover:shadow-md">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
<script>
    function documentUpload() {
        return {
            file: null,
            fileUrl: null,
            title: @entangle('title'),
            author: @entangle('author'),
            pages: @entangle('pages'),
            size: null,

            async previewPdf(e) {
                const file = e.target.files[0]

                if (file && file.type === 'application/pdf') {
                    const arrayBuffer = await file.arrayBuffer();
                    const document = await PDFLib.PDFDocument.load(arrayBuffer);

                    this.file = document;
                    this.fileUrl = URL.createObjectURL(file);
                    this.title = document.getTitle()?.split('.')[0] || file.name?.split('.')[0] || 'Unknown';
                    this.size = `${(file.size / (1024 * 1024)).toFixed(2)} MB`;
                    this.author = document.getAuthor() || 'Unkonwn';
                    this.pages = document.getPages().length;

                } else {
                    alert("Please upload a valid PDF file.");
                    this.pdfFile = null;
                    this.pdfURL = null;
                }
            },

            updateMetadata(e) {
                const metadata = e.target.name;
                const value = e.target.value;

                this[metadata] = value;
            },

            cancel() {
                this.file = null
                this.fileUrl = null
                this.title = null
                this.author = null
                this.pages = null
                this.size = null
            }
        }
    }
</script>
