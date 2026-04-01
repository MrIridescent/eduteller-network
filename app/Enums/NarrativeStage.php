<?php

namespace App\Enums;

enum NarrativeStage: string
{
    case ORDINARY_WORLD = 'ordinary_world';
    case CALL_TO_ADVENTURE = 'call_to_adventure';
    case REFUSAL_OF_CALL = 'refusal_of_call';
    case MEETING_MENTOR = 'meeting_mentor';
    case CROSSING_THRESHOLD = 'crossing_threshold';
    case TRIALS_AND_ALLIES = 'trials_and_allies';
    case APPROACH_INMOST_CAVE = 'approach_inmost_cave';
    case THE_ORDEAL = 'the_ordeal';
    case THE_REWARD = 'the_reward';
    case THE_ROAD_BACK = 'the_road_back';
    case RESURRECTION = 'resurrection';
    case RETURN_WITH_ELIXIR = 'return_with_elixir';
}
