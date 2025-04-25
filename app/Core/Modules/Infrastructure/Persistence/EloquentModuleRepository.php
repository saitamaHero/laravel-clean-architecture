<?php


namespace App\Core\Modules\Infrastructure\Persistence;

use App\Core\Modules\Domain\Entities\Module;
use App\Core\Modules\Domain\Repositories\ModuleRepository;
use App\Core\Shared\Exceptions\NotImplementedException;
use App\Models\Module as EloquentModule;

class EloquentModuleRepository implements ModuleRepository
{

    public function __construct()
    {

    }

    public function findBySlug(string $slug): ?Module
    {
        $module = EloquentModule::firstWhere('slug', $slug);

        return $module ? new Module($module->slug, $module->label, $module->singular_label) : null;
    }

    public function create(Module $module): Module
    {
        EloquentModule::create([
            'slug' => $module->getSlug(),
            'label' => $module->getSingularLabel(),
            'singular_label' => $module->getSingularLabel()
        ]);

        return $module;
    }


}
