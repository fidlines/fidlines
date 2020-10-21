# FidQ Fidlines API & PHP Pakage

# API

## Overview

In partnership with [Twitter Community](https://twitter.com/), we're making bars|lines|michano|mistari from Fareed Kubanda (Fid Q) public available in near real time. Fidlines enables easy access of FidQ's lines from [Android](https://developer.android.com/), [iOS](https://firebase.google.com/docs/ios/setup) and the [web](https://firebase.google.com/docs/web/setup).

Please email contact@fidlines.fun if you find any bugs.

## URI and Versioning

We hope to improve the API over time. The changes won't always be backward compatible, so we're going to use versioning. This first iteration will have URIs prefixed with `http://fidlines.fun/api/v0/` and is structured as described below. There is currently no rate limit.

For versioning purposes, only removal of a non-optional field or alteration of an existing field will be considered incompatible changes. _Consumers should gracefully handle additional fields they don't expect, and simply ignore them._

## Design

The v0 API is essentially a dump of our in-memory data structures. We know, what works great locally in memory isn't so hot over the network. Many of the awkward things are just the way fidlines works internally. Want to know the total number of comments on an article? Traverse the tree and count.

I'm not saying this to defend it - It's not the ideal public API, but it's the one we could release in the time we had. While awkward, it's possible to implement most of actions using it.

## Lines

Refered to as bars, lines, mistari, michano in different formats can be retrived and in only one way be posted to this API
`/v0/line[s]`.

All lines have some of the following properties, with required properties in bold:

| Field   | Mandate  | Description                                  |
| ------- | -------- | -------------------------------------------- |
| **id**  | Required | The lines's unique id.                       |
| **bar** | Required | This is is the fidline, a bar from fidQ sing |
| song    | Optional | The song from which the bar is extracted     |
| ft      | Optional | This is a name of person featured in a song  |
| album   | Optional | The album from which the song belongs        |
| year    | Optional | The year corresponding son was released      |
| url     | Optional | The online resource the song can be retrived |

### Random line

Method: GET
For example, a random bar: `http://fidlines.fun/api/v0/random`

Sample Respose:

```json
{
  "data": {
    "id": "55f8545b04927b",
    "bar": "Ikiwa msafi ana zamani, basi mchafu nae ana future",
    "song": "Mzee Mbuzi",
    "ft": "Gifted",
    "url": "https://www.youtube.com/watch?v=-RXbaiuxfkw",
    "album": "KitaaOLOJIA",
    "year": 2019
  }
}
```

### Multiple lines

Method: GET
Multiple lines can be retived with: `http://fidlines.fun/api/v0/lines` with default pagination of 20 lines.
Pagnation can be altered by number of bars as adding `?pagination={number}` like `http://fidlines.fun/api/v0/lines?pagination=45`

Sample Response:

```json
{
  "data": [
    {
      "id": "55f84379934461",
      "bar": "Hic rerum error dicta officiis voluptas. Est provident repellendus eum eveniet.",
      "song": "Eligendi distinctio.",
      "ft": "Prof. Grady Leuschke",
      "url": "http://www.gutkowski.biz/",
      "album": "Placeat.",
      "year": "1982"
    },
    ...{
      "id": "55f8437993ca90",
      "bar": "Modi qui harum similique voluptate nulla id tempore quos. Quam in alias modi.",
      "song": "Ducimus rerum quasi.",
      "ft": "Dr. Nathan Boehm",
      "url": "http://kozey.com/architecto-nobis-dolor-ratione-quia-hic-consectetur",
      "album": "Sint.",
      "year": "1972"
    }
  ],
  "links": {
    "first": "http://fidlines.fun/api/v0/lines?page=1",
    "last": "http://fidlines.fun/api/v0/lines?page=3",
    "prev": null,
    "next": "http://fidlines.fun/api/v0/lines?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "links": [
      {
        "url": null,
        "label": "Previous",
        "active": false
      },
      {
        "url": "http://fidlines.fun/api/v0/lines?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": "http://fidlines.fun/api/v0/lines?page=2",
        "label": 2,
        "active": false
      },
      {
        "url": "http://fidlines.fun/api/v0/lines?page=3",
        "label": 3,
        "active": false
      },
      {
        "url": "http://fidlines.fun/api/v0/lines?page=2",
        "label": "Next",
        "active": false
      }
    ],
    "path": "http://fidlines.fun/api/v0/lines",
    "per_page": "42",
    "to": 42,
    "total": 99
  }
}
```

### Specific line

Method: GET
One can retrive a specific bar by its unique id like: `http://fidlines.fun/api/v0/line/{id}` example `http://fidlines.fun/api/v0/line/55f8545b04927b`

Sample response:

```json
{
  "data": {
    "id": "55f8545b04927b",
    "bar": "Ikiwa msafi ana zamani, basi mchafu nae ana future",
    "song": "Mzee Mbuzi",
    "ft": "Gifted",
    "url": "https://www.youtube.com/watch?v=-RXbaiuxfkw",
    "album": "KitaaOLOJIA",
    "year": 2019
  }
}
```

### Add bar line

Method: POST
Endpoint: `http://fidlines.fun/api/v0/line`
This will add new bar but unless it is verified by langage cheacker the wont be publicly retrivable

Sample Request:

```json
{
  "bar": "Ikiwa msafi ana zamani, basi mchafu nae ana future",
  "song": "Mzee Mbuzi",
  "ft": "Gifted",
  "url": "https://www.youtube.com/watch?v=-RXbaiuxfkw",
  "album": "KitaaOLOJIA",
  "year": 2019
}
```

Sample Response:

```json
{
  "data": {
    "id": "55f8545b04927b",
    "bar": "Ikiwa msafi ana zamani, basi mchafu nae ana future",
    "song": "Mzee Mbuzi",
    "ft": "Gifted",
    "url": "https://www.youtube.com/watch?v=-RXbaiuxfkw",
    "album": "KitaaOLOJIA",
    "year": 2019
  }
}
```

### Searching

Searching lines with specific keywords is a work in progress.

## Support

For answers you may not find in the Wiki, avoid posting issues. Feel free to ask for support via email contact@fidlines.fun. Make sure to mention **fidlinesApiIssue** so he is notified.

## License

The rest of this API is licensed under the [BSD 3-Clause license](http://opensource.org/licenses/BSD-3-Clause).

# Fidlines Library

Are you coding in PHP? Fidlines library makes it easy to send HTTP requests to retrive Fid Q bars, here refeered as lines.

## Installing Fidlines

The recommended way to install Fidlines is through
[Composer](https://getcomposer.org/).

```bash
composer require fidlines/fidlines
```

# Fidlines, usage

Call Fidlines package as below,

```php
//Use fidlines library
use Fidlines\Fidlines\Fidlines;
```

Now, in functions call

```php
//Get a single random verse
$verse = Fidlines::getRandomVerse();
echo $verse;

//To get a row verse in json format
$verse = Fidlines::getRandomVerseRaw();
return $verse;
```
