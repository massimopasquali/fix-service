@extends('layouts.app')
@section('title', 'Rinnova abbonamento')

@section('content')
    <section class="max-w-5xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-4">Gestisci il tuo abbonamento</h1>
        <p class="text-gray-400 mb-10">Azienda: <span class="text-white font-semibold">{{ $company->name }}</span></p>

        @if(session('status') === 'success')
            <div class="mb-6 p-4 bg-green-900/30 border border-green-700 rounded-lg text-green-300">
                Abbonamento rinnovato con successo!
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            @php
                $plans = [
                    ['id' => 'price_starter', 'name' => 'Starter', 'price' => '€19/mese', 'features' => ['Fino a 50 riparazioni/mese', '1 utente', 'Supporto email']],
                    ['id' => 'price_pro', 'name' => 'Professional', 'price' => '€49/mese', 'features' => ['Riparazioni illimitate', '5 utenti', 'Supporto prioritario', 'API access'], 'highlight' => true],
                    ['id' => 'price_enterprise', 'name' => 'Enterprise', 'price' => '€99/mese', 'features' => ['Tutto illimitato', 'Utenti illimitati', 'Manager dedicato', 'SLA 99.9%']],
                ];
            @endphp

            @foreach($plans as $plan)
                <div class="p-6 rounded-xl border {{ ($plan['highlight'] ?? false) ? 'border-red-500 bg-red-900/10' : 'border-gray-800 bg-gray-900' }}">
                    @if($plan['highlight'] ?? false)
                        <span class="text-xs font-bold text-red-400 uppercase">Più popolare</span>
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
                    <form method="POST" action="{{ route('subscription.renew') }}" class="mt-6">
                        @csrf
                        <input type="hidden" name="plan" value="{{ $plan['id'] }}">
                        <button type="submit" class="w-full py-3 rounded-lg font-semibold transition {{ ($plan['highlight'] ?? false) ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-800 hover:bg-gray-700' }}">
                            {{ ($plan['highlight'] ?? false) ? 'Scegli Professional' : 'Seleziona' }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
