<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class PostMeta
 *
 * Represents the WordPress postmeta table.
 *
 * @package MyPluginNamespace\App\Models
 */
class PostMeta extends Model {
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
    protected string $primary_key = 'meta_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'post_id',
        'meta_key',
        'meta_value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'meta_id' => 'int',
        'post_id' => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'postmeta';
    }

    /**
     * Get the resolver instance.
     *
     * @return Resolver
     */
    public function resolver(): Resolver {
        return new Resolver();
    }

    /**
     * Get the post that owns the meta.
     */
    public function post() {
        return $this->belongs_to( Post::class, 'post_id', 'ID' );
    }
}
