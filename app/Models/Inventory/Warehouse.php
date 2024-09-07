<?php

declare (strict_types = 1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Warehouse
 *
 * @package App\Models\Inventory
 * @property int $id
 * @property string $name
 * @property string $location
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory\Product[] $products
 * @property-read int|null $products_count
 */
class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'location' => 'string',
    ];

    /**
     * The products that belong to the warehouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_warehouse', 'warehouse_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Define a relationship with Profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adjustStocks(): HasMany
    {
        return $this->hasMany(AdjustStock::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorStockProducts(): HasMany
    {
        return $this->hasMany(VendorStockProduct::class);
    }

    /**
     * Get the warehouses associated with a given product ID.
     *
     * @param int $productId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByProductId(int $productId)
    {
        return self::whereHas('products', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->get();
    }
}
