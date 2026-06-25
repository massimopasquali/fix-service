@extends('layouts.app')

@section('title', 'Controlla Riparazione')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-16">

        {{-- HEADER --}}
        <div class="text-center mb-12">
            <div class="flex justify-center mb-6">
                <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97s-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1s.03.66.07 1l-2.11 1.63c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.58 1.69-.98l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.63z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Controlla <span class="text-red-500">riparazione</span>
            </h1>
            <p class="text-lg text-gray-400">
                Inserisci il codice della tua riparazione per verificare lo stato
            </p>
        </div>

        {{-- SEARCH FORM --}}
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8 mb-8">
            <form action="{{ route('repair-status.check') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Codice riparazione</label>
                    <input type="text" name="repair_code" value="{{ old('repair_code') }}"
                           placeholder="Es: REP-2026-001234" required
                           class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-lg text-white placeholder-gray-600 focus:ring-2 focus:ring-red-500 focus:border-transparent text-lg">
                </div>
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-lg transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Controlla stato
                </button>
            </form>
        </div>

        {{-- STATUS RESULT (se presente) --}}
        @if(isset($repair))
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white">Stato riparazione</h2>
                    <span class="px-4 py-2
                    @if($repair['status'] === 'completata') bg-green-500/20 text-green-400 border-green-500/30
                    @elseif($repair['status'] === 'in corso') bg-yellow-500/20 text-yellow-400 border-yellow-500/30
                    @else bg-blue-500/20 text-blue-400 border-blue-500/30
                    @endif
                    text-sm font-medium rounded-full border">
                    {{ strtoupper($repair['status']) }}
                </span>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="flex justify-between py-3 border-b border-gray-800">
                        <span class="text-gray-400">Codice</span>
                        <span class="text-white font-medium">{{ $repair['code'] }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-800">
                        <span class="text-gray-400">Dispositivo</span>
                        <span class="text-white font-medium">{{ $repair['device'] }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-800">
                        <span class="text-gray-400">Problema</span>
                        <span class="text-white font-medium">{{ $repair['issue'] }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-800">
                        <span class="text-gray-400">Data consegna prevista</span>
                        <span class="text-white font-medium">{{ $repair['estimated_date'] }}</span>
                    </div>
                </div>

                {{-- PROGRESS BAR --}}
                <div class="mb-6">
                    <div class="flex justify-between text-sm text-gray-400 mb-2">
                        <span>Progresso</span>
                        <span>{{ $repair['progress'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-800 rounded-full h-3">
                        <div class="bg-red-500 h-3 rounded-full transition-all duration-500"
                             style="width: {{ $repair['progress'] }}%"></div>
                    </div>
                </div>

                {{-- TIMELINE --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white mb-4">Storico aggiornamenti</h3>
                    @foreach($repair['timeline'] as $event)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-2 h-2 bg-red-500 rounded-full mt-2"></div>
                            <div class="flex-grow">
                                <div class="text-white font-medium">{{ $event['title'] }}</div>
                                <div class="text-sm text-gray-500">{{ $event['date'] }}</div>
                                @if(isset($event['description']))
                                    <div class="text-sm text-gray-400 mt-1">{{ $event['description'] }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($repair['status'] === 'completata')
                    <div class="mt-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                        <p class="text-green-400 text-center">
                            ✅ La tua riparazione è completata! Puoi passare a ritirare il dispositivo.
                        </p>
                    </div>
                @endif
            </div>
        @endif

        {{-- INFO SECTION --}}
        <div class="grid md:grid-cols-3 gap-6 mt-12">
            @foreach([
                ['📍', 'Dove siamo', 'Via della Tecnologia 123, Milano'],
                ['📞', 'Contattaci', '+39 02 1234567'],
                ['📧', 'Scrivici', 'info@fix-device.it'],
            ] as [$icon, $title, $desc])
                <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 text-center">
                    <div class="text-3xl mb-2">{{ $icon }}</div>
                    <h3 class="text-lg font-semibold text-white mb-1">{{ $title }}</h3>
                    <p class="text-gray-400 text-sm">{{ $desc }}</p>
                </div>
            @endforeach
        </div>

    </div>
@endsection
