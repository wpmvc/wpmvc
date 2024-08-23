<p align="center">
<a href="https://packagist.org/packages/wpmvc/wpmvc"><img src="https://img.shields.io/packagist/dt/wpmvc/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wpmvc/wpmvc"><img src="https://img.shields.io/packagist/v/wpmvc/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wpmvc/wpmvc"><img src="https://img.shields.io/packagist/l/wpmvc/framework" alt="License"></a>
</p>

# About WpMVC

WpMVC is a wordpress plugin framework that makes web development easy and enjoyable. Its expressive syntax and range of features help developers create high-quality applications with ease.

- [About WpMVC](#about-wpmvc)
	- [Installation](#installation)
	- [Artisan Command](#artisan-command)
	- [Routing](#routing)
	- [Database](#database)
	- [Regenerate Vendor Directory](#regenerate-vendor-directory)

## Installation

1. Create plugin with wpmvc

   ```sh
   composer create-project wpmvc/wpmvc plugin-name
   ```
2. Go to the plugin directory
   ```sh
   cd plugin-name
   ```
3. Setup plugin name and other information
	```sh
	php artisan app:setup
	```
## Artisan Command
Run this command to see all available command lists
```sh
php artisan
```
## Routing
<a href="https://github.com/wpmvc/routing">Routing Documentation</a>

## Database
<a href="https://github.com/wpmvc/database">Database Documentation</a>

## Regenerate Vendor Directory
To re-generate vendor folder don't use `composer install` / `php artisan app:setup`

Use
```sh
composer setup
```