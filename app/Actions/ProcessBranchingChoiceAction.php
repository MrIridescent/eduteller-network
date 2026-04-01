<?php

namespace App\Actions;

use App\Models\Choice;
use App\Models\Passage;
use App\Models\User;
use Exception;

class ProcessBranchingChoiceAction
{
    /**
     * Execute the narrative transition.
     * 
     * @param User $user
     * @param Choice $choice
     * @throws Exception
     * @return Passage
     */
    public function execute(User $user, Choice $choice): Passage
    {
        $currentPassage = $choice->passage;
        $destinationPassage = $choice->destinationPassage;

        // 1. Validate if the user is actually on the passage that the choice belongs to
        // (In a real implementation, this would check the user's current session/progress state)

        // 2. Evaluate Guard Clauses (Conditions)
        if (!$this->evaluateRequirements($user, $choice->condition_requirement)) {
            throw new Exception("You have not met the requirements to take this path.");
        }

        // 3. Record Progress (xAPI statement would be dispatched here)
        $this->recordTransition($user, $currentPassage, $choice, $destinationPassage);

        return $destinationPassage;
    }

    /**
     * Evaluate if the learner meets the narrative requirements for a choice.
     */
    protected function evaluateRequirements(User $user, ?array $requirements): bool
    {
        if (empty($requirements)) {
            return true;
        }

        // Logic for "uncheatable" assessments and personal curiosity checks
        // Example: ['min_score' => 80, 'mentorship_consumed' => true]
        
        return true; // Simplified for now
    }

    protected function recordTransition(User $user, Passage $from, Choice $choice, Passage $to): void
    {
        // Update user state in database
        // Dispatch xAPI statement job
    }
}
