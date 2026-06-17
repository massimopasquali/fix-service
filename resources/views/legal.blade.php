@extends('layouts.app')
@section('title', 'Condizioni di utilizzo')

@section('content')
    <section class="max-w-4xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-8">Condizioni di utilizzo del sito</h1>
        <div class="prose prose-invert max-w-none text-gray-300 space-y-4">
            <h2 class="text-2xl font-semibold text-white mt-8">1. Accettazione dei termini</h2>
            <p>Accedendo e utilizzando Fix-Device.it, l'utente accetta integralmente le presenti condizioni. L'uso continuato del servizio implica l'accettazione di eventuali aggiornamenti.</p>

            <h2 class="text-2xl font-semibold text-white mt-8">2. Descrizione del servizio</h2>
            <p>Fix-Device.it è una piattaforma SaaS multi-tenant destinata ad aziende che operano nel settore della riparazione di dispositivi elettronici. Il servizio include gestione ticket, tracking riparazioni, fatturazione e comunicazioni con i clienti finali.</p>

            <h2 class="text-2xl font-semibold text-white mt-8">3. Abbonamenti e pagamenti</h2>
            <p>I pagamenti sono gestiti tramite Stripe. L'abbonamento si rinnova automaticamente alla scadenza del periodo corrente, salvo disdetta con preavviso di almeno 7 giorni. È possibile cancellare l'abbonamento in qualsiasi momento dalla sezione "Rinnova il tuo abbonamento".</p>

            <h2 class="text-2xl font-semibold text-white mt-8">4. Responsabilità</h2>
            <p>Fix-Device.it non è responsabile per malfunzionamenti dei dispositivi riparati dalle aziende utenti. La piattaforma fornisce solo gli strumenti software per la gestione dell'attività.</p>

            <h2 class="text-2xl font-semibold text-white mt-8">5. Legge applicabile</h2>
            <p>Le presenti condizioni sono regolate dalla legge italiana. Per qualsiasi controversia è competente il Foro di Roma.</p>
        </div>
    </section>
@endsection
