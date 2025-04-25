<?php

namespace Tests\Unit\Core\Modules\Application\UseCases;

use App\Core\Modules\Application\UseCases\ModuleService;
use App\Core\Modules\Domain\Entities\Module;
use App\Core\Modules\Domain\Repositories\ModuleRepository;
use App\Core\Shared\Application\Cache\Cache;
use Mockery;
use PHPUnit\Framework\TestCase;

class ModuleServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCacheIsInvokedWhenFindingModule()
    {
        $module = new Module('orders', 'Orders', 'Orders');

        // mock the module repo and check findBySlug method
        $repo = Mockery::mock(ModuleRepository::class);
        $repo->shouldReceive('findBySlug')
             ->once()
             ->with('orders')
             ->andReturn($module);

        // mock the cache class to be tested with the ModuleService
        $cache = Mockery::mock(Cache::class);
        $cache->shouldReceive('get')
              ->once()
              ->with('module:orders', 3600, Mockery::type(\Closure::class))
              ->andReturnUsing(fn($key, $ttl, $callback) => $callback());

        $service = new ModuleService($repo, $cache);

        $result = $service->find('orders');

        $this->assertInstanceOf(Module::class, $result);
        $this->assertEquals('orders', $result->getSlug());
    }

    public function testItFallsBackToRepositoryWhenCacheMisses()
    {
        $module = new Module('orders', 'Orders', 'Orders');

        // Expect repo to be called once
        $repo = Mockery::mock(ModuleRepository::class);
        $repo->shouldReceive('findBySlug')
             ->once()
             ->with('orders')
             ->andReturn($module);

        // Simulate cache miss (by always calling the callback)
        $cache = Mockery::mock(Cache::class);
        $cache->shouldReceive('get')
              ->once()
              ->with('module:orders', 3600, Mockery::type(\Closure::class))
              ->andReturnUsing(function ($key, $ttl, $callback) {
                  return $callback(); // simulate cache miss by running the callback
              });

        $service = new ModuleService($repo, $cache);

        $result = $service->find('orders');

        $this->assertInstanceOf(Module::class, $result);
        $this->assertEquals('orders', $result->getSlug());
    }
}

