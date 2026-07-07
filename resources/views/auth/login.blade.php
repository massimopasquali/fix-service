@extends('layouts.app')

@section('title', 'Accedi')

@section('content')
    <div class="max-w-md mx-auto px-4 py-12">
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8">

            {{-- LOGO --}}
            <div class="flex justify-center mb-6">
                <svg class="w-12 h-12 text-cyan-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97s-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1s.03.66.07 1l-2.11 1.63c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.58 1.69-.98l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.63z"/>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-center text-white mb-6">Accedi a fix-device</h1>

            @if($errors->any())
                <div class="bg-red-900/30 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-4">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 bg-gray-950 border border-gray-800 rounded-lg text-white focus:ring-2 focus:ring-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 bg-gray-950 border border-gray-800 rounded-lg text-white focus:ring-2 focus:ring-cyan-500">
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-gray-400">
                        <input type="checkbox" name="remember" class="mr-2 bg-gray-950 border-gray-700">
                        Ricordami
                    </label>
                    <a href="#" class="text-cyan-400 hover:text-cyan-300">Password dimenticata?</a>
                </div>
                <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-black font-bold py-2 rounded-lg transition">
                    Accedi
                </button>
            </form>

            <p class="text-center text-sm text-gray-400 mt-6">
                Non hai un account? <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300">Registrati</a>
            </p>
        </div>
    </div>
@endsection
