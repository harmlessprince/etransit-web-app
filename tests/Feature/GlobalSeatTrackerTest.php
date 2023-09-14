<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GlobalSeatTrackerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_gloabal_seat_tracker()
    {
        $user = $this->getUser();
        $response = $this->actingAs($user)->get('/e-ticket/global-seat-tracker-settings');
        $response->assertStatus(200);
    }


    protected function getUser()
    {
        Auth::guard('e-ticket')->attempt(['email' => 'abctransport@etransitafrica.com', 'password' => 'proshotsogunlana55'], true);
        return Auth::guard('e-ticket')->user();
    }
}
