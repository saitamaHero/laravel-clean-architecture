<?php

namespace Tests\Integration\Core\Modules;

use App\Core\Modules\Application\UseCases\ModuleService;
use App\Core\Modules\Domain\Entities\Module;
use App\Core\Modules\Domain\Repositories\ModuleRepository;
use App\Core\Modules\Infrastructure\Cache\LaravelCache;
use App\Core\Modules\Infrastructure\Persistence\EloquentModuleRepository;
use App\Core\Shared\Application\Cache\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ModuleService $moduleService;

    protected function setUp(): void
    {
        parent::setUp();

        $repository = new EloquentModuleRepository();
        $cacheService = new LaravelCache();

        $this->moduleService = new ModuleService($repository, $cacheService);
    }

    public function testItCreatesAModule()
    {
        $module = $this->moduleService->create([
            'slug' => 'products',
            'label' => 'Products'
        ]);

        $this->assertEquals('products', $module->getSlug());

        $this->assertDatabaseHas('modules', [
            'slug' => 'products',
            'label' => 'Products'
        ]);
    }

    public function testItThrowsIfSlugAlreadyExists()
    {
        $this->moduleService->create([
            'slug' => 'users',
            'label' => 'Users'
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('users module already exists in the system');

        $this->moduleService->create([
            'slug' => 'users',
            'label' => 'Users Again'
        ]);
    }
}

