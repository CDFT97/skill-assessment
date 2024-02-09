<?php

namespace App\Console\Commands;

use App\Repositories\ApiRateLimitRepository;
use Illuminate\Console\Command;

class QuoteResetCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quoteapi:resetcounter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the requests per minute limit counter for the https://dummyjson.com/docs/quotes api.';

    protected $apiRateLimitRepository;

    public function __construct(ApiRateLimitRepository $apiRateLimitRepository)
    {
        parent::__construct();
        $this->apiRateLimitRepository = $apiRateLimitRepository;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        \Log::info('Reseting dummyjson.com/quotes counter');
        $this->apiRateLimitRepository->resetCounter('https://dummyjson.com/quotes');
    }
}
