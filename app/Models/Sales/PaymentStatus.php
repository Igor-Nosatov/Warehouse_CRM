<?php

declare(strict_types=1);

namespace App\Models\Sales;

use App\Models\Order\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentStatus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
     protected $table = 'payment_statuses';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'name' =>'string',
    ];

    /**
     * Get sales order associated with the payment status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salesOrder(): HasMany
    {
        return $this->hasMany(SalesOrder::class);
    }

    /**
     * Get purchases associated with the payment status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
