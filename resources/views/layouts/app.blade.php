<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'App') - Fix-Device</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-black min-h-screen flex flex-col text-white">

{{-- ============================================= --}}
{{-- NAVBAR                                        --}}
{{-- ============================================= --}}
<nav class="bg-gray-950 border-b border-gray-800 sticky top-0 z-50 backdrop-blur-sm bg-opacity-90">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LOGO + MENU DESKTOP --}}
            <div class="flex items-center space-x-8">

                {{-- LOGO INGRANAGGIO ROSSO --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <svg class="w-8 h-8 text-red-500 group-hover:rotate-45 transition-transform duration-500"
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97s-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1s.03.66.07 1l-2.11 1.63c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.58 1.69-.98l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.63z"/>
                    </svg>
                    <span class="text-xl font-bold text-white">
                            fix<span class="text-red-500">-device</span>
                        </span>
                </a>

                {{-- MENU PRINCIPALE (DESKTOP) --}}
                <div class="hidden lg:flex items-center space-x-1">

                    {{-- Link pubblici --}}
                    <a href="{{ route('home') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('home') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                        Home
                    </a>

                    <a href="{{ route('about') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('about', 'about.index') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                        Chi siamo
                    </a>

                    <a href="{{ route('pricing') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('pricing') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                        Prezzi
                    </a>

                    <a href="{{ route('repair-status') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('repair-status') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                        Stato riparazione
                    </a>

                    {{-- Divider --}}
                    @auth
                        <div class="w-px h-6 bg-gray-800 mx-2"></div>

                        {{-- Link autenticati --}}
                        <a href="{{ route('dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                      {{ request()->routeIs('dashboard') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('subscription.show') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                      {{ request()->routeIs('subscription.*') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                            Abbonamento
                        </a>
                    @endauth
                </div>
            </div>

            {{-- AREA DESTRA: AUTH + MOBILE TOGGLE --}}
            <div class="flex items-center space-x-3">

                {{-- UTENTE LOGGATO (DROPDOWN) --}}
                @auth
                    <div class="relative hidden md:block" x-data="{ open: false }" x-cloak>
                        <button @click="open = !open"
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-900 transition">
                            <div class="w-8 h-8 bg-red-500/20 border border-red-500/30 rounded-full flex items-center justify-center">
                                    <span class="text-red-500 font-bold text-sm">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                            </div>
                            <span class="text-sm text-gray-300">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown menu --}}
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-56 bg-gray-900 border border-gray-800 rounded-xl shadow-2xl py-2 z-50">

                            <div class="px-4 py-3 border-b border-gray-800">
                                <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>

                            <a href="{{ route('dashboard') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-red-500 transition">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>

                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-red-500 transition">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profilo
                            </a>

                            <a href="{{ route('subscription.show') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-red-500 transition">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Abbonamento
                            </a>

                            <div class="border-t border-gray-800 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 transition">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Esci
                                </button>
                            </form>
                        </div>
                    </div>

                @else
                    {{-- UTENTE NON LOGGATO --}}
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-sm text-gray-300 hover:text-red-500 transition">
                            Accedi
                        </a>
                        <a href="{{ route('registration.create') }}"
                           class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition">
                            Registra azienda
                        </a>
                    </div>
                @endauth

                {{-- HAMBURGER MOBILE --}}
                <button id="mobile-menu-btn"
                        class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-gray-900 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path id="menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- MENU MOBILE                                   --}}
    {{-- ============================================= --}}
    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-800 bg-gray-950">
        <div class="px-4 py-4 space-y-1">

            {{-- Link pubblici --}}
            <a href="{{ route('home') }}"
               class="block px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('home') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                🏠 Home
            </a>
            <a href="{{ route('about') }}"
               class="block px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('about', 'about.index') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                🔧 Chi siamo
            </a>
            <a href="{{ route('pricing') }}"
               class="block px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('pricing') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                💰 Prezzi
            </a>
            <a href="{{ route('repair-status') }}"
               class="block px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('repair-status') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                📡 Stato riparazione
            </a>

            @auth
                <div class="border-t border-gray-800 my-2"></div>
                <div class="px-3 py-2 text-xs text-gray-500 uppercase tracking-wider">Area riservata</div>

                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                              {{ request()->routeIs('dashboard') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                              {{ request()->routeIs('profile.*') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                    👤 Profilo
                </a>
                <a href="{{ route('subscription.show') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                              {{ request()->routeIs('subscription.*') ? 'text-red-500 bg-red-500/10' : 'text-gray-300 hover:text-red-500 hover:bg-gray-900' }}">
                    💳 Abbonamento
                </a>

                <div class="border-t border-gray-800 my-2"></div>

                <div class="px-3 py-2">
                    <div class="text-sm text-white font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10 transition">
                        🚪 Esci
                    </button>
                </form>
            @else
                <div class="border-t border-gray-800 my-2"></div>
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-red-500 hover:bg-gray-900">
                    Accedi
                </a>
                <a href="{{ route('registration.create') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium bg-red-500 hover:bg-red-600 text-white text-center">
                    Registra azienda
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- ============================================= --}}
{{-- FLASH MESSAGES                                --}}
{{-- ============================================= --}}
@if(session('success'))
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="bg-green-900/30 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg">
            ✅ {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="bg-red-900/30 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg">
            ❌ {{ session('error') }}
        </div>
    </div>
@endif

{{-- ============================================= --}}
{{-- CONTENT                                       --}}
{{-- ============================================= --}}
<main class="flex-grow">
    @yield('content')
</main>

{{-- ============================================= --}}
{{-- FOOTER                                        --}}
{{-- ============================================= --}}
<footer class="bg-gray-950 border-t border-gray-800 py-10 mt-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 mb-8">

            {{-- BRAND --}}
            <div class="md:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 mb-4">
                    <svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97s-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1s.03.66.07 1l-2.11 1.63c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.58 1.69-.98l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.63z"/>
                    </svg>
                    <span class="text-lg font-bold text-white">
                            fix<span class="text-red-500">-device</span>
                        </span>
                </a>
                <p class="text-gray-400 text-sm max-w-md">
                    Riparazione professionale di dispositivi elettronici.
                    Qualità, velocità e trasparenza al tuo servizio.
                </p>
            </div>

            {{-- NAVIGAZIONE --}}
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Navigazione</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-red-500 transition">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-red-500 transition">Chi siamo</a></li>
                    <li><a href="{{ route('pricing') }}" class="text-gray-400 hover:text-red-500 transition">Prezzi</a></li>
                    <li><a href="{{ route('repair-status') }}" class="text-gray-400 hover:text-red-500 transition">Stato riparazione</a></li>
                </ul>
            </div>

            {{-- LEGALE --}}
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Legale</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('legal.terms') }}" class="text-gray-400 hover:text-red-500 transition">Condizioni di utilizzo</a></li>
                    <li><a href="{{ route('legal.privacy') }}" class="text-gray-400 hover:text-red-500 transition">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <div>© {{ date('Y') }} fix-device. Tutti i diritti riservati.</div>
            <div class="mt-2 md:mt-0">P.IVA 00000000000</div>
        </div>
    </div>
</footer>

{{-- ============================================= --}}
{{-- SCRIPTS                                       --}}
{{-- ============================================= --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    // Toggle menu mobile
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
