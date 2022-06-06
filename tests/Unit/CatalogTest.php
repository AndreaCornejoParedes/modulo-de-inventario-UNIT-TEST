<?php

namespace Tests\Unit;

use App\Models\Catalog;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    public function test_catalog_has_code()
    {
        $catalog=new Catalog;
        $catalog->ID_catalogo='C0000001';
        $catalog->Ubicacion='2018';
        $this->assertTrue($catalog->ID_catalogo!=null);
    }
}
