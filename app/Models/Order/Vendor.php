<?php

declare(strict_types=1);

namespace App\Models\Order;

use App\Builders\Order\VendorBuilder;
use App\Enums\VendorStatus;
use App\Enums\VendorType;
use App\Models\Inventory\AdjustStock;
use App\Models\Inventory\VendorStockProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'company_name',
        'vendor_first_name',
        'vendor_last_name',
        'email',
        'phone',
        'location',
        'website',
        'remark',
        'vendor_status',
        'vendor_type',
        'receivables',
        'used_credits',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'website' => 'string',
        'remark' => 'string',
        'company_name' => 'string',
        'vendor_first_name' => 'string',
        'vendor_last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'location' => 'string',
        'vendor_status' => VendorStatus::class,
        'vendor_type' => VendorType::class,
        'receivables' => 'integer',
        'used_credits' => 'integer',
    ];

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

    public function newEloquentBuilder($query): VendorBuilder
    {
        return new VendorBuilder($query);
    }
}
