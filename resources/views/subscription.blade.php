@extends('layouts.app')
@section('title', 'Gestisci abbonamento')

@section('content')
    <section class="max-w-5xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-4">Gestisci il tuo abbonamento</h1>
        <p class="text-gray-400 mb-10">
            Azienda: <span class="text-white font-semibold">{{ $company->name }}</span>
        </p>

        {{-- ─── MESSAGGI FLASH ─────────────────────────────────────────── ──── --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/30 border border-green-700 rounded-lg text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-900/30 border border-red-700 rounded-lg text-red-300">
                {{ session('error') }}
            </div>
        @endif

        {{-- ─── STATO ABBONAMENTO ATTUALE ──────────────────────────────────── --}}
        @if($isSubscribed)
            <div class="mb-10 p-6 rounded-xl border {{ $onGracePeriod ? 'border-yellow-500 bg-yellow-900/10' : 'border-green-700 bg-green-900/10' }}">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h2 class="text-xl font-bold {{ $onGracePeriod ? 'text-yellow-300' : 'text-green-300' }}">
                            @if($onGracePeriod)
                                ⚠️ Abbonamento in cancellazione
                            @else
                                ✅ Abbonamento attivo
                            @endif
                        </h2>
                        <p class="text-gray-400 mt-1">
                            Piano attuale: <span class="text-white font-semibold">{{ ucfirst(str_replace(['price_', '_monthly', '_yearly'], '', $currentPlan)) }}</span>
                        </p>
                        @if($subscription->ends_at)
                            <p class="text-gray-400 text-sm mt-1">
                                Accesso fino al: <span class="text-white">{{ $subscription->ends_at->format('d/m/Y') }}</span>
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-3">
                        @if($onGracePeriod)
                            {{-- Pulsante Ripristina --}}
                            <form action="{{ route('subscription.resume') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2 rounded-lg font-semibold bg-green-600 hover:bg-green-700 transition">
                                    Ripristina abbonamento
                                </button>
                            </form>
                        @else
                            {{-- Pulsante Cancella --}}
                            <form action="{{ route('subscription.cancel') }}" method="POST"
                                  onsubmit="return confirm('Sei sicuro? L\'abbonamento resterà attivo fino alla fine del periodo già pagato.')">
                                @csrf
                                <button type="submit" class="px-6 py-2 rounded-lg font-semibold bg-red-600 hover:bg-red-700 transition">
                                    Cancella abbonamento
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- ── GRIGLIA PIANI ─────────────────────────────────────────────── --}}
        @php
            $plans = [
                [
                    'id' => 'price_starter',
                    'name' => 'Starter',
                    'price' => '€19/mese',
                    'features' => [
                        'Fino a 50 riparazioni/mese',
                        '1 utente',
                        'Supporto email',
                    ],
                ],
                [
                    'id' => 'price_pro',
                    'name' => 'Professional',
                    'price' => '€49/mese',
                    'features' => [
                        'Riparazioni illimitate',
                        '5 utenti',
                        'Supporto prioritario',
                        'API access',
                    ],
                    'highlight' => true,
                ],
                [
                    'id' => 'price_enterprise',
                    'name' => 'Enterprise',
                    'price' => '€99/mese',
                    'features' => [
                        'Tutto illimitato',
                        'Utenti illimitati',
                        'Manager dedicato',
                        'SLA 99.9%',
                    ],
                ],
            ];
        @endphp

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                @php
                    $isCurrentPlan = $isSubscribed && $currentPlan === $plan['id'];
                    $hasSubscription = $isSubscribed;
                @endphp

                <div class="p-6 rounded-xl border {{ ($plan['highlight'] ?? false) ? 'border-red-500 bg-red-900/10' : 'border-gray-800 bg-gray-900' }}">

                    {{-- Badge "Più popolare" --}}
                    @if($plan['highlight'] ?? false)
                        <span class="text-xs font-bold text-red-400 uppercase">Più popolare</span>
                    @endif

                    {{-- Badge "Piano attuale" --}}
                    @if($isCurrentPlan)
                        <span class="inline-block ml-2 text-xs font-bold text-green-400 uppercase bg-green-900/30 px-2 py-1 rounded">
                            Piano attuale
                        </span>
                    @endif

                    <h3 class="text-2xl font-bold mt-2">{{ $plan['name'] }}</h3>
                    <p class="text-3xl font-bold mt-4">{{ $plan['price'] }}</p>

                    <ul class="mt-6 space-y-2 text-gray-300">
                        @foreach($plan['features'] as $feature)
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    {{-- ── PULSANTE AZIONE ──────────────────────────────────── --}}
                    <div class="mt-6">
                        @if($isCurrentPlan)
                            {{-- Piano attuale: disabilitato --}}
                            <button disabled class="w-full py-3 rounded-lg font-semibold bg-gray-700 text-gray-400 cursor-not-allowed">
                                Piano attuale
                            </button>
                        @elseif(!$hasSubscription)
                            {{-- Nessun abbonamento: checkout --}}
                            <form method="POST" action="{{ route('subscription.checkout') }}">
                                @csrf
                                <input type="hidden" name="plan" value="{{ $plan['id'] }}">
                                <button type="submit" class="w-full py-3 rounded-lg font-semibold transition {{ ($plan['highlight'] ?? false) ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-800 hover:bg-gray-700' }}">
                                    {{ ($plan['highlight'] ?? false) ? 'Scegli Professional' : 'Seleziona' }}
                                </button>
                            </form>
                        @else
                            {{-- Ha già un abbonamento: swap/upgrade --}}
                            <form method="POST" action="{{ route('subscription.checkout') }}"
                                  onsubmit="return confirm('Confermi il cambio piano? La differenza verrà calcolata automaticamente.')">
                                @csrf
                                <input type="hidden" name="plan" value="{{ $plan['id'] }}">
                                <button type="submit" class="w-full py-3 rounded-lg font-semibold transition {{ ($plan['highlight'] ?? false) ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-800 hover:bg-gray-700' }}">
                                    Passa a {{ $plan['name'] }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ─── NOTA FORFETTARIO ───────────────────────────────────────────── --}}
        <div class="mt-12 text-center text-sm text-gray-500">
            <p>💡 Prezzi IVA esclusa (Regime Forfettario art. 1 c. 54-89 L. 190/2014)</p>
            <p class="mt-1">Marca da bollo €2 per importi superiori a €77,47</p>
        </div>
    </section>
@endsection
