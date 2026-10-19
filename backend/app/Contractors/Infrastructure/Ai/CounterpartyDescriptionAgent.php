<?php

namespace App\Contractors\Infrastructure\Ai;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;

final class CounterpartyDescriptionAgent implements Agent
{
    use Promptable;

    public function instructions(): string
    {
        return <<<'PROMPT'
        Составь краткое описание контрагента для PDF-отчёта.
        Используй только предоставленные данные. Разверни массив вглубь и изучу его вдоль и поперек.
        Не выдумывай факты и не делай бездоказательных выводов
        о надёжности компании.
        Если информации недостаточно, укажи это.
        Ответ на русском языке, 3-5 предложений.
        PROMPT;
    }
}
