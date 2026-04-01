<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row gap-8 h-[80vh]">
        
        {{-- Sidebar: Story Inventory --}}
        <div class="w-full md:w-64 flex-shrink-0 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-50">
                <h3 class="text-lg font-black text-gray-900 tracking-tight">Studio <span class="text-edu-hero">Inventory</span></h3>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 space-y-2">
                @foreach($stories as $story)
                    <button 
                        wire:click="selectStory('{{ $story->id }}')"
                        @class([
                            'w-full text-left p-4 rounded-2xl transition-all duration-300',
                            'bg-edu-paper border-2 border-edu-mentor shadow-sm' => $selectedStory && $selectedStory->id === $story->id,
                            'hover:bg-gray-50 border-2 border-transparent' => !$selectedStory || $selectedStory->id !== $story->id
                        ])
                    >
                        <div class="text-sm font-bold truncate">{{ $story->title }}</div>
                        <div class="text-[10px] text-gray-400 font-black uppercase">{{ $story->state->value }}</div>
                    </button>
                @endforeach

                <button class="w-full p-4 border-2 border-dashed border-gray-200 rounded-2xl text-gray-400 font-bold text-sm hover:border-edu-hero hover:text-edu-hero transition-all">
                    + New Story
                </button>
            </div>
        </div>

        {{-- Main Editor/Viewer --}}
        <div class="flex-1 bg-white rounded-3xl shadow-xl border border-gray-100 flex flex-col overflow-hidden">
            @if($selectedStory)
                <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">{{ $selectedStory->title }}</h2>
                        <p class="text-sm text-gray-400 font-medium">{{ $selectedStory->passages->count() }} Narrative Nodes</p>
                    </div>
                    <div class="flex space-x-3">
                        <button wire:click="addPassage" class="px-6 py-2 bg-edu-mentor text-white rounded-full font-bold text-sm shadow-sm hover:bg-blue-600 transition-all">
                            Add Passage
                        </button>
                        <button class="px-6 py-2 border-2 border-gray-200 rounded-full font-bold text-sm hover:border-edu-ink transition-all">
                            Preview Journey
                        </button>
                    </div>
                </div>

                <div class="flex-1 flex overflow-hidden">
                    {{-- Passage List --}}
                    <div class="w-80 border-r border-gray-50 overflow-y-auto p-6 space-y-4">
                        @foreach($selectedStory->passages as $passage)
                            <div class="p-4 bg-gray-50 rounded-xl border border-transparent hover:border-edu-hero transition-all cursor-pointer group">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-[10px] font-black uppercase text-gray-400 group-hover:text-edu-hero">{{ str_replace('_', ' ', $passage->stage->value) }}</span>
                                </div>
                                <p class="text-sm font-bold text-gray-800 line-clamp-2 leading-relaxed">{{ strip_tags($passage->content) }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Visual Map (Graphviz Simulation) --}}
                    <div class="flex-1 bg-edu-paper relative">
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-12 text-center">
                            <div class="w-full h-full border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center bg-white/50 backdrop-blur-sm">
                                <div class="p-8 bg-white shadow-hero rounded-3xl max-w-md">
                                    <h4 class="text-lg font-black mb-4">Visual Journey Map</h4>
                                    <pre class="text-[10px] text-left bg-gray-900 text-green-400 p-4 rounded-xl overflow-x-auto font-mono mb-4">{{ $dotGraph }}</pre>
                                    <p class="text-xs text-gray-400 font-medium italic">Integration with d3-graphviz or vis.js would render this as an interactive map for the educator.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                    <span class="text-6xl mb-6">🖋️</span>
                    <h3 class="text-xl font-black">Select a story to begin crafting</h3>
                    <p class="text-sm font-medium">Your narrative-based educational studio awaits.</p>
                </div>
            @endif
        </div>
    </div>
</div>
