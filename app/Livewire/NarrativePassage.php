<?php

namespace App\Livewire;

use App\Actions\DispatchXApiStatementAction;
use App\Actions\ProcessBranchingChoiceAction;
use App\Models\Choice;
use App\Models\Passage;
use Livewire\Component;

class NarrativePassage extends Component
{
    public Passage $passage;
    public bool $isLoaded = false;

    public function mount(Passage $passage)
    {
        $this->passage = $passage;
        $this->isLoaded = true;
    }

    public function makeChoice(string $choiceId, ProcessBranchingChoiceAction $action, DispatchXApiStatementAction $xapi)
    {
        $choice = Choice::findOrFail($choiceId);
        
        try {
            // 1. Process the transition logic
            $nextPassage = $action->execute(auth()->user(), $choice);
            
            // 2. Dispatch xAPI Statement (Learner chose Path X)
            $xapi->execute(auth()->user(), 'chose', $this->passage, [
                'choice_label' => $choice->label,
                'destination_id' => $nextPassage->id
            ]);

            // 3. Update state for Livewire (Seamless transition)
            $this->passage = $nextPassage;
            
            // 4. Scroll to top or trigger animation via Alpine.js
            $this->dispatch('passage-updated');
            
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.narrative-passage');
    }
}
