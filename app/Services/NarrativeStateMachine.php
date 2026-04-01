<?php

namespace App\Services;

use App\Models\Story;
use App\Models\Passage;
use App\Enums\NarrativeStage;
use SM\Factory\FactoryInterface;
use SM\StateMachine\StateMachineInterface;

class NarrativeStateMachine
{
    protected StateMachineInterface $stateMachine;

    public function __construct(
        protected Story $story,
        protected FactoryInterface $factory
    ) {
        $this->stateMachine = $this->factory->get($this->story, 'narrative_journey');
    }

    /**
     * Define the "Hero's Journey" configuration for winzou/state-machine.
     */
    public static function getConfig(): array
    {
        return [
            'graph' => 'narrative_journey',
            'property_path' => 'state',
            'states' => [
                NarrativeStage::OrdinaryWorld->value,
                NarrativeStage::CallToAdventure->value,
                NarrativeStage::CrossingTheThreshold->value,
                NarrativeStage::TheOrdeal->value,
                NarrativeStage::TheReward->value,
                NarrativeStage::ReturnWithTheElixir->value,
            ],
            'transitions' => [
                'answer_call' => [
                    'from' => [NarrativeStage::OrdinaryWorld->value],
                    'to' => NarrativeStage::CallToAdventure->value,
                ],
                'enter_special_world' => [
                    'from' => [NarrativeStage::CallToAdventure->value],
                    'to' => NarrativeStage::CrossingTheThreshold->value,
                ],
                'face_ordeal' => [
                    'from' => [NarrativeStage::CrossingTheThreshold->value],
                    'to' => NarrativeStage::TheOrdeal->value,
                ],
                'seize_reward' => [
                    'from' => [NarrativeStage::TheOrdeal->value],
                    'to' => NarrativeStage::TheReward->value,
                ],
                'complete_journey' => [
                    'from' => [NarrativeStage::TheReward->value],
                    'to' => NarrativeStage::ReturnWithTheElixir->value,
                ],
            ],
            'callbacks' => [
                'after' => [
                    'on_transition_complete' => [
                        'do' => [self::class, 'handleTransition'],
                        'args' => ['object', 'transition'],
                    ],
                ],
            ],
        ];
    }

    public static function handleTransition(Story $story, string $transition): void
    {
        // Record xAPI statement or trigger events when a learner hits a milestone
    }

    public function can(string $transition): bool
    {
        return $this->stateMachine->can($transition);
    }

    public function apply(string $transition): bool
    {
        return $this->stateMachine->apply($transition);
    }
}
