<?php

namespace App\Services;

use App\Contracts\ParserContract;
use DiDom\Document;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class RbkNewsParserService implements ParserContract
{
    public function parse(string $url)
    {
        $client = new Client();
        try {
            $response = $client->get($url);
        } catch(TransferException $e) {
            abort(500, __('errors.url_unavailable', ['url' => $url]));
        }

        $html = $response->getBody()->getContents();

        $document = new Document($html);
        $newsTags = $document->find('.news-feed__item');

        $news = [];

        foreach($newsTags as $newsTag) {
            $news[] = $this->parseNews($newsTag);
        }

        return $news;
    }

    private function parseNews($news)
    {
        $name = trim($news->find('.news-feed__item__title')[0]->text());
        $url = trim($news->getAttribute('href'));
        $date = trim($news->find('.news-feed__item__date-text')[0]->text());

        return [
            'name' => $name,
            'url' => $url,
            'date' => $date,
        ];
    }
}