<?php

declare(strict_types=1);

namespace App\Models\Inventory;

use App\Enums\AdjustmentType;
use App\Enums\ReasonInventoryType;
use App\Models\Auth\User;
use App\Models\Order\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdjustStock
 *
 * @package App\Models\Inventory
 *
 * @property int $id
 * @property string $payment_status
 * @property \Illuminate\Support\Carbon $adjust_stock_date
 * @property string $reason_for_inventory
 * @property int $quantity_available
 * @property int $new_quantity
 * @property string|null $description
 * @property int $product_id
 * @property int $warehouse_id
 * @property int|null $vendor_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Inventory\Product|null $product
 * @property-read \App\Models\Inventory\Warehouse|null $warehouse
 * @property-read \App\Models\Order\Vendor|null $vendor
 * @property-read \App\Models\Auth\User|null $user
 */
class AdjustStock extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'adjust_stocks';

    protected $fillable = [
        'payment_status',
        'adjust_stock_date',
        'reason_for_inventory',
        'quantity_available',
        'new_quantity',
        'description',
        'product_id',
        'warehouse_id',
        'vendor_id',
        'user_id',
    ];

    protected $casts = [
        'adjust_stock_date' => 'date',
        'payment_status' => AdjustmentType::class,
        'reason_for_inventory' => ReasonInventoryType::class,
        'quantity_available' => 'integer',
        'new_quantity' => 'integer',
        'product_id' => 'integer',
        'warehouse_id' => 'integer',
        'vendor_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
