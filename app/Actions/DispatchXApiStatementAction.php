<?php

namespace App\Actions;

use App\Jobs\ProcessXApiStatement;
use App\Models\Passage;
use App\Models\User;

class DispatchXApiStatementAction
{
    /**
     * Dispatch an xAPI statement asynchronously.
     * Statement structure: [Actor] [Verb] [Object] [Result] [Context]
     * 
     * @param User $user The Actor
     * @param string $verb The action performed (e.g., 'crossed', 'chose', 'completed')
     * @param Passage $passage The Object/Activity
     * @param array $result Optional results (score, completion, success)
     */
    public function execute(User $user, string $verb, Passage $passage, array $result = []): void
    {
        $statement = [
            'actor' => [
                'mbox' => "mailto:{$user->email}",
                'name' => $user->name,
                'objectType' => 'Agent'
            ],
            'verb' => [
                'id' => "http://adlnet.gov/expapi/verbs/$verb",
                'display' => ['en-US' => $verb]
            ],
            'object' => [
                'id' => route('api.v1.passages.show', $passage->id),
                'definition' => [
                    'name' => ['en-US' => $passage->title],
                    'description' => ['en-US' => $passage->content],
                    'type' => "http://adlnet.gov/expapi/activities/narrative-node"
                ],
                'objectType' => 'Activity'
            ],
            'result' => $result,
            'timestamp' => now()->toIso8601String(),
            'context' => [
                'registration' => $user->current_registration_id ?? null,
                'extensions' => [
                    'http://eduteller.com/xapi/narrative-stage' => $passage->stage->value,
                    'http://eduteller.com/xapi/story-id' => $passage->story_id
                ]
            ]
        ];

        // Dispatch to background queue to prevent UI blocking
        ProcessXApiStatement::dispatch($statement);
    }
}
