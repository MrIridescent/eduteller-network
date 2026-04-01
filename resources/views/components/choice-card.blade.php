@props(['choice'])

<button 
    wire:click="makeChoice('{{ $choice->id }}')"
    class="w-full text-left p-6 border-2 border-gray-200 rounded-xl hover:border-edu-hero hover:bg-edu-paper transition-all duration-300 group focus:outline-none focus:ring-4 focus:ring-edu-hero/20 animate-slide-up"
>
    <div class="flex items-center justify-between">
        <span class="text-lg font-interface font-medium text-gray-700 group-hover:text-edu-hero transition-colors">
            {{ $choice->label }}
        </span>
        <svg class="w-6 h-6 text-gray-300 group-hover:text-edu-hero transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
    </div>
</button>
