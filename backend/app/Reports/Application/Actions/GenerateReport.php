<?php

namespace App\Reports\Application\Actions;

use App\Contractors\Domain\Services\GenerateCounterpartyDescription;
use App\Contractors\Infrastructure\Models\Counterparty;
use App\Reports\Domain\Services\PdfReportGenerator;
use App\Reports\Infrastructure\Models\Report;
use Exception;
use Illuminate\Support\Facades\DB;

final class GenerateReport
{
    public function __construct(
        private readonly PdfReportGenerator $pdfReportGenerator,
        private readonly GenerateCounterpartyDescription $descriptionGenerator
    ) {}

    public function handle(
        Counterparty $counterparty,
        int $user_id
    ): void {
        try {
            $description = $this->descriptionGenerator->handle($counterparty);
        } catch (Exception $e) {
            $description = 'Не удалось сгенерировать описание контрагента: ' . $e->getMessage();
        }

        DB::transaction(function () use ($counterparty, $user_id, $description) {
            $report = Report::create([
                'name' => "Отчёт по {$counterparty->inn}",
                'description' => $description,
                'status' => 'processing',
                'counterparty_id' => $counterparty->id,
                'created_by' => $user_id,
            ]);

            $data = $counterparty->toArray();
            $data['report_description'] = $description;

            $file = $this->pdfReportGenerator->generate(
                $data,
                $user_id
            );

            $report->update([
                'file_id' => $file->id,
                'status' => 'completed',
            ]);
        });
    }
}
