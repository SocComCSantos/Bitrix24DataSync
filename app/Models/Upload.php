<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'file',
        'processed'
    ];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    protected static function booted(): void
    {
        self::deleted(function (Upload $customerDocument) {
            Storage::disk('public')->delete($customerDocument->file);
        });
    }

    protected static function boot()
    {
        parent::boot();

        /** @var Upload $model */
        static::updating(function ($model) {
            if ($model->isDirty('file') && ($model->getOriginal('file') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('file'));
            }
        });
    }
}