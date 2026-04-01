<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-edu-paper">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eduteller - Narrative Educational Portal</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full font-interface antialiased text-gray-900 selection:bg-edu-hero/30">
    
    {{-- Skip to Content (WCAG 2.1) --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-edu-mentor font-bold">
        Skip to main content
    </a>

    <div class="min-h-full flex flex-col">
        {{-- Main Navigation --}}
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-40" role="navigation">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-black tracking-tighter text-gray-900">
                            EDU<span class="text-edu-hero">TELLER</span>
                        </span>
                    </div>
                    
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="#" class="border-edu-hero text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold">Stories</a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">F.I.T.S Model™</a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Studio</a>
                    </div>

                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <button type="button" class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-full text-white bg-edu-mentor shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-edu-mentor">
                                <span>Sign In</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Main Content Area --}}
        <main id="main-content" class="flex-1" role="main">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-gray-100 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-gray-400 font-medium">
                    &copy; {{ date('Y') }} Eduteller Network Limited. Advocating for child-school alignment.
                </p>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
