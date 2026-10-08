<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EursApproval extends Model
{
    use HasFactory;

    protected $table = 'e_urs_approvals';

    protected $fillable = [
        'e_urs_id',
        'approval_type',
        'approver_name',
        'approver_email',
        'status',
        'comments',
        'approval_token',
        'token_expires_at',
        'approved_at',
    ];

    protected $hidden = [
        'approval_token',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Approval belongs to an E-URS.
     */
    public function eurs(): BelongsTo
    {
        return $this->belongsTo(Eurs::class, 'e_urs_id');
    }
}