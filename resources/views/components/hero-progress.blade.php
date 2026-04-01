@props(['currentStage'])

@php
    $stages = [
        'ordinary_world' => '🏠',
        'call_to_adventure' => '✉️',
        'meeting_mentor' => '🧙',
        'crossing_threshold' => '🌉',
        'trials_and_allies' => '⚔️',
        'the_ordeal' => '🔥',
        'the_reward' => '💎',
        'return_with_elixir' => '🏆'
    ];
    
    $found = false;
@endphp

<div class="flex items-center justify-between px-4 py-8 relative overflow-hidden">
    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-100 -translate-y-1/2 z-0"></div>
    
    @foreach($stages as $stage => $emoji)
        @php
            $isCompleted = !$found && $stage !== $currentStage->value;
            if ($stage === $currentStage->value) $found = true;
            $isCurrent = $stage === $currentStage->value;
        @endphp
        
        <div class="relative z-10 flex flex-col items-center group">
            <div @class([
                'w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500',
                'bg-edu-elixir text-white scale-110 shadow-lg' => $isCompleted,
                'bg-edu-hero text-white scale-125 shadow-xl ring-4 ring-white' => $isCurrent,
                'bg-white text-gray-400 border-2 border-gray-200' => !$isCompleted && !$isCurrent
            ])>
                <span class="text-lg">{{ $emoji }}</span>
            </div>
            
            <div @class([
                'absolute -bottom-6 whitespace-nowrap text-[10px] font-bold uppercase tracking-tighter opacity-0 group-hover:opacity-100 transition-opacity',
                'text-edu-elixir' => $isCompleted,
                'text-edu-hero' => $isCurrent,
                'text-gray-400' => !$isCompleted && !$isCurrent
            ])>
                {{ str_replace('_', ' ', $stage) }}
            </div>
        </div>
    @endforeach
</div>
