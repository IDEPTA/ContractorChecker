<?php

namespace App\Notifications\Infrastructure\Models;

use App\Notifications\Domain\Enums\NotificationStatus;
use App\Notifications\Domain\Enums\NotificationType;
use App\Reports\Infrastructure\Models\Report;
use App\Shared\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'report_id',
        'channel',
        'type',
        'status',
        'payload',
        'error_message',
        'sent_at'
    ];

    protected $casts = [
        'type' => NotificationType::class,
        'status' => NotificationStatus::class,
        'payload' => 'array',
        'sent_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
