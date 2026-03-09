<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class CommentMeta
 *
 * Represents the WordPress commentmeta table.
 */
class CommentMeta extends Model {
    /**
     * Indicates if the model should be soft deleted.
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
        'comment_id',
        'meta_key',
        'meta_value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'meta_id'    => 'int',
        'comment_id' => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'commentmeta';
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
     * Get the comment that owns the meta.
     */
    public function comment() {
        return $this->belongs_to( Comment::class, 'comment_id', 'comment_ID' );
    }
}
