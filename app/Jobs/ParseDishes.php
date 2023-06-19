<?php

namespace App\Jobs;

use App\Models\ParserHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseDishes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $history = ParserHistory::latest()->first();

        exec("python3 ".base_path("app/Services/Parser/main.py"), $output, $result);

        if ($result == 0) {
            exec("mv ".base_path("app/Services/Parser/output.json") . " " . base_path("storage/app/data/dishes.json"));
            exec("php artisan app:import-dishes");

            $history->status = ParserHistory::COMPLETED;
        } else {
            $history->status = ParserHistory::FAILED;
        }
        $history->save();
    }
}
