<?php

declare(strict_types=1);

namespace App\Models\Order;

use App\Builders\Order\PurchaseBuilder;
use App\Enums\SalesOrderStatus;
use App\Models\Inventory\Product;
use App\Models\Sales\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string The database table used by the model.
     */
    protected $table = 'purchases';

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'status',
        'total_amount',
        'total_quantity',
        'date_time_of_placement',
        'date_time_of_delivery',
        'delivery_location',
        'product_id',
        'vendor_id',
        'payment_status_id',
        'customer_id',
        'purchase_transaction_id'
    ];

    /**
     * @var array The attributes that should be cast to native types.
     */
    protected $casts = [
        'status' => SalesOrderStatus::class,
        'total_amount' => 'integer',
        'total_quantity' => 'integer',
        'date_time_of_placement' => 'datetime',
        'date_time_of_delivery' => 'datetime',
        'product_id' => 'integer',
        'vendor_id' => 'integer',
        'payment_status_id' => 'integer',
        'customer_id' => 'integer',
        'purchase_transaction_id' => 'integer',
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function newEloquentBuilder($query): PurchaseBuilder
    {
        return new PurchaseBuilder($query);
    }

    public function transaction()
    {
        return $this->belongsTo(PurchaseTransaction::class);
    }
}
