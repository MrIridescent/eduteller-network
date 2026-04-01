<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <header class="mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight font-interface">
            Parent <span class="text-edu-mentor">Advocacy</span> Dashboard
        </h1>
        <p class="mt-4 text-lg text-gray-500">
            Making intentional school choices using the <span class="font-bold text-edu-hero">F.I.T.S Model™</span>.
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Profile Inputs (Mock) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="mr-2">🧒</span> Child Profile
                </h3>
                <div class="space-y-3">
                    @foreach($childProfile as $key => $value)
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">{{ str_replace('_', ' ', $key) }}</label>
                            <p class="text-gray-700 font-medium">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="mr-2">🏫</span> School Profile
                </h3>
                <div class="space-y-3">
                    @foreach($schoolProfile as $key => $value)
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">{{ str_replace('_', ' ', $key) }}</label>
                            <p class="text-gray-700 font-medium">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <button 
                wire:click="testAlignment"
                class="w-full py-4 bg-edu-mentor text-white rounded-xl font-bold shadow-lg hover:bg-blue-600 transition-all transform hover:-translate-y-1"
            >
                Run Alignment Test 🚀
            </button>
        </div>

        {{-- Results Area --}}
        <div class="lg:col-span-2">
            @if($alignmentResult)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 animate-fade-in">
                    <div class="p-8 bg-gradient-to-br from-blue-50 to-white border-b border-gray-100">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-bold text-gray-900">Alignment Analysis</h2>
                            <div class="text-center">
                                <div class="text-4xl font-black text-edu-elixir">{{ number_format($alignmentResult['alignment_score'] * 100) }}%</div>
                                <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Match Score</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            @foreach($alignmentResult['breakdown'] as $metric => $score)
                                <div class="bg-white p-4 rounded-xl shadow-sm border border-blue-100">
                                    <div class="text-xs font-bold text-gray-400 uppercase mb-1">{{ str_replace('_', ' ', $metric) }}</div>
                                    <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-edu-mentor" style="width: {{ $score * 100 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div @class([
                            'p-4 rounded-xl border-2 flex items-center space-x-3',
                            'bg-green-50 border-green-200 text-green-800' => $alignmentResult['alignment_score'] >= 0.8,
                            'bg-yellow-50 border-yellow-200 text-yellow-800' => $alignmentResult['alignment_score'] < 0.8 && $alignmentResult['alignment_score'] >= 0.5,
                            'bg-red-50 border-red-200 text-red-800' => $alignmentResult['alignment_score'] < 0.5,
                        ])>
                            <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-bold text-sm">{{ $alignmentResult['recommendation'] }}</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <span class="mr-2">📝</span> Personalized Transition Support (Step S)
                        </h3>
                        <div class="space-y-4">
                            @foreach($alignmentResult['transition_plan'] as $step => $instruction)
                                <div class="flex items-start space-x-4 group">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-xs font-black text-gray-400 group-hover:bg-edu-mentor group-hover:text-white transition-all">
                                        {{ filter_var($step, FILTER_SANITIZE_NUMBER_INT) }}
                                    </div>
                                    <div class="flex-1 pt-1">
                                        <p class="text-gray-700 leading-relaxed font-medium">{{ $instruction }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="h-full flex flex-col items-center justify-center p-12 bg-edu-paper border-4 border-dashed border-gray-200 rounded-3xl opacity-50">
                    <span class="text-6xl mb-4">🕵️‍♀️</span>
                    <p class="text-gray-500 font-bold text-center">Enter the child and school profiles to investigate alignment.</p>
                </div>
            @endif
        </div>
    </div>
</div>
