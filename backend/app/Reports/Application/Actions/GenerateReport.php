<?php

namespace App\Reports\Application\Actions;

use App\Contractors\Infrastructure\Models\Counterparty;
use App\Reports\Domain\Services\PdfReportGenerator;
use App\Reports\Infrastructure\Models\Report;
use Illuminate\Support\Facades\DB;

final class GenerateReport
{
    public function __construct(
        private readonly PdfReportGenerator $pdfReportGenerator,
    ) {}

    public function handle(
        Counterparty $counterparty,
        int $user_id
    ): void {
        DB::transaction(function () use ($counterparty, $user_id) {
            $report = Report::create([
                'name' => "Отчёт по {$counterparty->inn}",
                'description' => 'Отчёт о контрагенте',
                'status' => 'processing',
                'counterparty_id' => $counterparty->id,
                'created_by' => $user_id,
            ]);

            $file = $this->pdfReportGenerator->generate(
                $counterparty->toArray(),
                $user_id
            );

            $report->update([
                'file_id' => $file->id,
                'status' => 'completed',
            ]);
        });
    }
}
