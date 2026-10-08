<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EursActivityLog extends Model
{
    use HasFactory;

    protected $table = 'e_urs_activity_logs';

    protected $fillable = [
        'e_urs_id',
        'user_id',
        'activity',
        'description',
        'old_status',
        'new_status',
        'ip_address',
    ];

    /**
     * Activity belongs to an E-URS.
     */
    public function eurs(): BelongsTo
    {
        return $this->belongsTo(Eurs::class, 'e_urs_id');
    }

    /**
     * Activity belongs to the user who performed it.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}