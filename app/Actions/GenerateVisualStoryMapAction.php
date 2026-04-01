<?php

namespace App\Actions;

use App\Models\Story;

/**
 * Story Visualizer Action
 * Generates DOT syntax for Graphviz to map branching narrative paths.
 */
class GenerateVisualStoryMapAction
{
    public function execute(Story $story): string
    {
        $dot = "digraph StoryMap {\n";
        $dot .= "  rankdir=LR;\n";
        $dot .= "  node [shape=box, style=rounded];\n";

        foreach ($story->passages as $passage) {
            $stageColor = $this->getStageColor($passage->stage);
            $dot .= "  \"{$passage->id}\" [label=\"{$passage->title}\", color=\"{$stageColor}\"];\n";

            foreach ($passage->choices as $choice) {
                $label = addslashes($choice->label);
                $dot .= "  \"{$passage->id}\" -> \"{$choice->destination_passage_id}\" [label=\"{$label}\"];\n";
            }
        }

        $dot .= "}";

        return $dot;
    }

    protected function getStageColor($stage): string
    {
        return match ($stage->value) {
            'ordinary_world' => '#D1D5DB',
            'call_to_adventure' => '#FCD34D',
            'the_ordeal' => '#EF4444',
            'return_with_elixir' => '#10B981',
            default => '#3B82F6'
        };
    }
}
