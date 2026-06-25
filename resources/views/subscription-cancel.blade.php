@extends('layouts.app')

@section('title', 'Pagamento annullato')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-12">
            <div class="w-20 h-20 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-yellow-500/30">
                <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Pagamento annullato</h1>
            <p class="text-gray-400 mb-8">
                Il pagamento non è stato completato. Nessun addebito è stato effettuato.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('pricing') }}" class="bg-cyan-500 hover:bg-cyan-400 text-black font-medium px-6 py-3 rounded-lg transition">
                    Riprova
                </a>
                <a href="/" class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition">
                    Torna alla home
                </a>
            </div>
        </div>
    </div>
@endsection
