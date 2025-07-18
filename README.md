<p align="center">
<a href="https://packagist.org/packages/wpmvc/wpmvc"><img src="https://img.shields.io/packagist/dt/wpmvc/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wpmvc/wpmvc"><img src="https://img.shields.io/packagist/v/wpmvc/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wpmvc/wpmvc"><img src="https://img.shields.io/packagist/l/wpmvc/framework" alt="License"></a>
</p>

# 🚀 Installation Guide

Welcome to **WpMVC** — a modern WordPress plugin framework that brings simplicity, structure, and speed to plugin development. With expressive syntax and a rich set of tools, WpMVC helps developers build high-quality plugins effortlessly.

## 1. Create a New Plugin

Start by scaffolding your plugin using Composer:

```sh
composer create-project wpmvc/wpmvc plugin-name
```

Replace `plugin-name` with your desired plugin folder name.

## 2. Navigate to Your Plugin Directory

```sh
cd plugin-name
```

## 3. Run the Setup Wizard

Configure your plugin details interactively:

```sh
php artisan app:setup
```

### Setup Prompts Explained

When prompted:

* **Enter Plugin:**
  This is the display name of your plugin.
  *Example:* `Plugin Name`

* **Enter plugin namespace:**
  This is the PHP namespace used throughout your codebase.
  *Example:* `PluginName`

* **Enter plugin API namespace:**
  This is the namespace for your REST API endpoints.
  *Example:* `plugin-name`

---

✅ That’s it — your plugin is now scaffolded and ready to build!

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
