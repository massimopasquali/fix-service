@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                    La piattaforma per <span class="text-red-500">riparatori professionisti</span>
                </h1>
                <p class="mt-6 text-lg text-gray-400">
                    Fix-Device.it permette a più aziende di gestire riparazioni di smartphone, tablet, PC e dispositivi elettronici in un unico posto. Traccia ticket, gestisci clienti e rinnova il tuo abbonamento in pochi click.
                </p>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                        Inizia gratis
                    </a>
                    <a href="{{ route('repair.status') }}" class="px-6 py-3 border border-gray-700 rounded-lg font-semibold hover:bg-gray-800 transition">
                        Controlla riparazione
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square bg-gradient-to-br from-red-900/40 to-gray-900 rounded-2xl border border-gray-800 flex items-center justify-center">
                    <svg class="w-48 h-48 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="bg-gray-900/50 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Perché scegliere Fix-Device</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $features = [
                        ['title' => 'Multi-azienda', 'desc' => 'Ogni riparatore ha il proprio spazio isolato con i propri dati e clienti.'],
                        ['title' => 'Tracking ticket', 'desc' => 'I clienti possono controllare lo stato della riparazione in tempo reale.'],
                        ['title' => 'Abbonamenti flessibili', 'desc' => 'Piani mensili o annuali gestiti tramite Stripe, cancellabili in qualsiasi momento.'],
                    ];
                @endphp
                @foreach($features as $f)
                    <div class="p-6 bg-gray-900 rounded-xl border border-gray-800 hover:border-red-500/50 transition">
                        <h3 class="text-xl font-semibold mb-2">{{ $f['title'] }}</h3>
                        <p class="text-gray-400">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4">Pronto a digitalizzare la tua officina?</h2>
            <p class="text-gray-400 mb-8">Unisciti a centinaia di riparatori che usano Fix-Device ogni giorno.</p>
            <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                Crea il tuo account
            </a>
        </div>
    </section>
@endsection
