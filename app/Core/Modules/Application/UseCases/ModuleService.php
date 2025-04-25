<?php

namespace App\Core\Modules\Application\UseCases;

use App\Core\Modules\Domain\Entities\Field;
use App\Core\Modules\Domain\Entities\Module;
use App\Core\Modules\Domain\Repositories\ModuleRepository;
use App\Core\Shared\Application\Cache\Cache;

class ModuleService
{
    public function __construct(
        private ModuleRepository $moduleRepository,
        private Cache $cacheService
    ) {}

    public function find($slug): ?Module {
        // return $this->moduleRepository->findBySlug($slug);
        return $this->cacheService->get("module:$slug", 3600, fn() => $this->moduleRepository->findBySlug($slug));
    }

    public function create(array $module): Module
    {
        if (!isset($module['slug'])) {
            throw new \InvalidArgumentException("The slug was not provided");
        }

        if (!is_null($this->find($module['slug']))) {
            throw new \Exception("{$module['slug']} module already exists in the system");
        }

        $module = new Module($module['slug'], $module['label'], $module['label']);

        return $this->moduleRepository->create($module);
    }

    public function addFields(array $fields) {}
}
