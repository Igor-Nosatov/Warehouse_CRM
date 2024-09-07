<?php

declare(strict_types=1);

namespace App\Models\Inventory;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductAttribute
 *
 * @package App\Models\Inventory
 * @property int $id
 * @property string|null $size
 * @property string|null $width
 * @property string|null $color
 * @property string|null $material
 * @property int $product_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Inventory\Product $product
 * @property-read \App\Models\Auth\User|null $user
 */
class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_attributes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size',
        'width',
        'height',
        'weight',
        'color',
        'material',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'size' => 'string',
        'width' => 'int',
        'height' => 'int',
        'weight' => 'int',
        'color' => 'string',
        'material' => 'string'
    ];

    /**
     * Get the product that owns the attributes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product():HasOne
    {
        return $this->hasOne(Product::class, 'product_attribute_id');
    }

}
