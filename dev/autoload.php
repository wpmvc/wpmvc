<?php

spl_autoload_register(
    function ($class) {
        // Base directories for namespaces
        $base_dirs = [
            'MyPluginNamespace\\WpMVC\\Artisan'          => __DIR__ . '/../vendor/vendor-src/wpmvc/artisan/src/',
            'MyPluginNamespace\\WpMVC\\Database'         => __DIR__ . '/../vendor/vendor-src/wpmvc/database/src/',
            'MyPluginNamespace\\WpMVC'                   => __DIR__ . '/../vendor/vendor-src/wpmvc/framework/src/',
            'MyPluginNamespace\\WpMVC\\RequestValidator' => __DIR__ . '/../vendor/vendor-src/wpmvc/request-validator/src/',
            'MyPluginNamespace\\WpMVC\\Routing'          => __DIR__ . '/../vendor/vendor-src/wpmvc/routing/src/',
        ];

        // Iterate through base directories and namespaces
        foreach ($base_dirs as $namespace => $base_dir) {
            // Check if the class name starts with the namespace
            if (strncmp($class, $namespace, strlen($namespace)) === 0) {
                // Remove the namespace prefix from the class name
                $relative_class = substr($class, strlen($namespace));

                // Replace namespace separators with directory separators
                $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

                // If the file exists, require it
                if (file_exists($file)) {
                    require $file;
                    break;
                }
            }
        }
    }
);
