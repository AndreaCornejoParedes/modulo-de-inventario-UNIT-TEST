<?php

namespace Tests\Unit;

use App\Models\RequestForReinstatement;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class RequestForReinstatementTest extends TestCase
{
    public function test_a_request_has_supplier()
    {
        $requestReinstatement=new RequestForReinstatement;
        $requestReinstatement->Codigo_proveedor='2060018017';
        $this->assertTrue($requestReinstatement->Codigo_proveedor!=null);
    }

}
