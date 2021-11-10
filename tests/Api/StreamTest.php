<?php

use OwenVoke\Livepeer\Api\Stream;

beforeEach(fn() => $this->apiClass = Stream::class);

it('should get a list of streams', function () {
    $expectedArray = [[
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ]];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/stream')
        ->willReturn($expectedArray);

    expect($api->all())->toBe($expectedArray);
});

it('should get a stream by its id', function () {
    $expectedArray = [
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/stream/abcdefg-hijklmn-opqrs-tuvwxyz')
        ->willReturn($expectedArray);

    expect($api->show('abcdefg-hijklmn-opqrs-tuvwxyz'))->toBe($expectedArray);
});

it('should create a stream', function () {
    $expectedArray = [
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('post')
        ->with('/stream', ['name' => 'Test Stream', 'profiles' => []])
        ->willReturn($expectedArray);

    expect($api->create('Test Stream', []))->toBe($expectedArray);
});

it('should remove a stream by its id', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('delete')
        ->with('/stream/abcdefg-hijklmn-opqrs-tuvwxyz')
        ->willReturn('');

    expect($api->remove('abcdefg-hijklmn-opqrs-tuvwxyz'))->toBeString()->toBeEmpty();
});
