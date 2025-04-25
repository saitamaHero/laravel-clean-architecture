<?php

namespace App\Core\Modules\InterfaceAdapters;

use App\Core\Modules\Application\UseCases\ModuleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ModuleController
{
    public function __construct(
        private ModuleService $moduleService
    )
    {

    }
    public function store(Request $request)
    {
        // dd($request);
        // $data = [
        //     'slug' => 'leads',
        //     'label' => 'Leads',
        //     'singular_label' => 'Lead'
        // ];

        // $module = $this->moduleService->create($data);
        DB::enableQueryLog();

        dd($this->moduleService->find('leads'), DB::getRawQueryLog());
    }
}
