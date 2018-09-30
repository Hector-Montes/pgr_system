<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCreationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_staff_member_can_be_created()
    {
        $staff_details = [
            'university_id' => 'bsmith',
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'university_email' => 'bsmith@lincoln.ac.uk'
        ];

        $user = factory(Admin::class)->create();
        $user->assignDefaultPermissions(true);

        $response = $this->actingAs($user)
            ->json('POST', route('staff.store'), $staff_details)
            ->assertStatus(302)
            ->assertRedirect(route('staff.show', $staff_details['university_id']));

        $this->assertEquals(Staff::count(), 1);
    }


    public function test_staff_member_cannot_be_duplicated()
    {
        $staff_details = [
            'university_id' => 'bsmith',
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'university_email' => 'bsmith@lincoln.ac.uk'
        ];

        $user = factory(Admin::class)->create();
        $user->assignDefaultPermissions(true);

        $response = $this->actingAs($user)
            ->json('POST', route('staff.store'), $staff_details)
            ->assertStatus(302)
            ->assertRedirect(route('staff.show', $staff_details['university_id']));

        $staff_details['first_name'] = 'Fred';

        $response = $this->actingAs($user)
            ->json('POST', route('staff.store'), $staff_details)
            ->assertStatus(302)
            ->assertRedirect(route('staff.show', $staff_details['university_id']));

        $this->assertEquals(Staff::count(), 1);
    }
}