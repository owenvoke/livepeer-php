<?php

namespace OwenVoke\Livepeer\Api;

class Ingest extends AbstractApi
{
    /** @link https://livepeer.com/docs/api-reference/ingest */
    public function all(array $parameters = []): array
    {
        return $this->get('/ingest', array_merge_recursive($parameters, ['first' => false]));
    }

    /** @link https://livepeer.com/docs/api-reference/ingest */
    public function closest(array $parameters = []): array
    {
        return $this->get('/ingest', $parameters);
    }
}
