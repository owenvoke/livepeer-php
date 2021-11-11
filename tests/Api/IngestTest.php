<?php

use OwenVoke\Livepeer\Api\Ingest;

beforeEach(fn () => $this->apiClass = Ingest::class);

it('should get a list of ingest data centers', function () {
    $expectedArray = [[
        'ingest' => 'rtmp://lon-rtmp.livepeer.com/live',
        'playback' => 'https://lon-cdn.livepeer.com/hls',
        'base' => 'https://lon-cdn.livepeer.com/',
    ]];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/ingest', ['first' => false])
        ->willReturn($expectedArray);

    expect($api->all())->toBe($expectedArray);
});

it('should get the closest available ingest data center', function () {
    $expectedArray = [
        'ingest' => 'rtmp://lon-rtmp.livepeer.com/live',
        'playback' => 'https://lon-cdn.livepeer.com/hls',
        'base' => 'https://lon-cdn.livepeer.com/',
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/ingest')
        ->willReturn($expectedArray);

    expect($api->closest())->toBe($expectedArray);
});
