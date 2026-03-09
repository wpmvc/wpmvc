<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Eloquent\Concerns\HasFactory;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class Post
 *
 * Represents the WordPress posts table.
 *
 * @package MyPluginNamespace\App\Models
 */
class Post extends Model {
    use HasFactory;

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
    protected string $primary_key = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'post_author',
        'post_date',
        'post_date_gmt',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'comment_status',
        'ping_status',
        'post_password',
        'post_name',
        'to_ping',
        'pinged',
        'post_modified',
        'post_modified_gmt',
        'post_content_filtered',
        'post_parent',
        'guid',
        'menu_order',
        'post_type',
        'post_mime_type',
        'comment_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'ID'                => 'int',
        'post_author'       => 'int',
        'post_date'         => 'datetime',
        'post_date_gmt'     => 'datetime',
        'post_modified'     => 'datetime',
        'post_modified_gmt' => 'datetime',
        'post_parent'       => 'int',
        'menu_order'        => 'int',
        'comment_count'     => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'posts';
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
     * Scope a query to only include a specific post type.
     *
     * @param  mixed   $query
     * @param  string  $type
     * @return mixed
     */
    public function scope_post_type( $query, string $type = 'post' ) {
        return $query->where( 'post_type', $type );
    }

    /**
     * Get the author of the post.
     */
    public function author() {
        return $this->belongs_to( User::class, 'post_author', 'ID' );
    }

    /**
     * Get the post's meta data.
     */
    public function meta() {
        return $this->has_many( PostMeta::class, 'post_id', 'ID' );
    }

    /**
     * Get the comments for the post.
     */
    public function comments() {
        return $this->has_many( Comment::class, 'comment_post_ID', 'ID' );
    }

    /**
     * Get the terms for the post.
     */
    public function terms() {
        return $this->belongs_to_many( TermTaxonomy::class, 'term_relationships', 'object_id', 'term_taxonomy_id', 'term_taxonomy_id', 'ID' );
    }
}
