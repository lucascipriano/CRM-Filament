<nav class="fixed w-full bg-white/90 backdrop-blur-sm z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo e Nome -->
            <div class="flex items-center">
                <!-- Substituí o ícone do GitHub por um SVG inline -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 5.303 3.438 9.8 8.205 11.387.6.113.82-.26.82-.577 0-.285-.01-1.04-.015-2.04-3.338.725-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.757-1.333-1.757-1.09-.745.083-.73.083-.73 1.204.084 1.838 1.235 1.838 1.235 1.07 1.834 2.809 1.304 3.495.997.108-.775.418-1.305.76-1.605-2.665-.304-5.466-1.333-5.466-5.93 0-1.31.468-2.38 1.235-3.22-.123-.303-.535-1.524.117-3.176 0 0 1.007-.322 3.3 1.23a11.497 11.497 0 013.003-.404c1.018.005 2.045.137 3.003.404 2.29-1.552 3.295-1.23 3.295-1.23.655 1.653.243 2.874.12 3.176.77.84 1.235 1.91 1.235 3.22 0 4.61-2.807 5.625-5.482 5.922.429.37.823 1.103.823 2.222 0 1.604-.015 2.896-.015 3.292 0 .32.216.694.825.577C20.565 21.796 24 17.3 24 12 24 5.373 18.627 0 12 0z" />
                </svg>
                <span class="ml-2 text-xl font-bold text-gray-900">CRMav</span>
            </div>

            <!-- Links do Menu para telas grandes -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-4">
                    <a href="" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Início</a>
                    <a href="" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Features</a>
                    <a href="" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Preço</a>
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
                <a href="" class="block text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Início</a>
                <a href="" class="block text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Features</a>
                <a href="" class="block text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Preço</a>
                <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                    Entrar
                </button>
            </div>
        </div>
    @endif
</nav>
