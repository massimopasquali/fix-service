@extends('layouts.app')

@section('title', 'Gestione Abbonamento')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-8">Gestione Abbonamento</h1>

        @if(auth()->user()->subscribed())

            {{-- ACTIVE SUBSCRIPTION --}}
            <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-white">Il tuo abbonamento</h2>
                    <span class="px-3 py-1 bg-green-500/20 text-green-400 text-xs rounded-full font-medium border border-green-500/30">
                    ATTIVO
                </span>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <div class="text-sm text-gray-500">Piano</div>
                        <div class="text-lg font-semibold text-white">{{ auth()->user()->subscription->stripe_price }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Prossimo pagamento</div>
                        <div class="text-lg font-semibold text-white">
                            {{ auth()->user()->subscription->ends_at?->format('d/m/Y') ?? 'N/D' }}
                        </div>
                    </div>
                </div>

                <form action="{{ route('billing.portal') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-black font-medium px-6 py-2 rounded-lg transition">
                        Apri portale Stripe
                    </button>
                </form>
            </div>

            {{-- INVOICES --}}
            <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 mb-6">
                <h2 class="text-xl font-semibold text-white mb-4">Fatture</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left px-4 py-2 text-sm font-medium text-gray-400">Data</th>
                            <th class="text-left px-4 py-2 text-sm font-medium text-gray-400">Importo</th>
                            <th class="text-left px-4 py-2 text-sm font-medium text-gray-400">Stato</th>
                            <th class="text-right px-4 py-2 text-sm font-medium text-gray-400">Azione</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                            <tr class="border-b border-gray-800 hover:bg-gray-950 transition">
                                <td class="px-4 py-3 text-gray-300">{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td class="px-4 py-3 text-white">{{ $invoice->total() }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded">
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ $invoice->hosted_invoice_url }}" target="_blank"
                                       class="text-cyan-400 hover:text-cyan-300 text-sm">
                                        Scarica
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                    Nessuna fattura disponibile
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- CANCEL --}}
            <div class="bg-gray-900 rounded-xl border border-red-500/30 p-6">
                <h2 class="text-xl font-semibold text-red-400 mb-2">⚠️ Zona pericolosa</h2>
                <p class="text-gray-400 mb-4">
                    Cancellando l'abbonamento perderai l'accesso alle funzionalità premium.
                </p>
                <form action="{{ route('subscription.cancel') }}" method="POST"
                      onsubmit="return confirm('Sei sicuro di voler cancellare l\'abbonamento?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition">
                        Cancella abbonamento
                    </button>
                </form>
            </div>

        @else
            <div class="bg-gray-900 rounded-xl border border-gray-800 p-12 text-center">
                <div class="text-6xl mb-4">📦</div>
                <h2 class="text-2xl font-semibold text-white mb-2">Nessun abbonamento attivo</h2>
                <p class="text-gray-400 mb-6">Sottoscrivi un piano per sbloccare tutte le funzionalità.</p>
                <a href="{{ route('pricing') }}" class="inline-block bg-cyan-500 hover:bg-cyan-400 text-black font-medium px-6 py-3 rounded-lg transition">
                    Vedi i piani
                </a>
            </div>
        @endif
    </div>
@endsection
