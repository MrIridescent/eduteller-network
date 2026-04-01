<?php

namespace App\Jobs;

use App\Services\LrsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessXApiStatement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $statement;

    public function __construct(array $statement)
    {
        $this->statement = $statement;
    }

    public function handle(LrsService $lrs): void
    {
        // Push to the internal LRS or external Learning Locker/Rustici
        $lrs->sendStatement($this->statement);
    }
}
