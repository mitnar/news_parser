<?php

namespace App\Http\Controllers;

use App\News;
use App\Services\ArticleParserService;

class NewsController extends Controller
{
    private $articleParserService;

    public function __construct(ArticleParserService $articleParserService)
    {
        $this->articleParserService = $articleParserService;
    }

    public function getAll()
    {
        $news = News::all();

        return view('news', ['news' => $news]);
    }

    public function getNews(News $news)
    {
        $articleImage = $this->articleParserService->parse($news->url);

        return view('article', [
            'articleName' => $news->name,
            'article' => $articleImage
        ]);
    }
}