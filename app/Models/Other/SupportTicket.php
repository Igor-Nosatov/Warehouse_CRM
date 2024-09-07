<?php

declare(strict_types=1);

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SupportTicketStatusType;
use App\Enums\SupportTicketPriorityType;
use App\Enums\SupportTicketCategoryType;
use App\Models\Auth\User;

/**
 * Class SupportTicket
 *
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $description
 * @property SupportTicketStatusType $status
 * @property SupportTicketPriorityType $priority
 * @property SupportTicketCategoryType|null $category
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $closed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \App\Models\Auth\User $user
 */
class SupportTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'support_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category',
        'user_id',
        'closed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => SupportTicketStatusType::class,
        'priority' => SupportTicketPriorityType::class,
        'category' => SupportTicketCategoryType::class,
        'closed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the support ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
