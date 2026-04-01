<div class="flex items-start space-x-4 p-6 bg-blue-50 border-l-4 border-edu-mentor rounded-r-lg shadow-sm animate-fade-in">
    <div class="flex-shrink-0">
        <div class="w-12 h-12 bg-edu-mentor rounded-full flex items-center justify-center text-white">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.582.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
    </div>
    <div class="flex-1">
        <h4 class="text-sm font-bold text-edu-mentor uppercase tracking-widest mb-1">Mentor Guidance</h4>
        <div class="text-gray-800 font-narrative text-lg leading-relaxed italic">
            {{ $slot }}
        </div>
    </div>
</div>
