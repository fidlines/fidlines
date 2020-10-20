<?php

namespace Fidlines\Fidlines;

use GuzzleHttp\Client;

class Fidlines
{
    public static function getRandomVerse()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://fidlines.fun/api/v0/random', ['hearders' => ['Accept' => 'application/json']]);
        return $response->getStatusCode() == 200 ?  json_decode($response->getBody()->getContents(), true)['data']['bar'] : $response->getStatusCode();
    }

    public static function getRandomVerseRaw()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://fidlines.fun/api/v0/random', ['hearders' => ['Accept' => 'application/json']]);
        return $response->getStatusCode() == 200 ?  json_decode($response->getBody()->getContents(), true)['data'] : $response->getStatusCode();
    }
}
