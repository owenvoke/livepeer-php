<?php

namespace OwenVoke\Livepeer\Api;

class Session extends AbstractApi
{
    /** @link https://livepeer.com/docs/api-reference/session/list-sessions */
    public function all(array $parameters = []): array
    {
        return $this->get('/session', $parameters);
    }

    /** @link https://livepeer.com/docs/api-reference/session/list-sessions */
    public function withParentId(string $parentId, array $parameters = []): array
    {
        return $this->get("/stream/{$parentId}/sessions", $parameters);
    }

    /** @link https://livepeer.com/docs/api-reference/session/list-recorded-sessions */
    public function recorded(string $parentId, array $parameters = []): array
    {
        return $this->get("/stream/{$parentId}/sessions", array_merge_recursive($parameters, ['record' => 1]));
    }

    /** @link https://livepeer.com/docs/api-reference/session/get-session */
    public function show(string $id): array
    {
        return $this->get("/session/{$id}");
    }
}
