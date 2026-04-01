<x-narrative.shell>
    <x-slot:header>
        <x-hero-progress :currentStage="$passage->stage" />
    </x-slot:header>

    <div x-data="{ animating: false }" x-on:passage-updated.window="animating = true; setTimeout(() => animating = false, 500)">
        <div :class="animating ? 'opacity-0 translate-y-4' : 'opacity-100 translate-y-0'" class="transition-all duration-700 ease-in-out">
            
            {{-- Story Content --}}
            @if($passage->title)
                <h1 class="text-4xl font-black text-edu-ink tracking-tight mb-12 border-b border-gray-100 pb-6 font-interface">
                    {{ $passage->title }}
                </h1>
            @endif

            <div class="narrative-content prose prose-2xl prose-edu font-narrative text-edu-ink leading-[1.8] drop-shadow-sm">
                {!! $passage->content !!}
            </div>

            <x-narrative.separator />

            {{-- Specialized Mentor Box --}}
            @if($passage->metadata['has_mentor'] ?? false)
                <div class="my-16">
                    <x-mentor-box>
                        {{ $passage->metadata['mentor_text'] ?? 'Listen closely, for this choice defines your journey.' }}
                    </x-mentor-box>
                </div>
            @endif
        </div>
    </div>

    <x-slot:choices>
        @if($passage->choices->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                @foreach($passage->choices->sortBy('order') as $choice)
                    <x-choice-card :choice="$choice" />
                @endforeach
            </div>
        @elseif($passage->is_end)
            <div class="text-center py-12">
                <span class="inline-flex items-center px-8 py-4 rounded-full bg-edu-elixir text-white font-black text-xl shadow-hero scale-110">
                    The Journey Returns 🏆
                </span>
            </div>
        @endif
    </x-slot:choices>
</x-narrative.shell>
