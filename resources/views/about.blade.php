@extends('layouts.app')
@section('title', 'Chi siamo')

@section('content')
    <section class="max-w-4xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-6">Chi siamo</h1>
        <div class="prose prose-invert max-w-none text-gray-300 space-y-4">
            <p>
                <strong class="text-white">Fix-Device.it</strong> nasce dalla necessità di offrire alle aziende di riparazione elettronica uno strumento moderno, semplice e affidabile per gestire il flusso di lavoro quotidiano.
            </p>
            <p>
                La nostra piattaforma è <strong class="text-white">multi-tenant</strong>: ogni azienda dispone di un ambiente isolato, sicuro e personalizzabile, in cui gestire ticket, clienti, inventario e comunicazioni.
            </p>
            <p>
                Supportiamo la riparazione di <strong class="text-white">smartphone, tablet, PC, console, elettrodomestici</strong> e qualsiasi altro dispositivo elettronico. Il nostro obiettivo è far concentrare i tecnici sul loro lavoro, automatizzando tutto il resto.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-16">
            <div class="p-6 bg-gray-900 rounded-xl border border-gray-800 text-center">
                <div class="text-4xl font-bold text-red-500">500+</div>
                <div class="text-gray-400 mt-2">Aziende attive</div>
            </div>
            <div class="p-6 bg-gray-900 rounded-xl border border-gray-800 text-center">
                <div class="text-4xl font-bold text-red-500">50k+</div>
                <div class="text-gray-400 mt-2">Riparazioni gestite</div>
            </div>
            <div class="p-6 bg-gray-900 rounded-xl border border-gray-800 text-center">
                <div class="text-4xl font-bold text-red-500">99.9%</div>
                <div class="text-gray-400 mt-2">Uptime garantito</div>
            </div>
        </div>
    </section>
@endsection
