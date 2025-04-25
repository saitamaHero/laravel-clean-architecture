<?php

namespace App\Core\Modules\Domain\Repositories;

use App\Core\Modules\Domain\Entities\Module;

interface ModuleRepository
{

    // public function getAll();

    /**
     * @param string $slug
     *
     * @return Module
     */
    public function findBySlug(string $slug): ?Module;


    /**
     * @param Module $module
     *
     * @return Module
     */
    public function create(Module $module): Module;
}
