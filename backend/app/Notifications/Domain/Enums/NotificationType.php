<?php

namespace App\Notifications\Domain\Enums;

enum NotificationType: string
{
    case REPORT_READY = 'report_ready';
    case REPORT_FAILED = 'report_failed';

    public function label(): string
    {
        return match ($this) {
            self::REPORT_READY => 'Отчет готов',
            self::REPORT_FAILED => 'Ошибка при формировании отчета',
        };
    }
}
