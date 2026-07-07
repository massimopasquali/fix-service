@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-8">Dashboard</h1>

        {{-- STATS --}}
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            @foreach([
                ['Piano attuale', auth()->user()->subscription?->stripe_price ?? 'Free'],
                ['Stato', auth()->user()->subscribed() ? '✅ Attivo' : 'Free'],
                ['Prossimo rinnovo', auth()->user()->subscription?->ends_at?->format('d/m/Y') ?? '-'],
                ['Utilizzo', '42%'],
            ] as [$label, $value])
                <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 hover:border-cyan-500/50 transition">
                    <div class="text-sm text-gray-500">{{ $label }}</div>
                    <div class="text-2xl font-bold text-white mt-2">{{ $value }}</div>
                </div>
            @endforeach
        </div>

        {{-- MAIN --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-gray-900 rounded-xl border border-gray-800 p-6">
                <h2 class="text-lg font-semibold text-white mb-4">Attività recente</h2>
                <div class="space-y-4">
                    @forelse($activities ?? [] as $activity)
                        <div class="flex items-center justify-between py-3 border-b border-gray-800 last:border-0">
                            <div>
                                <div class="font-medium text-white">{{ $activity['title'] }}</div>
                                <div class="text-sm text-gray-500">{{ $activity['date'] }}</div>
                            </div>
                            <span class="text-xs px-2 py-1 bg-cyan-500/20 text-cyan-400 rounded">{{ $activity['type'] }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Nessuna attività recente</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
                <h2 class="text-lg font-semibold text-white mb-4">Azioni rapide</h2>
                <div class="space-y-3">
                    <a href="{{ route('billing') }}" class="block w-full text-center bg-cyan-500 hover:bg-cyan-400 text-black font-medium py-2 rounded-lg transition">
                        Gestisci abbonamento
                    </a>
                    <a href="#" class="block w-full text-center bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-lg transition">
                        Scarica fatture
                    </a>
                    <a href="#" class="block w-full text-center bg-gray-800 hover:bg-gray-700 text-white py-2 rounded-lg transition">
                        Aggiorna metodo
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
