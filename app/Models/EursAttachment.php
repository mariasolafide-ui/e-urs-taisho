<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EursAttachment extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'e_urs_attachments';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'e_urs_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'attachment_type',
        'uploaded_by',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'e_urs_id'  => 'integer',
        'file_size' => 'integer',
        'uploaded_by' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | E-URS RELATION
    |--------------------------------------------------------------------------
    |
    | Satu attachment dimiliki oleh satu E-URS.
    |
    */

    public function eurs(): BelongsTo
    {
        return $this->belongsTo(
            Eurs::class,
            'e_urs_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPLOADER RELATION
    |--------------------------------------------------------------------------
    |
    | Attachment dimiliki oleh user yang meng-upload file.
    |
    */

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FILE SIZE FORMATTED
    |--------------------------------------------------------------------------
    |
    | Contoh:
    | 1024       -> 1 KB
    | 1048576    -> 1 MB
    |
    */

    public function getFormattedFileSizeAttribute(): string
    {
        $size = (int) ($this->file_size ?? 0);

        if ($size <= 0) {
            return '-';
        }

        if ($size >= 1024 * 1024) {
            return number_format(
                $size / (1024 * 1024),
                2
            ) . ' MB';
        }

        if ($size >= 1024) {
            return number_format(
                $size / 1024,
                2
            ) . ' KB';
        }

        return $size . ' B';
    }


    /*
    |--------------------------------------------------------------------------
    | FILE EXTENSION
    |--------------------------------------------------------------------------
    |
    | Mengambil extension dari nama file.
    |
    */

    public function getFileExtensionAttribute(): string
    {
        if (!$this->file_name) {
            return '';
        }

        return strtolower(
            pathinfo(
                $this->file_name,
                PATHINFO_EXTENSION
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | IS PDF
    |--------------------------------------------------------------------------
    */

    public function getIsPdfAttribute(): bool
    {
        return $this->file_extension === 'pdf';
    }


    /*
    |--------------------------------------------------------------------------
    | IS IMAGE
    |--------------------------------------------------------------------------
    */

    public function getIsImageAttribute(): bool
    {
        return in_array(
            $this->file_extension,
            [
                'jpg',
                'jpeg',
                'png',
                'gif',
                'webp',
            ],
            true
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DISPLAY TYPE
    |--------------------------------------------------------------------------
    |
    | Mengubah attachment_type menjadi tampilan yang lebih rapi.
    |
    */

    public function getDisplayTypeAttribute(): string
    {
        if (!$this->attachment_type) {
            return 'Attachment';
        }

        return ucwords(
            str_replace(
                '_',
                ' ',
                $this->attachment_type
            )
        );
    }
}