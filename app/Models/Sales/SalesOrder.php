<?php

declare(strict_types=1);

namespace App\Models\Sales;

use App\Builders\Sales\SalesOrderBuilder;
use App\Enums\SalesOrderStatus;
use App\Models\Inventory\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SalesOrder Model
 *
 * @property int $id
 * @property SalesOrderStatus $status
 * @property int $amount
 * @property \Carbon\Carbon $date_time_of_placement
 * @property \Carbon\Carbon|null $date_time_of_delivery
 * @property string $delivery_location
 * @property int $customer_id
 * @property-read \App\Models\Sales\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory\Product[] $products
 */
class SalesOrder extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string The database table used by the model.
     */
    protected $table = 'sales_orders';

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
        'customer_id',
        'payment_status_id',
        'sales_transaction_id',
    ];

    /**
     * @var array The attributes that should be cast to native types.
     */
    protected $casts = [
        'status' => 'string',
        'total_amount' => 'integer',
        'total_quantity' => 'integer',
        'date_time_of_placement' => 'datetime',
        'date_time_of_delivery' => 'datetime',
        'product_id' => 'integer',
        'customer_id' => 'integer',
        'payment_status_id' => 'integer',
        'sales_transaction_id'=> 'integer',
    ];

    /**
     * Get the customer associated with the sales order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the products associated with the sales order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the payment status associated with the sales order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    /**
     * Get transaction associated with the sales order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(SalesTransaction::class);
    }

    public function newEloquentBuilder($query): SalesOrderBuilder
    {
        return new SalesOrderBuilder($query);
    }
}
