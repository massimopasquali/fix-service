<!-- resources/views/legal/privacy.blade.php -->
@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 py-12 px-4">
        <div class="max-w-6xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-full mb-4 shadow-lg shadow-red-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-3">Privacy Policy</h1>
                <p class="text-gray-400">Informativa ex art. 13 Reg. UE 2016/679 (GDPR)</p>
                <p class="text-gray-500 text-sm mt-2">Ultimo aggiornamento: 18 Giugno 2026</p>
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
                            <a href="#titolare" class="block text-gray-400 hover:text-red-400 transition">1. Titolare del Trattamento</a>
                            <a href="#dati-raccolti" class="block text-gray-400 hover:text-red-400 transition">2. Dati Raccolti</a>
                            <a href="#finalita" class="block text-gray-400 hover:text-red-400 transition">3. Finalità del Trattamento</a>
                            <a href="#base-giuridica" class="block text-gray-400 hover:text-red-400 transition">4. Base Giuridica</a>
                            <a href="#modalita" class="block text-gray-400 hover:text-red-400 transition">5. Modalità e Sicurezza</a>
                            <a href="#terzi" class="block text-gray-400 hover:text-red-400 transition">6. Soggetti Terzi</a>
                            <a href="#extra-ue" class="block text-gray-400 hover:text-red-400 transition">7. Trasferimento Extra-UE</a>
                            <a href="#conservazione" class="block text-gray-400 hover:text-red-400 transition">8. Conservazione</a>
                            <a href="#diritti" class="block text-gray-400 hover:text-red-400 transition">9. Diritti dell'Interessato</a>
                            <a href="#cookie" class="block text-gray-400 hover:text-red-400 transition">10. Cookie</a>
                            <a href="#minori" class="block text-gray-400 hover:text-red-400 transition">11. Minori</a>
                            <a href="#modifiche" class="block text-gray-400 hover:text-red-400 transition">12. Modifiche</a>
                            <a href="#contatti" class="block text-gray-400 hover:text-red-400 transition">13. Contatti</a>
                        </nav>
                    </div>
                </aside>

                {{-- Contenuto --}}
                <article class="lg:col-span-3 bg-gray-900 border border-gray-800 rounded-xl p-8 space-y-8">

                    {{-- Intro --}}
                    <section class="bg-gray-800/50 border border-gray-700 rounded-lg p-5">
                        <p class="text-gray-300 leading-relaxed">
                            La presente Privacy Policy descrive le modalità di gestione della piattaforma
                            <strong class="text-red-400">Fix-Device.it</strong> in riferimento al trattamento dei dati personali
                            degli utenti, ai sensi dell'<strong class="text-white">art. 13 del Regolamento UE 2016/679 (GDPR)</strong>
                            e della normativa italiana vigente.
                        </p>
                    </section>

                    {{-- 1. Titolare --}}
                    <section id="titolare">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">1.</span> Titolare del Trattamento
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Il Titolare del trattamento dei dati è:</p>

                            <div class="bg-gray-800 border border-gray-700 rounded-lg p-5">
                                <p class="text-white font-semibold mb-3">Fix-Device S.r.l.</p>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Sede legale: Via Martiri del Popolo, 2</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span>P.IVA: IT04793840481</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>Email: <a href="mailto:privacy@fix-device.it" class="text-red-400 hover:text-red-300 transition">privacy@fix-device.it</a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    {{-- 2. Dati Raccolti --}}
                    <section id="dati-raccolti">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">2.</span> Dati Raccolti
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Fix-Device.it raccoglie le seguenti categorie di dati personali:</p>

                            <div class="space-y-4">
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                    <h4 class="text-white font-semibold mb-2 flex items-center">
                                        <span class="text-red-500 mr-2">📋</span> Dati di Registrazione Azienda
                                    </h4>
                                    <ul class="space-y-1 text-sm text-gray-400 ml-6">
                                        <li>• Ragione sociale e Partita IVA</li>
                                        <li>• Indirizzo legale e sede operativa</li>
                                        <li>• Email aziendale e telefono</li>
                                        <li>• Dati dell'Amministratore del Tenant (nome, email, credenziali)</li>
                                    </ul>
                                </div>

                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                    <h4 class="text-white font-semibold mb-2 flex items-center">
                                        <span class="text-red-500 mr-2">💳</span> Dati di Pagamento
                                    </h4>
                                    <ul class="space-y-1 text-sm text-gray-400 ml-6">
                                        <li>• Gestiti esclusivamente da <strong class="text-white">Stripe</strong> (nostro partner di pagamento)</li>
                                        <li>• Fix-Device.it <strong class="text-white">NON</strong> memorizza dati di carte di credito</li>
                                        <li>• Conserviamo solo l'ID cliente Stripe e lo stato dell'abbonamento</li>
                                    </ul>
                                </div>

                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                    <h4 class="text-white font-semibold mb-2 flex items-center">
                                        <span class="text-red-500 mr-2">🔧</span> Dati Operativi (inseriti dall'Azienda)
                                    </h4>
                                    <ul class="space-y-1 text-sm text-gray-400 ml-6">
                                        <li>• Dati relativi agli ordini di riparazione gestiti dall'Azienda</li>
                                        <li>• Dati dei clienti finali dell'Azienda (nome, telefono, email del dispositivo)</li>
                                        <li>• Note, foto e documentazione tecnica</li>
                                    </ul>
                                    <p class="text-xs text-gray-500 mt-2 italic">
                                        ⚠️ L'Azienda è Titolare autonomo di questi dati nei confronti dei propri clienti finali.
                                    </p>
                                </div>

                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                    <h4 class="text-white font-semibold mb-2 flex items-center">
                                        <span class="text-red-500 mr-2">🌐</span> Dati di Navigazione
                                    </h4>
                                    <ul class="space-y-1 text-sm text-gray-400 ml-6">
                                        <li>• Indirizzo IP</li>
                                        <li>• Browser e sistema operativo</li>
                                        <li>• Pagine visitate e tempi di accesso</li>
                                        <li>• Cookie tecnici e analitici</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- 3. Finalità --}}
                    <section id="finalita">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">3.</span> Finalità del Trattamento
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>I dati vengono trattati per le seguenti finalità:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Erogazione del Servizio SaaS (creazione e gestione del Tenant dedicato)</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Gestione dell'abbonamento e fatturazione</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Assistenza tecnica e comunicazione con l'Utente</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Adempimenti legali e fiscali</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Sicurezza della piattaforma e prevenzione frodi</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Invio di comunicazioni di servizio (non marketing, salvo consenso esplicito)</li>
                            </ul>
                        </div>
                    </section>

                    {{-- 4. Base Giuridica --}}
                    <section id="base-giuridica">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">4.</span> Base Giuridica del Trattamento
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Il trattamento si fonda sulle seguenti basi giuridiche (art. 6 GDPR):</p>

                            <div class="overflow-x-auto my-4">
                                <table class="w-full text-left border border-gray-700 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-4 py-3 text-white font-semibold">Finalità</th>
                                        <th class="px-4 py-3 text-white font-semibold">Base Giuridica</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Erogazione Servizio</td>
                                        <td class="px-4 py-3 text-gray-300">Esecuzione del contratto (art. 6.1.b)</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Obblighi legali/fiscali</td>
                                        <td class="px-4 py-3 text-gray-300">Obbligo legale (art. 6.1.c)</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Sicurezza piattaforma</td>
                                        <td class="px-4 py-3 text-gray-300">Legittimo interesse (art. 6.1.f)</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Marketing (se aderisci)</td>
                                        <td class="px-4 py-3 text-gray-300">Consenso esplicito (art. 6.1.a)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    {{-- 5. Modalità e Sicurezza --}}
                    <section id="modalita">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">5.</span> Modalità di Trattamento e Sicurezza
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>I dati sono trattati con strumenti informatici, adottando misure di sicurezza adeguate per:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">🔒</span> Proteggere i dati da accessi non autorizzati</li>
                                <li class="flex"><span class="text-red-500 mr-2">🔒</span> Garantire la riservatezza e l'integrità dei dati</li>
                                <li class="flex"><span class="text-red-500 mr-2">🔒</span> Prevenire la perdita o la distruzione dei dati</li>
                            </ul>

                            <div class="bg-red-950/20 border border-red-900/50 rounded-lg p-4 mt-4">
                                <h4 class="text-red-400 font-semibold mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Isolamento Multi-Tenant
                                </h4>
                                <p class="text-sm text-gray-300">
                                    Ogni Azienda dispone di un <strong class="text-white">database dedicato e isolato</strong>.
                                    I dati di un Tenant non sono accessibili da altri Tenant né dal personale di Fix-Device.it,
                                    salvo necessità tecniche di manutenzione (comunicate preventivamente).
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- 6. Terzi --}}
                    <section id="terzi">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">6.</span> Comunicazione a Soggetti Terzi
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>I dati possono essere comunicati a:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">•</span> <strong class="text-white">Stripe</strong> (pagamenti) — Responsabile del trattamento</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> <strong class="text-white">Provider hosting</strong> (server) — Responsabile del trattamento</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> <strong class="text-white">Servizi di email transazionale</strong> — Responsabile del trattamento</li>
                                <li class="flex"><span class="text-red-500 mr-2">•</span> <strong class="text-white">Autorità competenti</strong>, se richiesto per obbligo di legge</li>
                            </ul>
                            <p>
                                I dati <strong class="text-white">non vengono mai venduti</strong> né comunicati a terzi per finalità commerciali
                                senza il consenso esplicito dell'Utente.
                            </p>
                        </div>
                    </section>

                    {{-- 7. Extra-UE --}}
                    <section id="extra-ue">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">7.</span> Trasferimento Dati Extra-UE
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Alcuni dei nostri fornitori (es. Stripe) possono trasferire dati personali al di fuori dell'Unione Europea.
                                In tali casi, il trasferimento avviene nel rispetto degli artt. 44-49 del GDPR, tramite:
                            </p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Decisioni di adeguatezza della Commissione Europea</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Clausole Contrattuali Standard (SCC) approvate dalla UE</li>
                                <li class="flex"><span class="text-red-500 mr-2">✓</span> Framework come il <strong class="text-white">Data Privacy Framework UE-USA</strong></li>
                            </ul>
                        </div>
                    </section>

                    {{-- 8. Conservazione --}}
                    <section id="conservazione">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">8.</span> Tempi di Conservazione
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <div class="overflow-x-auto my-4">
                                <table class="w-full text-left border border-gray-700 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-4 py-3 text-white font-semibold">Tipologia Dati</th>
                                        <th class="px-4 py-3 text-white font-semibold">Conservazione</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Dati di registrazione</td>
                                        <td class="px-4 py-3 text-gray-300">Per tutta la durata dell'abbonamento + 30 giorni</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Dati di fatturazione</td>
                                        <td class="px-4 py-3 text-gray-300">10 anni (obbligo fiscale)</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Dati di navigazione</td>
                                        <td class="px-4 py-3 text-gray-300">Max 12 mesi</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Dati operativi (Tenant)</td>
                                        <td class="px-4 py-3 text-gray-300">Fino a cancellazione account + 30 giorni di backup</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-sm text-gray-400">
                                Al termine dei periodi indicati, i dati vengono cancellati definitivamente o anonimizzati.
                            </p>
                        </div>
                    </section>

                    {{-- 9. Diritti --}}
                    <section id="diritti">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">9.</span> Diritti dell'Interessato
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Ai sensi degli artt. 15-22 del GDPR, hai diritto di:</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3">
                                    <p class="text-white font-semibold text-sm">📥 Accesso (art. 15)</p>
                                    <p class="text-xs text-gray-400 mt-1">Ottenere copia dei tuoi dati</p>
                                </div>
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3">
                                    <p class="text-white font-semibold text-sm">✏️ Rettifica (art. 16)</p>
                                    <p class="text-xs text-gray-400 mt-1">Correggere dati inesatti</p>
                                </div>
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3">
                                    <p class="text-white font-semibold text-sm">🗑️ Cancellazione (art. 17)</p>
                                    <p class="text-xs text-gray-400 mt-1">"Diritto all'oblio"</p>
                                </div>
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3">
                                    <p class="text-white font-semibold text-sm">⏸️ Limitazione (art. 18)</p>
                                    <p class="text-xs text-gray-400 mt-1">Limitare il trattamento</p>
                                </div>
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3">
                                    <p class="text-white font-semibold text-sm">📦 Portabilità (art. 20)</p>
                                    <p class="text-xs text-gray-400 mt-1">Ricevere i dati in formato strutturato</p>
                                </div>
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3">
                                    <p class="text-white font-semibold text-sm">🚫 Opposizione (art. 21)</p>
                                    <p class="text-xs text-gray-400 mt-1">Opporsi al trattamento</p>
                                </div>
                            </div>

                            <p class="mt-4">
                                Per esercitare i tuoi diritti, invia una richiesta a
                                <a href="mailto:privacy@fix-device.it" class="text-red-400 hover:text-red-300 underline">privacy@fix-device.it</a>.
                                Risponderemo entro <strong class="text-white">30 giorni</strong>.
                            </p>

                            <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4 mt-4">
                                <p class="text-sm text-gray-300">
                                    <strong class="text-white">Reclamo al Garante:</strong> hai inoltre il diritto di proporre reclamo
                                    al Garante per la Protezione dei Dati Personali (
                                    <a href="https://www.garanteprivacy.it" target="_blank" rel="noopener" class="text-red-400 hover:text-red-300 underline">www.garanteprivacy.it</a>
                                    ).
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- 10. Cookie --}}
                    <section id="cookie">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">10.</span> Cookie
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Fix-Device.it utilizza le seguenti tipologie di cookie:</p>

                            <div class="overflow-x-auto my-4">
                                <table class="w-full text-left border border-gray-700 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-4 py-3 text-white font-semibold">Tipologia</th>
                                        <th class="px-4 py-3 text-white font-semibold">Finalità</th>
                                        <th class="px-4 py-3 text-white font-semibold">Consenso</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Tecnici</td>
                                        <td class="px-4 py-3 text-gray-300">Funzionamento del sito e sessione</td>
                                        <td class="px-4 py-3 text-green-400">Non richiesto</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Analitici</td>
                                        <td class="px-4 py-3 text-gray-300">Statistiche anonime di utilizzo</td>
                                        <td class="px-4 py-3 text-yellow-400">Richiesto</td>
                                    </tr>
                                    <tr class="hover:bg-gray-800/50 transition">
                                        <td class="px-4 py-3 text-white">Marketing</td>
                                        <td class="px-4 py-3 text-gray-300">Non utilizzati</td>
                                        <td class="px-4 py-3 text-gray-500">N/A</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p class="text-sm text-gray-400">
                                Puoi gestire le preferenze sui cookie tramite le impostazioni del tuo browser.
                            </p>
                        </div>
                    </section>

                    {{-- 11. Minori --}}
                    <section id="minori">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">11.</span> Minori
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Fix-Device.it è un servizio destinato esclusivamente ad <strong class="text-white">aziende e professionisti</strong>.
                                Non raccogliamo consapevolmente dati personali di minori di 18 anni.
                                Qualora venisse segnalata la presenza di dati di minori, provvederemo alla loro immediata cancellazione.
                            </p>
                        </div>
                    </section>

                    {{-- 12. Modifiche --}}
                    <section id="modifiche">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">12.</span> Modifiche alla Privacy Policy
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>
                                Il Titolare si riserva di modificare la presente Privacy Policy in qualsiasi momento,
                                dandone comunicazione agli Utenti registrati tramite email con almeno <strong class="text-white">30 giorni di preavviso</strong>.
                                Si consiglia di consultare periodicamente questa pagina.
                            </p>
                        </div>
                    </section>

                    {{-- 13. Contatti --}}
                    <section id="contatti">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <span class="text-red-500 mr-3">13.</span> Contatti per la Privacy
                        </h2>
                        <div class="text-gray-300 space-y-4 leading-relaxed">
                            <p>Per qualsiasi domanda relativa al trattamento dei dati personali:</p>

                            <div class="bg-gray-800 border border-gray-700 rounded-lg p-5 mt-4">
                                <p class="text-white font-semibold mb-3">Referente Privacy — Fix-Device S.r.l.</p>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <a href="mailto:privacy@fix-device.it" class="hover:text-red-400 transition">privacy@fix-device.it</a>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span>+39 3495388790</span>
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
                            <a href="{{ route('legal.terms') }}" class="text-red-400 hover:text-red-300 transition">Condizioni di Utilizzo</a>
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
