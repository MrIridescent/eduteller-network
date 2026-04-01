<div class="relative min-h-screen bg-edu-paper font-narrative selection:bg-edu-hero/20">
    {{-- Narrative Background Aura --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-edu-mentor/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 -right-24 w-64 h-64 bg-edu-hero/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto py-16 px-6 sm:px-12">
        {{-- Story Progression --}}
        <div class="mb-12">
            {{ $header ?? '' }}
        </div>

        {{-- Main Narrative Content --}}
        <div class="bg-white rounded-[2.5rem] shadow-narrative border border-gray-100/50 p-8 sm:p-16 relative overflow-hidden">
            {{-- Atmospheric Ink-Splat/Texture --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-hero-glow pointer-events-none opacity-50"></div>
            
            <div class="relative prose prose-lg lg:prose-xl max-w-none prose-ink text-edu-ink leading-loose">
                {{ $slot }}
            </div>
        </div>

        {{-- Interactive Choices (Floating Bottom) --}}
        <div class="mt-12">
            {{ $choices ?? '' }}
        </div>
    </div>
</div>
