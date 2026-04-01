<?php

namespace App\Livewire;

use App\Actions\EvaluateSchoolAlignmentAction;
use Livewire\Component;

class ParentDashboard extends Component
{
    public array $childProfile = [
        'learning_style' => 'Kinesthetic',
        'emotional_needs' => 'High nurture',
        'interests' => 'Arts, Science'
    ];

    public array $schoolProfile = [
        'name' => 'Future Leaders Academy',
        'pedagogy_focus' => 'Hands-on project based',
        'school_culture' => 'Empathetic & inclusive',
        'extracurriculars' => 'STEM, Fine Arts'
    ];

    public ?array $alignmentResult = null;

    public function testAlignment(EvaluateSchoolAlignmentAction $action)
    {
        $this->alignmentResult = $action->execute($this->childProfile, $this->schoolProfile);
    }

    public function render()
    {
        return view('livewire.parent-dashboard');
    }
}
