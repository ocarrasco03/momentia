<?php

namespace App\Models;

use App\Core\Events\EventStatus;
use App\Core\Events\EventType;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, Blameable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'event_type',
        'starts_at',
        'ends_at',
        'expires_at',
        'location',
        'address',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_type' => EventType::class,
            'starts_at'  => 'datetime',
            'ends_at'    => 'datetime',
            'expires_at' => 'datetime',
            'status'     => EventStatus::class,
        ];
    }
}
