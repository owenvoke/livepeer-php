<?php

declare(strict_types=1);

use OwenVoke\Livepeer\Api\Stream;
use OwenVoke\Livepeer\Client;

it('gets instances from the client', function () {
    $client = new Client();

    // Retrieves Stream instance
    expect($client->stream())->toBeInstanceOf(Stream::class);
    expect($client->streams())->toBeInstanceOf(Stream::class);
});
