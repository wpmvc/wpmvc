<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class Option
 *
 * Represents the WordPress options table.
 *
 * @package MyPluginNamespace\App\Models
 */
class Option extends Model {
    /**
     * Indicates if the model should handle timestamps.
     *
     * @var bool
     */
    public bool $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected string $primary_key = 'option_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public bool $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'option_name',
        'option_value',
        'autoload',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'option_id' => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'options';
    }

    /**
     * Get the resolver instance.
     *
     * @return Resolver
     */
    public function resolver(): Resolver {
        return new Resolver();
    }
}
