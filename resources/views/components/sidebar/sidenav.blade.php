 <!-- sidenav  -->
 <aside
     class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-hidden antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0 ps"
     aria-expanded="false">
     <div class="h-19">
         <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
             sidenav-close="" aria-hidden="true"></i>
         <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
             href="{{ config('app.url') }}">
             <img src="{{ asset('assets/img/logo-ct-dark.png') }}"
                 class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                 alt="main_logo">
             <img src="{{ asset('assets/img/logo-ct.png') }}"
                 class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                 alt="main_logo">
             <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">{{ config('app.name') }}</span>
         </a>
     </div>

     <hr
         class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent">

     <div class="items-center block w-auto max-h-screen overflow-auto h-[80vh] grow basis-full ps ps--active-y">
         <div class="mx-4">
             <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"
                 sidenav-card="">
                 <img class="w-1/2 mx-auto h-1/2 rounded-full object-cover object-center shadow-sm"
                     src="{{ asset('assets/img/bruce-mars.jpg') }}" alt="sidebar illustrations">
                 <div class="flex-auto w-full p-4 pt-0 text-center">
                     <div class="transition-all duration-200 ease-nav-brand">
                         <h6 class="mb-1 mt-2 dark:text-white text-slate-700 capitalize">
                             {{ Auth::user()->name ?? 'Name' }}</h6>
                         <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                             {{ Auth::user()->role ?? 'Role' }}
                         </p>
                     </div>
                 </div>
             </div>

             <form action="{{ route('auth.logout') }}" method="POST">
                 @csrf
                 <button type="submit"
                     class="inline-block w-full px-8 py-2 mb-4 text-xs font-bold leading-normal text-center text-white capitalize transition-all 
                         ease-in rounded-lg shadow-md bg-slate-700 bg-150 hover:shadow-xs hover:-translate-y-px">Logout</button>
             </form>

         </div>

         <hr
             class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent">

         <ul class="flex flex-col pl-0 mb-0">

             <x-sidebar.sidenav-link :active="request()->is('/')" icon="fas fa-tv text-blue-500"
                 href="/">Dashboard</x-sidebar.sidenav-link>

             <x-sidebar.sidenav-link :active="request()->is('plagiarism')" icon="fas fa-edit text-orange-500"
                 href="{{ route('plagiarism.index') }}">Plagiarism</x-sidebar.sidenav-link>

         </ul>
     </div>


 </aside>
