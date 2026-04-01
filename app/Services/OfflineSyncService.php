<?php

namespace App\Services;

use App\Models\User;
use App\Models\Passage;
use App\Models\ChildProfile;
use Illuminate\Support\Facades\DB;
use Exception;

class OfflineSyncService
{
    /**
     * Process multiple progress markers sent from IndexedDB once the user is back online.
     * 
     * @param User $user
     * @param array $markers
     * @return array
     */
    public function syncLearningProgress(User $user, array $markers): array
    {
        $successfulSyncs = 0;
        $failedSyncs = 0;

        foreach ($markers as $marker) {
            try {
                DB::transaction(function () use ($user, $marker) {
                    // 1. Process narrative progress
                    if (isset($marker['passage_id'])) {
                        $this->updateNarrativeState($user, $marker);
                    }

                    // 2. Process assessment data
                    if (isset($marker['assessment_data'])) {
                        $this->saveOfflineAssessment($user, $marker);
                    }
                });

                $successfulSyncs++;
            } catch (Exception $e) {
                $failedSyncs++;
                // Log sync failure for internal audit
            }
        }

        return [
            'synced' => $successfulSyncs,
            'failed' => $failedSyncs,
            'timestamp' => now()->toIso8601String(),
        ];
    }

    protected function updateNarrativeState(User $user, array $marker): void
    {
        // Record choice in passage_user pivot table with ULID
        DB::table('passage_user')->insert([
            'id' => $marker['ulid'] ?? (string) str()->ulid(),
            'user_id' => $user->id,
            'passage_id' => $marker['passage_id'],
            'completed_at' => $marker['completed_at'] ?? now(),
            'synced_at' => now(),
            'metadata' => json_encode($marker['metadata'] ?? []),
        ]);
    }

    protected function saveOfflineAssessment(User $user, array $marker): void
    {
        $child = ChildProfile::find($marker['child_id']);
        
        if ($child) {
            $child->update([
                'traits' => array_merge($child->traits, $marker['assessment_data']['traits'] ?? []),
            ]);
        }
    }
}
