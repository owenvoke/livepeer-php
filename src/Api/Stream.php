<?php

namespace OwenVoke\Livepeer\Api;

class Stream extends AbstractApi
{
    /** @link https://livepeer.com/docs/api-reference/stream/list */
    public function all(array $parameters = []): array
    {
        return $this->get('/stream', $parameters);
    }

    /** @link https://livepeer.com/docs/api-reference/stream/get-stream */
    public function show(string $id): array
    {
        return $this->get("/stream/{$id}");
    }

    /** @link https://livepeer.com/docs/api-reference/stream/post-stream */
    public function create(string $name, array $profiles = []): array
    {
        return $this->post('/stream', [
            'name' => $name,
            'profiles' => $profiles,
        ]);
    }

    /** @link https://livepeer.com/docs/api-reference/stream/delete-stream */
    public function remove(string $id): ?string
    {
        return $this->delete("/stream/{$id}");
    }
}
