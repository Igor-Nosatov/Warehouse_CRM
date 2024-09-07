<?php

declare(strict_types=1);

namespace App\Models\Sales;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Represents customer notes.
 *
 * @property int $id
 * @property string $notes
 * @property int $customer_id
 * @property int $user_id
 * @property-read Customer $customer
 * @property-read User $user
 */
class CustomerNote extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'customer_notes';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'notes',
        'customer_id',
        'user_id'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'notes' =>'string',
        'customer_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Get customer associated with the customer note.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get user associated with the customer note.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
