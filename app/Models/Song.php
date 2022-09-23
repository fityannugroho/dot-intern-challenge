<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year' => 'integer',
        'duration' => 'integer',
        'album_id' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'year',
        'genre',
        'artist',
        'duration',
        'album_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Bootstrap the model and its traits.
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Get the album that owns the song.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Get the formatted string duration of the song.
     *
     * @return string
     */
    public function getStrDurationAttribute(): string
    {
        // Check if the duration more than 1 hour
        if ($this->duration > 3600) {
            return gmdate('H:i:s', $this->duration);
        }

        return gmdate('i:s', $this->duration);
    }
}
