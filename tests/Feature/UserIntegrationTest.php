<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserIntegrationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_user_registration_and_email()
    {
        // Fake the email sending
        Mail::fake();

        // Simulate user registration
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'jclient@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Check if the user was created in the database


        $data = [
            'email' => 'jclient@gmail.com',
        ];
        
        $user = USER::find(3);
       
        $response->assertEquals($data, $user->only(['email']));
        // $this->assertEquals([
        //     'email' => 'john@example.com',
        // ], USER::where('email'));

        // Check if a confirmation email was sent
        Mail::assertSent(ConfirmationEmail::class, function ($mail) {
            return $mail->hasTo('john@example.com');
        });

        // Assert the response status
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}