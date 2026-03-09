<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class TermMeta
 *
 * Represents the WordPress termmeta table.
 *
 * @package MyPluginNamespace\App\Models
 */
class TermMeta extends Model {
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
        'term_id',
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
        'term_id' => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'termmeta';
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
     * Get the term that owns the meta.
     */
    public function term() {
        return $this->belongs_to( Term::class, 'term_id' );
    }
}
