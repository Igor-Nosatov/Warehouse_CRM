<?php

declare (strict_types = 1);

namespace App\Models\Sales;

use App\Builders\Sales\CustomerBuilder;
use App\Enums\CustomerStatus;
use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @package App\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $customer_photo_url
 * @property string $customer_type
 * @property string $email
 * @property string $phone
 * @property string|null $remark
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Customer extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'customer_photo_url',
        'customer_type',
        'customer_status',
        'email',
        'phone',
        'remark',
        'total_purchases',
        'receivables',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'customer_photo_url' => 'string',
        'customer_type' => CustomerType::class,
        'customer_status' => CustomerStatus::class,
        'email' => 'string',
        'phone' => 'string',
        'remark' => 'string',
        'total_purchases' => 'integer',
        'receivables' => 'integer',
    ];

    /**
     * Get the sales orders for the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrder::class);
    }

    /**
     * Get the sales returns for the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salesReturns(): HasMany
    {
        return $this->hasMany(SalesReturn::class);
    }

    /**
     * Get the customer notes for the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerNotes(): HasMany
    {
        return $this->hasMany(CustomerNote::class);
    }

    /**
     * Get the customer histories for the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerHistories(): HasMany
    {
        return $this->hasMany(CustomerHistory::class);
    }

    public function newEloquentBuilder($query): CustomerBuilder
    {
        return new CustomerBuilder($query);
    }
}
