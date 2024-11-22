<nav class="fixed w-full bg-white/90 backdrop-blur-sm z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo e Nome -->
            <a href="{{ url('/') }}" class="flex items-center">
                <div class="flex items-center cursor-pointer" >
                    <!-- Substituí o ícone do GitHub por um SVG inline -->
                    <span class="ml-2 text-xl font-bold text-gray-900">Egbé Àyé - CRM</span>
                </div>
            </a>

            <!-- Links do Menu para telas grandes -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-4">
{{--                    <a href="" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Início</a>--}}
{{--                    <a href="" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Features</a>--}}
{{--                    <a href="" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Preço</a>--}}
                    <button wire:click="redirectToAdmin" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                        Entrar
                    </button>
                </div>
            </div>

            <!-- Botão para abrir/fechar menu em telas pequenas -->
            <div class="md:hidden">
                <button wire:click="toggleMenu" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 focus:outline-none">
                    @if($isOpen)
                        <!-- Ícone de fechar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L12 10.586l6.293-6.293a1 1 0 111.414 1.414L13.414 12l6.293 6.293a1 1 0 01-1.414 1.414L12 13.414l-6.293 6.293a1 1 0 01-1.414-1.414L10.586 12 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <!-- Ícone de menu -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 010 2H4a1 1 0 110-2zm0 6h16a1 1 0 010 2H4a1 1 0 110-2zm0 6h16a1 1 0 010 2H4a1 1 0 110-2z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </button>
            </div>
        </div>
    </div>

    <!-- Menu para telas pequenas -->
    @if($isOpen)
        <div class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white">
{{--                <a href="" class="block text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Início</a>--}}
{{--                <a href="" class="block text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Features</a>--}}
{{--                <a href="" class="block text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Preço</a>--}}
                <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                    Entrar
                </button>
            </div>
        </div>
    @endif
</nav>
