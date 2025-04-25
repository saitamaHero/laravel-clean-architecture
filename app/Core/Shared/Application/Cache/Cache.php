<?php

namespace App\Core\Shared\Application\Cache;

interface Cache
{
    public function get(string $key, int $ttl, \Closure $closure);

    public function forget(string $key);
}
