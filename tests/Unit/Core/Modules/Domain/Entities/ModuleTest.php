<?php

namespace Tests\Unit\Core\Modules\Domain\Entities;

use App\Core\Modules\Domain\Entities\Module;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    public function testItCreatesModuleWithValidData()
    {
        $module = new Module("leads", "Leads", "Lead");

        $this->assertEquals('leads', $module->getSlug());
        $this->assertEquals('Leads', $module->getLabel());
        $this->assertEquals('Lead', $module->getSingularLabel());
    }

    public function testItThrowsExceptionForShortSlug()
    {
        $this->expectException(\Exception::class);

        new Module('ab', 'Short', 'Short');
    }
}
