<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Eloquent\Concerns\HasFactory;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class Term
 *
 * Represents the WordPress terms table.
 *
 * @package MyPluginNamespace\App\Models
 */
class Term extends Model {
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
    protected string $primary_key = 'term_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'name',
        'slug',
        'term_group',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'term_id'    => 'int',
        'term_group' => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'terms';
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
     * Get the taxonomy information for the term.
     */
    public function taxonomy() {
        return $this->has_one( TermTaxonomy::class, 'term_id' );
    }

    /**
     * Get the term's meta data.
     */
    public function meta() {
        return $this->has_many( TermMeta::class, 'term_id' );
    }
}
