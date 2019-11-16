<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contracts\ParserContract;
use App\News;

class ParseNews extends Command
{
    protected $signature = 'parse:news';

    protected $description = 'Parse rbk news';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ParserContract $rbkNewsParserService)
    {
        $news = $rbkNewsParserService->parse(config('apiUrl.news'));

        News::truncate();

        foreach($news as $curNews) {
            News::create($curNews);
        }
    }
}
