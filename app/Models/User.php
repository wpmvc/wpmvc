<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Eloquent\Concerns\HasFactory;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class User
 *
 * Represents the WordPress users table.
 *
 * @package MyPluginNamespace\App\Models
 */
class User extends Model {
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
     * The attributes that should be hidden.
     *
     * @var array
     */
    protected array $hidden = ['user_pass'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'user_login',
        'user_pass',
        'user_nicename',
        'user_email',
        'user_url',
        'user_registered',
        'user_activation_key',
        'user_status',
        'display_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'ID'              => 'int',
        'user_registered' => 'datetime',
        'user_status'     => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'users';
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
     * Get the user's meta data.
     */
    public function metas() {
        return $this->has_many( UserMeta::class, 'user_id', 'ID' );
    }

    /**
     * Get the user's nickname meta.
     */
    public function primary_meta() {
        return $this->has_one( UserMeta::class, 'user_id', 'ID' )->where( 'meta_key', 'nickname' );
    }

    /**
     * Get the user's posts.
     */
    public function posts() {
        return $this->has_many( Post::class, 'post_author', 'ID' );
    }

    /**
     * Get the latest post of the user.
     */
    public function latest_post() {
        return $this->has_one( Post::class, 'post_author', 'ID' )->latest( 'ID' );
    }

    /**
     * Get the user's comments.
     */
    public function comments() {
        return $this->has_many( Comment::class, 'user_id', 'ID' );
    }

    /**
     * Get comments through posts.
     */
    public function comments_through_posts() {
        return $this->has_many_through( Comment::class, Post::class, 'post_author', 'comment_post_ID' );
    }
}