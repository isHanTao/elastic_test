<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Poetry;
use App\Models\Sentence;
use App\User;
use Illuminate\Console\Command;

class Search extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search {key} {type=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $key = $this->argument('key');
        $type = $this->argument('type');
        switch ($type){
            case 0: dd(Sentence::search($key)->get()->toArray());
            case 1: dd(Author::search($key)->get()->toArray());
        }
    }
}
