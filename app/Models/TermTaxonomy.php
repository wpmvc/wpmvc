<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Eloquent\Concerns\HasFactory;
use MyPluginNamespace\WpMVC\Database\Resolver;

/**
 * Class TermTaxonomy
 *
 * Represents the WordPress term_taxonomy table.
 *
 * @package MyPluginNamespace\App\Models
 */
class TermTaxonomy extends Model {
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
    protected string $primary_key = 'term_taxonomy_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'term_taxonomy_id' => 'int',
        'term_id'          => 'int',
        'parent'           => 'int',
        'count'            => 'int',
    ];

    /**
     * Get the table name associated with the model.
     *
     * @return string
     */
    public static function get_table_name(): string {
        return 'term_taxonomy';
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
     * Get the term associated with the taxonomy.
     */
    public function term() {
        return $this->belongs_to( Term::class, 'term_id', 'term_id' );
    }

    /**
     * Get the posts associated with this taxonomy record.
     */
    public function posts() {
        return $this->belongs_to_many( Post::class, 'term_relationships', 'term_taxonomy_id', 'object_id', 'ID', 'term_taxonomy_id' );
    }
}
