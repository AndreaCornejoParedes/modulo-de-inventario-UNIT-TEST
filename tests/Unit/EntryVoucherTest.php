<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\EntryVoucher;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EntryVoucherTest extends TestCase
{
    use WithoutMiddleware;

    public function test_an_entry_voucher_can_be_created()
    {
        $response = $this->followingRedirects()->get('/entryvoucher/create');
        $response->assertOk();
    }
    
}
