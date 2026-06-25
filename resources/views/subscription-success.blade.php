@extends('layouts.app')

@section('title', 'Pagamento riuscito')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-12">
            <div class="w-20 h-20 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-green-500/30">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Pagamento completato! 🎉</h1>
            <p class="text-gray-400 mb-8">
                Il tuo abbonamento è stato attivato con successo.<br>
                Riceverai una conferma via email.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-cyan-500 hover:bg-cyan-400 text-black font-medium px-6 py-3 rounded-lg transition">
                    Vai alla Dashboard
                </a>
                <a href="{{ route('billing') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition">
                    Gestisci abbonamento
                </a>
            </div>
        </div>
    </div>
@endsection
