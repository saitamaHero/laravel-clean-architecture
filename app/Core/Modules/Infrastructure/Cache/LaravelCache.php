<?php

namespace App\Core\Modules\Infrastructure\Cache;

use App\Core\Shared\Application\Cache\Cache;
use Illuminate\Support\Facades\Cache as CacheFacade;

class LaravelCache implements Cache
{
    public function get(string $key, int $ttl, \Closure $closure)
    {
        return CacheFacade::remember($key, $ttl, $closure);
    }

    public function forget(string $key)
    {
        CacheFacade::forget($key);
    }
}
