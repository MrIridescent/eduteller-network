<?php

namespace App\Actions;

use App\Models\ChildProfile;
use App\Models\School;
use App\Models\Investigation;

class CalculateChildSchoolFitAction
{
    /**
     * Calculate the alignment between a child's needs and a school's actual environment.
     * 
     * @param ChildProfile $child
     * @param School $school
     * @return array
     */
    public function execute(ChildProfile $child, School $school): array
    {
        $latestInvestigation = $school->investigations()->latest()->first();

        if (!$latestInvestigation) {
            return [
                'fit_score' => 0,
                'status' => 'No recent investigation data available.',
            ];
        }

        // 1. Map Child Traits to School Attributes
        // Simplified Logic: Weighted average of scores
        $weights = [
            'culture' => 0.4,
            'safety' => 0.3,
            'nurture' => 0.3,
        ];

        $score = ($latestInvestigation->culture_score * $weights['culture']) +
                 ($latestInvestigation->safety_score * $weights['safety']) +
                 ($latestInvestigation->nurture_score * $weights['nurture']);

        // Normalize to 0-100 (assuming scores are 1-5)
        $normalizedScore = ($score / 5) * 100;

        // 2. Trait-specific Alignment (Optional refinement)
        $alignmentInsights = $this->generateInsights($child, $latestInvestigation);

        return [
            'fit_score' => $normalizedScore,
            'investigation_date' => $latestInvestigation->investigation_date->format('Y-m-d'),
            'insights' => $alignmentInsights,
            'recommendation' => $normalizedScore >= 75 ? 'Highly Recommended' : ($normalizedScore >= 50 ? 'Proceed with Caution' : 'Avoid'),
        ];
    }

    protected function generateInsights(ChildProfile $child, Investigation $investigation): array
    {
        $insights = [];

        if ($investigation->safety_score < 3) {
            $insights[] = "Safety protocols at this school do not meet Eduteller standards for active children.";
        }

        if ($investigation->nurture_score >= 4 && in_array('sensitive', $child->traits)) {
            $insights[] = "The school's high nurture score aligns well with your child's sensitive personality.";
        }

        return $insights;
    }
}
