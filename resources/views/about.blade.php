@extends('layouts.app')

@section('title', 'Chi Siamo')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-16">

        {{-- HEADER --}}
        <div class="text-center mb-16">
            <div class="flex justify-center mb-6">
                <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97s-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1s.03.66.07 1l-2.11 1.63c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.58 1.69-.98l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.63z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Chi <span class="text-red-500">siamo</span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                Siamo un team di esperti dedicati alla riparazione e manutenzione dei tuoi dispositivi
            </p>
        </div>

        {{-- MISSION --}}
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8 mb-12">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">La nostra missione</h2>
                    <p class="text-gray-300 mb-4">
                        In fix-device crediamo che la tecnologia debba essere accessibile e duratura.
                        Offriamo servizi di riparazione professionali con trasparenza e qualità garantita.
                    </p>
                    <p class="text-gray-400">
                        Con oltre 10 anni di esperienza nel settore, abbiamo riparato migliaia di dispositivi
                        soddisfando le esigenze di clienti privati e aziende.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-950 rounded-xl p-6 text-center border border-gray-800">
                        <div class="text-3xl font-bold text-red-500 mb-2">10K+</div>
                        <div class="text-sm text-gray-400">Dispositivi riparati</div>
                    </div>
                    <div class="bg-gray-950 rounded-xl p-6 text-center border border-gray-800">
                        <div class="text-3xl font-bold text-red-500 mb-2">98%</div>
                        <div class="text-sm text-gray-400">Clienti soddisfatti</div>
                    </div>
                    <div class="bg-gray-950 rounded-xl p-6 text-center border border-gray-800">
                        <div class="text-3xl font-bold text-red-500 mb-2">24h</div>
                        <div class="text-sm text-gray-400">Tempo medio riparazione</div>
                    </div>
                    <div class="bg-gray-950 rounded-xl p-6 text-center border border-gray-800">
                        <div class="text-3xl font-bold text-red-500 mb-2">2 anni</div>
                        <div class="text-sm text-gray-400">Garanzia</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TEAM --}}
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-white text-center mb-8">Il nostro team</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach([
                    ['Marco Rossi', 'Fondatore & CEO', 'Esperto in gestione aziendale con 15 anni di esperienza nel settore tech.'],
                    ['Laura Bianchi', 'Responsabile Tecnico', 'Tecnico certificato con specializzazione in riparazioni hardware avanzate.'],
                    ['Giuseppe Verdi', 'Customer Care', 'Dedicato a garantire la migliore esperienza cliente e supporto post-vendita.'],
                ] as [$name, $role, $desc])
                    <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 text-center hover:border-red-500/50 transition">
                        <div class="w-20 h-20 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/30">
                            <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-1">{{ $name }}</h3>
                        <p class="text-red-500 text-sm mb-3">{{ $role }}</p>
                        <p class="text-gray-400 text-sm">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- VALUES --}}
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8">
            <h2 class="text-2xl font-bold text-white text-center mb-8">I nostri valori</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach([
                    ['🔧', 'Qualità', 'Utilizziamo solo componenti originali e tecniche di riparazione certificate.'],
                    ['⚡', 'Velocità', 'Tempi di riparazione rapidi senza compromettere la qualità del lavoro.'],
                    ['🤝', 'Trasparenza', 'Preventivi chiari e comunicazione costante sullo stato della riparazione.'],
                ] as [$icon, $title, $desc])
                    <div class="text-center">
                        <div class="text-4xl mb-3">{{ $icon }}</div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ $title }}</h3>
                        <p class="text-gray-400 text-sm">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12">
            <h2 class="text-2xl font-bold text-white mb-4">Pronto a riparare il tuo dispositivo?</h2>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('pricing') }}" class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-lg transition">
                    Vedi i nostri piani
                </a>
                <a href="{{ route('repair-status') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition">
                    Controlla riparazione
                </a>
            </div>
        </div>

    </div>
@endsection
