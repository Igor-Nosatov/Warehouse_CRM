<?php

declare(strict_types=1);

namespace App\Models\Inventory;

use App\Builders\Inventory\ProductBuilder;
use App\Models\Auth\User;
use App\Models\Inventory\ProductAttribute;
use App\Models\Inventory\ProductStatus;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesReturn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Product
 *
 * @package App\Models\Inventory
 * @property int $id
 * @property bool $is_returnable
 * @property bool $is_have_variant
 * @property int|null $core_product_id
 * @property string $title
 * @property string $sku
 * @property string $barcode
 * @property \App\Enums\ProductStatus $product_status
 * @property int|null $product_type_price
 * @property int $retail_price
 * @property int $wholesale_price
 * @property int $cost
 * @property int|null $product_id
 * @property int|null $warehouse_id
 * @property int|null $product_type_id
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Inventory\Category|null $category
 * @property-read \App\Models\Inventory\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory\ProductAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \App\Models\Auth\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\SalesOrder[] $salesOrders
 * @property-read int|null $sales_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory\Warehouse[] $warehouses
 * @property-read int|null $warehouses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\SalesReturn[] $salesReturns
 * @property-read int|null $sales_returns_count
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_returnable',
        'is_have_variant',
        'core_product_id',
        'title',
        'sku',
        'barcode',
        'retail_price',
        'wholesale_price',
        'cost',
        'is_draft',
        'product_type_id',
        'category_id',
        'brand_id',
        'user_id',
        'product_type_id',
        'product_status_id',
        'product_attribute_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_returnable' => 'boolean',
        'is_have_variant' => 'boolean',
        'core_product_id' => 'integer',
        'title' => 'string',
        'sku' => 'string',
        'barcode' => 'string',
        'retail_price' => 'integer',
        'wholesale_price' => 'integer',
        'cost' => 'integer',
        'is_draft' => 'boolean',
        'product_type_id' => 'integer',
        'category_id' => 'integer',
        'brand_id' => 'integer',
        'user_id' => 'integer',
        'product_status_id' => 'integer',
        'product_attribute_id' => 'integer',
    ];

    /**
     * Get the product type that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get the product type that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productStatus(): BelongsTo
    {
        return $this->belongsTo(ProductStatus::class);
    }

    /**
     * Get the category that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the user that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product_images associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages():HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }

    /**
     * Get the sales orders associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrder::class);
    }

    /**
     * Get the warehouses associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouses(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the sales returns associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salesReturns(): BelongsTo
    {
        return $this->belongsTo(SalesReturn::class);
    }

    public function newEloquentBuilder($query): ProductBuilder
    {
        return new ProductBuilder($query);
    }

    /**
     * Get adjust stocks associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adjustStocks(): HasMany
    {
        return $this->hasMany(AdjustStock::class);
    }

    /**
     * Get the vendor stock products associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorStockProducts(): HasMany
    {
        return $this->hasMany(VendorStockProduct::class);
    }

    /**
     * Get the stock product associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockProducts(): HasMany
    {
        return $this->hasMany(StockProduct::class);
    }

    public function getTitleAttribute($value)
    {
        return strlen($value) > 40 ? substr($value, 0, 40) . '...' : $value;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->salesOrders()->delete();
        });
    }

    public static function generateUniqueSku()
    {
        do {
            $sku = 'SKU-' . strtoupper(Str::random(8));
        } while (self::where('sku', $sku)->exists());

        return $sku;
    }

    public static function generateUniqueBarcode()
    {
        do {
            $barcode = 'BAR-' . strtoupper(Str::random(12));
        } while (self::where('barcode', $barcode)->exists());

        return $barcode;
    }

    /**
     * Get the product history associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productHistories(): HasMany
    {
        return $this->hasMany(ProductHistory::class);
    }

    /**
     * Get the product notes associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productNotes(): HasMany
    {
        return $this->hasMany(ProductNote::class);
    }
}
