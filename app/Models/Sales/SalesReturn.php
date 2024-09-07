<?php

declare(strict_types=1);

namespace App\Models\Sales;

use App\Enums\SalesReturnStatus;
use App\Models\Inventory\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SalesReturn Model
 *
 * @property int $id
 * @property string $reason
 * @property \Carbon\Carbon $return_date
 * @property SalesReturnStatus $status
 * @property int $sales_order_id
 * @property int $customer_id
 * @property-read \App\Models\Sales\SalesOrder|null $salesOrder
 * @property-read \App\Models\Sales\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory\Product[] $products
 */
class SalesReturn extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_return';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason',
        'return_date',
        'status',
        'sales_order_id',
        'customer_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'reason' => 'string',
        'return_date' => 'datetime',
        'status' => SalesReturnStatus::class,
        'sales_order_id' => 'integer',
        'customer_id' => 'integer',
    ];

    /**
     * Get the sales order that owns the return.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    /**
     * Get the customer that owns the return.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * The products that belong to the sales return.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_sales_return', 'sales_return_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
