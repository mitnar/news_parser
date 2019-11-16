<?php

namespace App\Services;

use App\Contracts\ParserContract;
use DiDom\Document;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class ArticleParserService implements ParserContract
{
    public function parse(string $url)
    {
        $client = new Client();
        try {
            $response = $client->get($url);
        } catch (TransferException $e) {
            abort(500, __('errors.url_unavailable', ['url' => $url]));
        }

        $html = $response->getBody()->getContents();

        $document = new Document($html);
        $image = $document->find(".article__main-image__link");

        return empty($image) ? null : $image[0];
    }
}