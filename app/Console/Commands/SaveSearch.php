<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Search;

class SaveSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:save {query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a record to search table (for testing purposes)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Search::store($this->argument('query'));
    }
}
