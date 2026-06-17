@extends('layouts.app')
@section('title', 'Stato riparazione')

@section('content')
    <section class="max-w-3xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-4">Controlla lo stato della tua riparazione</h1>
        <p class="text-gray-400 mb-8">Inserisci il codice ticket che ti è stato fornito al momento della consegna del dispositivo.</p>

        <form method="GET" action="{{ route('repair.status') }}" class="flex gap-3 mb-10">
            <input type="text" name="ticket" value="{{ request('ticket') }}"
                   placeholder="Es. FD-2026-0001"
                   class="flex-1 px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:border-red-500 focus:outline-none">
            <button type="submit" class="px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700">
                Cerca
            </button>
        </form>

        @if(request('ticket'))
            @if($repair)
                <div class="p-6 bg-gray-900 rounded-xl border border-gray-800">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-bold">Ticket {{ $repair->ticket_code }}</h2>
                            <p class="text-gray-400">{{ $repair->device_brand }} - {{ $repair->device_type }}</p>
                        </div>
                        @php
                            $statusColors = [
                                'received' => 'bg-yellow-500/20 text-yellow-400',
                                'in_progress' => 'bg-blue-500/20 text-blue-400',
                                'completed' => 'bg-green-500/20 text-green-400',
                                'delivered' => 'bg-gray-500/20 text-gray-400',
                            ];
                            $statusLabels = [
                                'received' => 'Ricevuto',
                                'in_progress' => 'In lavorazione',
                                'completed' => 'Completato',
                                'delivered' => 'Consegnato',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$repair->status] ?? 'bg-gray-700' }}">
                        {{ $statusLabels[$repair->status] ?? $repair->status }}
                    </span>
                    </div>
                    @if($repair->notes)
                        <p class="text-gray-300 mt-4">{{ $repair->notes }}</p>
                    @endif
                </div>
            @else
                <div class="p-6 bg-red-900/20 border border-red-800 rounded-xl text-red-300">
                    Nessun ticket trovato con il codice inserito.
                </div>
            @endif
        @endif
    </section>
@endsection
