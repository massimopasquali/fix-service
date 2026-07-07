@extends('layouts.app')

@section('title', 'Piani e Prezzi')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-16">

        {{-- HEADER --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Scegli il piano <span class="text-cyan-400">perfetto</span>
            </h1>
            <p class="text-lg text-gray-400">Inizia gratis, aggiorna quando vuoi</p>
        </div>

        {{-- BILLING TOGGLE --}}
        <div class="flex justify-center mb-12">
            <div class="bg-gray-900 border border-gray-800 p-1 rounded-lg inline-flex">
                <button id="monthly-btn" class="px-6 py-2 rounded-md bg-cyan-500 text-black text-sm font-medium transition">
                    Mensile
                </button>
                <button id="yearly-btn" class="px-6 py-2 rounded-md text-sm font-medium text-gray-400 hover:text-white transition">
                    Annuale <span class="text-cyan-400 text-xs">(-20%)</span>
                </button>
            </div>
        </div>

        {{-- PLANS GRID --}}
        <div class="grid md:grid-cols-3 gap-8">

            {{-- FREE --}}
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8 hover:border-gray-700 transition">
                <h3 class="text-xl font-semibold text-white">Free</h3>
                <p class="text-gray-500 mt-2 text-sm">Per iniziare</p>
                <div class="mt-6">
                    <span class="text-4xl font-bold text-white">€0</span>
                    <span class="text-gray-500">/mese</span>
                </div>
                <ul class="mt-8 space-y-3 text-sm text-gray-300">
                    <li>✅ 3 progetti</li>
                    <li>✅ 1 GB storage</li>
                    <li>✅ Supporto email</li>
                    <li class="text-gray-600">❌ Funzionalità avanzate</li>
                </ul>
                <a href="{{ route('register') }}" class="mt-8 block text-center bg-gray-800 hover:bg-gray-700 text-white py-3 rounded-lg font-medium transition">
                    Inizia gratis
                </a>
            </div>

            {{-- PRO (highlighted) --}}
            <div class="bg-gradient-to-b from-cyan-500/10 to-gray-900 rounded-2xl border-2 border-cyan-500 p-8 relative transform md:scale-105 shadow-2xl shadow-cyan-500/20">
                <div class="absolute top-0 right-6 -translate-y-1/2 bg-cyan-500 text-black text-xs px-3 py-1 rounded-full font-bold">
                    ⚡ POPOLARE
                </div>
                <h3 class="text-xl font-semibold text-white">Pro</h3>
                <p class="text-gray-400 mt-2 text-sm">Per professionisti</p>
                <div class="mt-6">
                    <span class="text-4xl font-bold text-white monthly-price">€19</span>
                    <span class="text-4xl font-bold text-white yearly-price hidden">€182</span>
                    <span class="text-gray-400 period-text">/mese</span>
                </div>
                <ul class="mt-8 space-y-3 text-sm text-gray-300">
                    <li>✅ Progetti illimitati</li>
                    <li>✅ 50 GB storage</li>
                    <li>✅ Supporto prioritario</li>
                    <li>✅ Analytics avanzate</li>
                    <li>✅ API access</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'price_pro_monthly']) }}"
                   class="mt-8 block text-center bg-cyan-500 hover:bg-cyan-400 text-black py-3 rounded-lg font-bold transition plan-link"
                   data-monthly="{{ route('checkout', ['plan' => 'price_pro_monthly']) }}"
                   data-yearly="{{ route('checkout', ['plan' => 'price_pro_yearly']) }}">
                    Scegli Pro
                </a>
            </div>

            {{-- BUSINESS --}}
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-8 hover:border-gray-700 transition">
                <h3 class="text-xl font-semibold text-white">Business</h3>
                <p class="text-gray-500 mt-2 text-sm">Per team</p>
                <div class="mt-6">
                    <span class="text-4xl font-bold text-white monthly-price">€49</span>
                    <span class="text-4xl font-bold text-white yearly-price hidden">€470</span>
                    <span class="text-gray-400 period-text">/mese</span>
                </div>
                <ul class="mt-8 space-y-3 text-sm text-gray-300">
                    <li>✅ Tutto di Pro</li>
                    <li>✅ 500 GB storage</li>
                    <li>✅ Team illimitati</li>
                    <li>✅ SSO & SAML</li>
                    <li>✅ SLA garantito</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'price_business_monthly']) }}"
                   class="mt-8 block text-center bg-white hover:bg-gray-200 text-black py-3 rounded-lg font-medium transition plan-link"
                   data-monthly="{{ route('checkout', ['plan' => 'price_business_monthly']) }}"
                   data-yearly="{{ route('checkout', ['plan' => 'price_business_yearly']) }}">
                    Scegli Business
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            const monthlyBtn = document.getElementById('monthly-btn');
            const yearlyBtn = document.getElementById('yearly-btn');
            const monthlyPrices = document.querySelectorAll('.monthly-price');
            const yearlyPrices = document.querySelectorAll('.yearly-price');
            const periodText = document.querySelectorAll('.period-text');
            const planLinks = document.querySelectorAll('.plan-link');

            monthlyBtn.addEventListener('click', () => {
                monthlyBtn.classList.add('bg-cyan-500', 'text-black');
                monthlyBtn.classList.remove('text-gray-400');
                yearlyBtn.classList.remove('bg-cyan-500', 'text-black');
                yearlyBtn.classList.add('text-gray-400');
                monthlyPrices.forEach(el => el.classList.remove('hidden'));
                yearlyPrices.forEach(el => el.classList.add('hidden'));
                periodText.forEach(el => el.textContent = '/mese');
                planLinks.forEach(el => el.href = el.dataset.monthly);
            });

            yearlyBtn.addEventListener('click', () => {
                yearlyBtn.classList.add('bg-cyan-500', 'text-black');
                yearlyBtn.classList.remove('text-gray-400');
                monthlyBtn.classList.remove('bg-cyan-500', 'text-black');
                monthlyBtn.classList.add('text-gray-400');
                monthlyPrices.forEach(el => el.classList.add('hidden'));
                yearlyPrices.forEach(el => el.classList.remove('hidden'));
                periodText.forEach(el => el.textContent = '/anno');
                planLinks.forEach(el => el.href = el.dataset.yearly);
            });
        </script>
    @endpush
@endsection
