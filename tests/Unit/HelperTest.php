<?php

namespace MyPluginNamespace\Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * Test my_plugin_function_version helper.
     */

    /**
     * Test my_plugin_function_now helper.
     */
    public function test_my_plugin_now() {
        $now = my_plugin_function_now();
        $this->assertInstanceOf( 'MyPluginNamespace\WpMVC\Helpers\Date', $now );
    }
}
