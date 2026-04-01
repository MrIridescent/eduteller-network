<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Services\LrsService;

class HealthCheckController extends Controller
{
    /**
     * Perform a deep health check of the Eduteller infrastructure.
     */
    public function __invoke(LrsService $lrs): JsonResponse
    {
        $status = [
            'app' => 'operational',
            'timestamp' => now()->toIso8601String(),
            'services' => [
                'database' => $this->checkDatabase(),
                'cache' => $this->checkRedis(),
                'xapi_lrs' => $this->checkLrs($lrs),
            ],
            'system' => [
                'php_version' => PHP_VERSION,
                'disk_usage' => $this->getDiskUsage(),
            ]
        ];

        $statusCode = collect($status['services'])->contains('down') ? 503 : 200;

        return response()->json($status, $statusCode);
    }

    protected function checkDatabase(): string
    {
        try {
            DB::connection()->getPdo();
            return 'up';
        } catch (\Exception $e) {
            return 'down';
        }
    }

    protected function checkRedis(): string
    {
        try {
            Redis::ping();
            return 'up';
        } catch (\Exception $e) {
            return 'down';
        }
    }

    protected function checkLrs(LrsService $lrs): string
    {
        return $lrs->ping() ? 'up' : 'down';
    }

    protected function getDiskUsage(): string
    {
        $free = disk_free_space("/");
        $total = disk_total_space("/");
        return round(($total - $free) / $total * 100, 2) . '%';
    }
}
