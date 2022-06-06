<?php

namespace Tests\Unit;

use App\Models\Material;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class MedicineTest extends TestCase
{
    public function test_medicine_has_numero_de_parte()
    {
        $medicine=new Material;
        $medicine->Numero_de_parte='1010349619';
        $this->assertTrue($medicine->Numero_de_parte!=null);
    }
}
