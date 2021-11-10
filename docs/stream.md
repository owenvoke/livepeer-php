# Stream API

[Back to the navigation](README.md)

Allows interacting with the Stream API.

### Get a list of streams

```php
$response = $client->streams()->all();
```

### Get details for a stream by its id

```php
$response = $client->stream()->show(
    'abcdefg-hijklmn-opqrs-tuvwxyz'
);
```

### Create a new stream

```php
$response = $client->stream()->create('Stream Name', [
    [
        'name' => '720p',
        'bitrate' => 2000000,
        'fps' => 30,
        'width' => 1280,
        'height' => 720,
    ]
]);
```

### Remove a stream by its id

```php
$response = $client->stream()->remove(
    'abcdefg-hijklmn-opqrs-tuvwxyz'
);
```
