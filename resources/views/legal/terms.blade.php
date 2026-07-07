<!-- resources/views/legal/terms.blade.php -->
@extends('layouts.app')

@section('title', 'Condizioni di Utilizzo')

@section('content')
    <div class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 py-12 px-4">
        <div class="max-w-6xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-full mb-4 shadow-lg shadow-red-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-3">Condizioni di Utilizzo</h1>
                <p class="text-gray-400">Ultimo aggiornamento: 18 Giugno 2026</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- Sidebar: Indice --}}
                <aside class="lg:col-span-1">
                    <div class="sticky top-4 bg-gray-900 border border-gray-800 rounded-xl p-5">
                        <h3 class="text-white font-semibold mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            Indice
                        </h3>
                        <nav class="space-y-2 text-sm">
                            <a href="#intro" class="block text-gray-400 hover:text-red-400 transition">1. Introduzione</a>
                            <a href="#definizioni" class="block text-gray-400 hover:text-red-400 transition">2. Definizioni</a>
                            <a href="#oggetto" class="block text-gray-400 hover:text-red-400 transition">3. Oggetto del Servizio</a>
                            <a href="#registrazione" class="block text-gray-400 hover:text-red-400 transition">4. Registrazione</a>
                            <a href="#abbonamento" class="block text-gray-400 hover:text-red-400 transition">5. Abbonamento e Pagamenti</a>
                            <a href="#obblighi" class="block text-gray-400 hover:text-red-400 transition">6. Obblighi dell'Utente</a>
                            <a href="#responsabilita" class="block text-gray-400 hover:text-red-400 transition">7. Responsabilità</a>
                            <a href="#proprieta" class="block text-gray-400 hover:text-red-400 transition">8. Proprietà Intellettuale</a>
                            <a href="#sospensione" class="block text-gray-400 hover:text-red-400 transition">9. Sospensione e Cessazione</a>
                            <a href="#modifiche" class="block text-gray-400 hover:text-red-400 transition">10. Modifiche</a>
                            <a href="#legge" class="block text-gray-400 hover:text-red-400 transition">11. Legge Applicabile</a>
                            <a href="#contatti" class="block text-gray-400 hover:text-red-400 transition">12. Contatti</a>
                        </nav>
                    </div>
                </aside>

                {{-- Contenuto --}}
                <article class="lg:col-span-3 bg-gray-900 border border-gray-800 rounded-xl p-8 space-y-8">

                    {{-- 1. Introduzione --}}
                    <section id="intro">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">1.</span> Introduzione
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Le presenti Condizioni di Utilizzo (di seguito "<strong class="text-white">Condizioni</strong>") regolano l'utilizzo della piattaforma
                                <strong class="text-red-400">Fix-Device.it</strong> (di seguito "<strong class="text-white">Piattaforma</strong>" o "<strong class="text-white">Servizio</strong>"),
                                gestita da Fix-Device di Massimo Pasquali, con sede legale in Italia, P.IVA 04793840481 (di seguito "<strong class="text-white">Titolare</strong>").
                            </p>
                            <p>
                                Accedendo o utilizzando la Piattaforma, l'Utente accetta integralmente le presenti Condizioni.
                                Si prega di leggerle attentamente prima di procedere con la registrazione.
                            </p>
                        </div>
                    </section>

                    {{-- 2. Definizioni --}}
                    <section id="definizioni">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">2.</span> Definizioni
                        </h2>
                        <div class="text-gray-300 space-y-3 leading-relaxed">
                            <ul class="space-y-3">
                                <li class="flex">
                                    <span class="text-red-500 mr-2">•</span>
                                    <div><strong class="text-white">Piattaforma:</strong> il servizio web Fix-Device.it fornito come Software as a Service (SaaS).</div>
                                </li>
                                <li class="flex">
                                    <span class="text-red-500 mr-2">•</span>
                                    <div><strong class="text-white">Tenant:</strong> l'ambiente dedicato e isolato assegnato a ciascuna azienda registrata, comprensivo di database, sottodominio e dati.</div>
                                </li>
                                <li class="flex">
                                    <span class="text-red-500 mr-2">•</span>
                                    <div><strong class="text-white">Utente:</strong> qualsiasi persona fisica o giuridica che accede alla Piattaforma.</div>
                                </li>
                                <li class="flex">
                                    <span class="text-red-500 mr-2">•</span>
                                    <div><strong class="text-white">Azienda:</strong> l'attività commerciale di riparazione dispositivi che si registra sulla Piattaforma.</div>
                                </li>
                                <li class="flex">
                                    <span class="text-red-500 mr-2">•</span>
                                    <div><strong class="text-white">Amministratore:</strong> l'utente con privilegi di gestione dell'ambiente Tenant.</div>
                                </li>
                            </ul>
                        </div>
                    </section>

                    {{-- 3. Oggetto del Servizio --}}
                    <section id="oggetto">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">3.</span> Oggetto del Servizio
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Fix-Device.it è una piattaforma multi-tenant progettata per aziende di riparazione dispositivi.
                                Il Servizio include:
                            </p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Gestione degli ordini di riparazione</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Tracciamento dello stato delle riparazioni</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Comunicazione con i clienti finali</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Ambiente dedicato e isolato per ogni azienda</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Gestione degli abbonamenti e fatturazione</li>
                            </ul>
                            <p>
                                Il Titolare si riserva il diritto di modificare, sospendere o interrompere temporaneamente
                                il Servizio per motivi tecnici o di manutenzione, dandone preventiva comunicazione ove possibile.
                            </p>
                        </div>
                    </section>

                    {{-- 4. Registrazione --}}
                    <section id="registrazione">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">4.</span> Registrazione e Account
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Per utilizzare il Servizio è necessario completare la registrazione fornendo dati veritieri e completi:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Ragione sociale e Partita IVA valida</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Email aziendale funzionante</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Indirizzo legale dell'azienda</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Credenziali dell'Amministratore</li>
                            </ul>
                            <p>
                                L'Amministratore è responsabile della custodia delle credenziali e di tutte le attività
                                svolte all'interno del proprio Tenant. È obbligatorio notificare tempestivamente al Titolare
                                qualsiasi accesso non autorizzato.
                            </p>
                        </div>
                    </section>

                    {{-- 5. Abbonamento --}}
                    <section id="abbonamento">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">5.</span> Abbonamento e Pagamenti
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                L'accesso al Servizio è subordinato alla sottoscrizione di un abbonamento a pagamento.
                                I piani disponibili sono:
                            </p>

                            {{-- Tabella piani --}}
                            <div class="overflow-x-auto my-4">
                                <table class="w-full text-left border border-gray-700 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-4 py-3 text-white font-semibold">Piano</th>
                                        <th class="px-4 py-3 text-white font-semibold">Prezzo</th>
                                        <th class="px-4 py-3 text-white font-semibold">Fatturazione</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Mensile</td>
                                        <td class="px-4 py-3 text-red-400 font-bold">€29/mese</td>
                                        <td class="px-4 py-3">Ricorrente mensile</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Annuale</td>
                                        <td class="px-4 py-3 text-red-400 font-bold">€279/anno</td>
                                        <td class="px-4 py-3">Ricorrente annuale (-20%)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p>I pagamenti sono gestiti in modo sicuro tramite <strong class="text-white">Stripe</strong>. L'abbonamento:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Si rinnova automaticamente alla scadenza</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Può essere disdetto in qualsiasi momento dall'area riservata</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> In caso di mancato pagamento, il Servizio verrà sospeso dopo un periodo di grazia</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> I prezzi si intendono IVA esclusa</li>
                            </ul>
                        </div>
                    </section>

                    {{-- 6. Obblighi --}}
                    <section id="obblighi">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">6.</span> Obblighi dell'Utente
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>L'Utente si impegna a:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Utilizzare il Servizio in conformità alle leggi vigenti</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Non tentare di accedere ad ambienti Tenant di altri utenti</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Non eseguire attività di reverse engineering sulla Piattaforma</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Non utilizzare il Servizio per attività illecite o fraudolente</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Mantenere aggiornati i propri dati aziendali</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Trattare i dati dei propri clienti nel rispetto del GDPR</li>
                            </ul>
                        </div>
                    </section>

                    {{-- 7. Responsabilità --}}
                    <section id="responsabilita">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">7.</span> Responsabilità
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Il Titolare fornisce il Servizio "così com'è" e non garantisce l'assenza totale di errori o interruzioni.
                                La responsabilità del Titolare è limitata ai casi di dolo o colpa grave.
                            </p>
                            <p>
                                L'Utente è unico responsabile dei dati inseriti nella Piattaforma e del rispetto degli obblighi
                                normativi relativi alla propria attività commerciale, ivi inclusi quelli verso i propri clienti.
                            </p>
                        </div>
                    </section>

                    {{-- 8. Proprietà Intellettuale --}}
                    <section id="proprieta">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">8.</span> Proprietà Intellettuale
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Tutti i diritti di proprietà intellettuale relativi alla Piattaforma (codice sorgente, design,
                                loghi, marchi) sono di esclusiva titolarità di Fix-Device S.r.l.
                            </p>
                            <p>
                                I dati inseriti dall'Utente rimangono di sua proprietà. Il Titolare si impegna a trattarli
                                esclusivamente per l'erogazione del Servizio, come dettagliato nella
                                <a href="{{ route('legal.privacy') }}" class="text-red-400 hover:text-red-300 underline">Privacy Policy</a>.
                            </p>
                        </div>
                    </section>

                    {{-- 9. Sospensione --}}
                    <section id="sospensione">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">9.</span> Sospensione e Cessazione
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Il Titolare si riserva il diritto di sospendere o chiudere l'account dell'Utente in caso di:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Violazione delle presenti Condizioni</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Mancato pagamento dell'abbonamento</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> Utilizzo fraudolento o illecito del Servizio</li>
                            </ul>
                            <p>
                                L'Utente può disdire l'abbonamento in qualsiasi momento. I dati verranno conservati per 30 giorni
                                dopo la cessazione, salvo obblighi di legge.
                            </p>
                        </div>
                    </section>

                    {{-- 10. Modifiche --}}
                    <section id="modifiche">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">10.</span> Modifiche alle Condizioni
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Il Titolare si riserva di modificare le presenti Condizioni in qualsiasi momento.
                                Le modifiche saranno comunicate agli Utenti registrati via email con almeno 30 giorni di preavviso.
                                Il proseguimento nell'utilizzo del Servizio dopo l'entrata in vigore delle nuove Condizioni
                                ne costituisce accettazione.
                            </p>
                        </div>
                    </section>

                    {{-- 11. Legge --}}
                    <section id="legge">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">11.</span> Legge Applicabile e Foro Competente
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Le presenti Condizioni sono regolate dalla legge italiana.
                                Per qualsiasi controversia derivante dall'interpretazione o esecuzione delle presenti Condizioni,
                                sarà competente in via esclusiva il Foro di Firenze.
                            </p>
                        </div>
                    </section>

                    {{-- 12. Contatti --}}
                    <section id="contatti">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">12.</span> Contatti
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Per qualsiasi domanda relativa alle presenti Condizioni, è possibile contattare il Titolare ai seguenti recapiti:</p>

                            <div class="bg-gray-800 border border-gray-700 rounded-lg p-5 mt-4">
                                <p class="text-white font-semibold mb-3">Fix-Device S.r.l.</p>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <a href="mailto:legale@fix-device.it" class="hover:text-red-400 transition">legale@fix-device.it</a>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span>Tel +39 3495388790</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Via Maartiri del Popolo, 2 - 50055 Lastra a Signa - Firenze</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    {{-- Divider finale --}}
                    <div class="pt-8 mt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                        <p>
                            © {{ date('Y') }} Fix-Device S.r.l. — Tutti i diritti riservati.
                        </p>
                        <p class="mt-2">
                            <a href="{{ route('legal.privacy') }}" class="text-red-400 hover:text-red-300 transition">Privacy Policy</a>
                            <span class="mx-2">•</span>
                            <a href="{{ route('home') }}" class="text-red-400 hover:text-red-300 transition">Torna alla Home</a>
                        </p>
                    </div>

                </article>
            </div>
        </div>
    </div>

    {{-- Smooth scroll per i link dell'indice --}}
    <script>
        document.querySelectorAll('aside a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
@endsection
