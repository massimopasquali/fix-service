<!-- resources/views/auth/register-company.blade.php -->
@extends('layouts.app')

@section('title', 'Registra la tua Azienda')

@section('content')
    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950">
        <div class="bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-2xl w-full max-w-2xl">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-full mb-4 shadow-lg shadow-red-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">
                    Registra la tua Azienda
                </h2>
                <p class="text-gray-400">
                    Configura il tuo ambiente dedicato in pochi minuti
                </p>
            </div>

            {{-- Errori di validazione --}}
            @if ($errors->any())
                <div class="bg-red-950/30 border border-red-800 text-red-300 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold text-red-200">Correggi gli errori seguenti:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registration.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Sezione: Dati Azienda --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white border-b border-gray-800 pb-2 flex items-center">
                        <span class="mr-2">📋</span> Dati Azienda
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-300 mb-1">
                                Nome Azienda <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="company_name"
                                id="company_name"
                                value="{{ old('company_name') }}"
                                class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                placeholder="Es. Acme SRL"
                                required
                            >
                        </div>
                        <div>
                            <label for="vat_number" class="block text-sm font-medium text-gray-300 mb-1">
                                Partita IVA <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="vat_number"
                                id="vat_number"
                                value="{{ old('vat_number') }}"
                                class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                placeholder="Es. IT12345678901"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                            Email Aziendale <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                            placeholder="azienda@esempio.com"
                            required
                        >
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-300 mb-1">
                            Indirizzo <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="address"
                            id="address"
                            rows="2"
                            class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                            placeholder="Via Roma 1, 00100 Milano (MI)"
                            required
                        >{{ old('address') }}</textarea>
                    </div>
                </div>

                {{-- Sezione: Account Amministratore --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white border-b border-gray-800 pb-2 flex items-center">
                        <span class="mr-2">👤</span> Account Amministratore
                    </h3>

                    <div>
                        <label for="admin_name" class="block text-sm font-medium text-gray-300 mb-1">
                            Nome Completo <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="admin_name"
                            id="admin_name"
                            value="{{ old('admin_name') }}"
                            class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                            placeholder="Mario Rossi"
                            required
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="admin_password" class="block text-sm font-medium text-gray-300 mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="password"
                                name="admin_password"
                                id="admin_password"
                                class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                placeholder="Minimo 8 caratteri"
                                minlength="8"
                                required
                            >
                        </div>
                        <div>
                            <label for="admin_password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">
                                Conferma Password <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="password"
                                name="admin_password_confirmation"
                                id="admin_password_confirmation"
                                class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                placeholder="Ripeti la password"
                                required
                            >
                        </div>
                    </div>
                </div>

                {{-- Sezione: Piano di Abbonamento --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white border-b border-gray-800 pb-2 flex items-center">
                        <span class="mr-2">💳</span> Piano di Abbonamento
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Piano Mensile --}}
                        <label class="cursor-pointer group">
                            <input type="radio" name="plan" value="monthly" class="peer sr-only" {{ old('plan', 'monthly') === 'monthly' ? 'checked' : '' }}>
                            <div class="p-5 bg-gray-800 border-2 border-gray-700 rounded-xl peer-checked:border-red-500 peer-checked:bg-gray-800/80 transition-all group-hover:border-gray-600">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-white">Mensile</span>
                                    <svg class="w-5 h-5 text-red-500 opacity-0 peer-checked:opacity-100 transition" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-3xl font-bold text-white mb-1">
                                    €29<span class="text-sm font-normal text-gray-400">/mese</span>
                                </div>
                                <p class="text-xs text-gray-400">Fatturazione mensile</p>
                            </div>
                        </label>

                        {{-- Piano Annuale --}}
                        <label class="cursor-pointer group relative">
                            <input type="radio" name="plan" value="yearly" class="peer sr-only" {{ old('plan') === 'yearly' ? 'checked' : '' }}>
                            <div class="p-5 bg-gray-800 border-2 border-gray-700 rounded-xl peer-checked:border-red-500 peer-checked:bg-gray-800/80 transition-all group-hover:border-gray-600 relative">
                            <span class="absolute -top-2 right-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold shadow-md">
                                -20%
                            </span>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-white">Annuale</span>
                                    <svg class="w-5 h-5 text-red-500 opacity-0 peer-checked:opacity-100 transition" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-3xl font-bold text-white mb-1">
                                    €279<span class="text-sm font-normal text-gray-400">/anno</span>
                                </div>
                                <p class="text-xs text-gray-400">Risparmi €69 all'anno</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-red-500/20 transform hover:-translate-y-0.5"
                    >
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Procedi al Pagamento Sicuro con Stripe
                    </span>
                    </button>

                    <p class="text-xs text-center text-gray-500 mt-4">
                        🔒 Pagamento sicuro gestito da Stripe. Il tuo ambiente dedicato verrà creato immediatamente dopo il pagamento.
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
