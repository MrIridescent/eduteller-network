<?php

namespace App\Livewire;

use App\Actions\GenerateVisualStoryMapAction;
use App\Models\Story;
use App\Models\Passage;
use Livewire\Component;

class StudioDashboard extends Component
{
    public $stories;
    public ?Story $selectedStory = null;
    public string $dotGraph = '';

    public function mount()
    {
        $this->stories = Story::where('author_id', auth()->id())->get();
    }

    public function selectStory(string $storyId, GenerateVisualStoryMapAction $action)
    {
        $this->selectedStory = Story::with(['passages.choices'])->findOrFail($storyId);
        $this->dotGraph = $action->execute($this->selectedStory);
    }

    public function addPassage()
    {
        // Simple logic for adding a new narrative node
        $this->selectedStory->passages()->create([
            'content' => 'The journey continues...',
            'stage' => 'trials_and_allies',
            'content_type' => 'text'
        ]);
        
        $this->selectedStory->load('passages');
    }

    public function render()
    {
        return view('livewire.studio-dashboard');
    }
}
