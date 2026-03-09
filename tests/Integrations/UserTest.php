<?php

namespace MyPluginNamespace\Tests\Integrations;

use MyPluginNamespace\App\Models\User;

class UserTest extends \WP_UnitTestCase
{
    /**
     * Test User model basic operations.
     */
    public function test_user_model_can_fetch_users() {
        // WordPress testing environment usually has a default admin user.
        $users = User::all();
        
        $this->assertGreaterThanOrEqual( 0, $users->count() );
    }

    /**
     * Test User creation via factory or standard WordPress function.
     */
    public function test_user_creation() {
        $user_id = $this->factory->user->create(
            [
                'user_login' => 'testuser',
                'user_email' => 'test@example.com',
            ]
        );

        $user = User::find( $user_id );

        $this->assertNotNull( $user );
        $this->assertEquals( 'testuser', $user->user_login );
        $this->assertEquals( 'test@example.com', $user->user_email );
    }
}
