<?php

declare(strict_types=1);

use OwenVoke\Livepeer\Api\Ingest;
use OwenVoke\Livepeer\Api\Session;
use OwenVoke\Livepeer\Api\Stream;
use OwenVoke\Livepeer\Client;

it('gets instances from the client', function () {
    $client = new Client();

    // Retrieves Ingest instance
    expect($client->ingest())->toBeInstanceOf(Ingest::class);

    // Retrieves Session instance
    expect($client->session())->toBeInstanceOf(Session::class);
    expect($client->sessions())->toBeInstanceOf(Session::class);

    // Retrieves Stream instance
    expect($client->stream())->toBeInstanceOf(Stream::class);
    expect($client->streams())->toBeInstanceOf(Stream::class);
});
