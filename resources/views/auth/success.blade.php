<!-- resources/views/auth/success.blade.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Completata</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen flex items-center justify-center p-4">
<div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md text-center">
    <!-- Icona di successo -->
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full mb-6 animate-bounce">
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-3">
        Registrazione Completata!
    </h1>

    <p class="text-gray-600 mb-6">
        Il tuo ambiente dedicato è stato creato con successo.
    </p>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-left">
        <h3 class="font-semibold text-blue-900 mb-2">📧 Controlla la tua email</h3>
        <p class="text-sm text-blue-700">
            Ti abbiamo inviato le credenziali di accesso e il link al tuo pannello di controllo.
        </p>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <p class="text-sm text-gray-600 mb-2">Il tuo ambiente sarà disponibile su:</p>
        <p class="font-mono text-sm text-gray-800 bg-white px-3 py-2 rounded border">
            [subdomain].tuosito.com
        </p>
    </div>

    <div class="space-y-3">
        <a
            href="https://tuosito.com"
            class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl"
        >
            Torna al Sito Principale
        </a>

        <a
            href="mailto:supporto@tuosito.com"
            class="block text-sm text-gray-600 hover:text-blue-600 transition"
        >
            Hai bisogno di aiuto? Contattaci
        </a>
    </div>
</div>
</body>
</html>
