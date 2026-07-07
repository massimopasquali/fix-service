@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center text-white mb-2">Completa il pagamento</h1>
        <p class="text-center text-gray-400 mb-8">Transazione sicura con Stripe 🔒</p>

        <div class="grid md:grid-cols-3 gap-8">

            {{-- ORDER SUMMARY --}}
            <div class="md:col-span-1">
                <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 sticky top-24">
                    <h3 class="font-semibold text-white mb-4">Riepilogo</h3>
                    <div class="border-t border-gray-800 pt-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Piano {{ $planName }}</span>
                            <span class="text-white font-medium">€{{ $price }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Fatturazione</span>
                            <span>{{ $billing }}</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 mt-4 pt-4 flex justify-between font-bold text-lg">
                        <span class="text-white">Totale</span>
                        <span class="text-cyan-400">€{{ $price }}</span>
                    </div>
                </div>
            </div>

            {{-- PAYMENT FORM --}}
            <div class="md:col-span-2">
                <div class="bg-gray-900 rounded-xl border border-gray-800 p-8">
                    <form id="payment-form" action="{{ route('subscription.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="price_id" value="{{ $priceId }}">

                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Nome</label>
                                <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required
                                       class="w-full px-4 py-2 bg-gray-950 border border-gray-800 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required
                                       class="w-full px-4 py-2 bg-gray-950 border border-gray-800 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Carta di credito</label>
                            <div id="card-element" class="p-3 bg-gray-950 border border-gray-800 rounded-lg text-white">
                                <!-- Stripe Element -->
                            </div>
                            <div id="card-errors" class="text-red-400 text-sm mt-2" role="alert"></div>
                        </div>

                        <button type="submit" id="submit"
                                class="w-full bg-cyan-500 hover:bg-cyan-400 text-black font-bold py-3 rounded-lg transition flex items-center justify-center disabled:opacity-50">
                            <span id="button-text">Paga €{{ $price }}</span>
                            <svg id="spinner" class="hidden animate-spin ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ config("cashier.key") }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        color: '#ffffff',
                        backgroundColor: '#030712',
                        fontSize: '16px',
                        '::placeholder': { color: '#6b7280' },
                    },
                    invalid: { color: '#f87171' },
                }
            });
            cardElement.mount('#card-element');

            const form = document.getElementById('payment-form');
            const submitBtn = document.getElementById('submit');
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('spinner');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                submitBtn.disabled = true;
                buttonText.textContent = 'Elaborazione...';
                spinner.classList.remove('hidden');

                const { paymentMethod, error } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: { name: form.name.value, email: form.email.value },
                });

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                    submitBtn.disabled = false;
                    buttonText.textContent = 'Paga €{{ $price }}';
                    spinner.classList.add('hidden');
                } else {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'payment_method';
                    input.value = paymentMethod.id;
                    form.appendChild(input);
                    form.submit();
                }
            });
        </script>
    @endpush
@endsection
