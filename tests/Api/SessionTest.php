<?php

use OwenVoke\Livepeer\Api\Session;

beforeEach(fn() => $this->apiClass = Session::class);

it('should get a list of sessions', function () {
    $expectedArray = [[
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ]];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/session')
        ->willReturn($expectedArray);

    expect($api->all())->toBe($expectedArray);
});

it('should get a list of sessions with a specific parent id', function () {
    $expectedArray = [[
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ]];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/stream/abcdefg-hijklmn-opqrs-tuvwxyz/sessions')
        ->willReturn($expectedArray);

    expect($api->withParentId('abcdefg-hijklmn-opqrs-tuvwxyz'))->toBe($expectedArray);
});

it('should get a list of recorded sessions', function () {
    $expectedArray = [[
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ]];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/stream/abcdefg-hijklmn-opqrs-tuvwxyz/sessions', ['record' => 1])
        ->willReturn($expectedArray);

    expect($api->recorded('abcdefg-hijklmn-opqrs-tuvwxyz'))->toBe($expectedArray);
});

it('should get a session by its id', function () {
    $expectedArray = [
        'id' => 'abcdefg-hijklmn-opqrs-tuvwxyz',
        'name' => 'Test',
        // ...
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/session/abcdefg-hijklmn-opqrs-tuvwxyz')
        ->willReturn($expectedArray);

    expect($api->show('abcdefg-hijklmn-opqrs-tuvwxyz'))->toBe($expectedArray);
});
