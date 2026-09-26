<?php

namespace App\Notifications\Domain\Enums;

enum NotificationStatus: string
{
    case PENDING = 'pending';
    case SENT = 'sent';
    case FAILED = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'В ожидании',
            self::SENT => 'Отправлено',
            self::FAILED => 'Ошибка при отправке',
        };
    }
}
