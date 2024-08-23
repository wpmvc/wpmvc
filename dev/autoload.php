<?php

spl_autoload_register(
    function ( $class ) {
        // Base directories for namespaces
        $baseDirs = [
            'MyPluginNamespace\\WpMVC\\Artisan'          => __DIR__ . '/../vendor/vendor-src/wpmvc/artisan/src/',
            'MyPluginNamespace\\WpMVC\\Database'         => __DIR__ . '/../vendor/vendor-src/wpmvc/database/src/',
            'MyPluginNamespace\\WpMVC'                   => __DIR__ . '/../vendor/vendor-src/wpmvc/framework/src/',
            'MyPluginNamespace\\WpMVC\\RequestValidator' => __DIR__ . '/../vendor/vendor-src/wpmvc/request-validator/src/',
            'MyPluginNamespace\\WpMVC\\Routing'          => __DIR__ . '/../vendor/vendor-src/wpmvc/routing/src/',
        ];

        // Iterate through base directories and namespaces
        foreach ( $baseDirs as $namespace => $baseDir ) {
            // Check if the class uses the namespace prefix
            if ( strpos( $class, $namespace ) === 0 ) {
                // Remove the namespace prefix from the class
                $relativeClass = str_replace( $namespace, '', $class );

                // Replace namespace separators with directory separators
                $file = $baseDir . str_replace( '\\', '/', $relativeClass ) . '.php';

                // If the file exists, require it
                if ( file_exists( $file ) ) {
                    require $file;
                    break;
                }
            }
        }
    }
);