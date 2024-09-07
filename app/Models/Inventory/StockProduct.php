<?php

declare(strict_types=1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockProduct extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'product_received_qty',
        'product_shipment_qty',
        'product_qty',
        'description',
        'product_id',
        'adjust_stock_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_received_qty' => 'integer',
        'product_shipment_qty' => 'integer',
        'product_qty' => 'integer',
        'description' => 'string',
        'product_id' => 'integer',
        'adjust_stock_id' => 'integer',
    ];

    /**
     * Get the product associated with the stock product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the adjust stock record associated with the stock product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adjustStock():BelongsTo
    {
        return $this->belongsTo(AdjustStock::class, 'adjust_stock_id');
    }
}
