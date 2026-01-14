<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'is_featured',
        'title',
        'total_click',
        'total_download',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'total_click' => 'integer',
        'total_download' => 'integer',
    ];

    /**
     * Scope a query to only include featured galleries.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Increment the total click count.
     */
    public function incrementClick(): void
    {
        $this->increment('total_click');
    }

    /**
     * Increment the total download count.
     */
    public function incrementDownload(): void
    {
        $this->increment('total_download');
    }

    /**
     * Boot the model and register event listeners.
     */
    protected static function booted(): void
    {
        static::updated(function (self $model) {
            if ($model->isDirty('path')) {
                $oldPath = $model->getOriginal('path');
                if ($oldPath && $model->path !== $oldPath) {
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            }
        });

        static::deleted(function (self $model) {
            if ($model->path) {
                if (Storage::disk('public')->exists($model->path)) {
                    Storage::disk('public')->delete($model->path);
                }
            }
        });
    }
}
