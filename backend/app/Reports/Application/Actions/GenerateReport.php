<?php

namespace App\Reports\Application\Actions;

use App\Contractors\Domain\Services\GenerateCounterpartyDescription;
use App\Contractors\Infrastructure\Models\Counterparty;
use App\Reports\Domain\Services\PdfReportGenerator;
use App\Reports\Infrastructure\Models\Report;
use App\Shared\Infrastructure\Models\User;
use App\Shared\Providers\Filament\Resources\Reports\ReportResource;
use Exception;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

final class GenerateReport
{
    public function __construct(
        private readonly PdfReportGenerator $pdfReportGenerator,
        private readonly GenerateCounterpartyDescription $descriptionGenerator,
    ) {}

    /**
     * @param Counterparty $counterparty
     * @param User $user
     *
     * @return void
     */
    public function handle(
        Counterparty $counterparty,
        User $user
    ): void {
        Notification::make()
            ->title('Генерация отчёта')
            ->body('Начата генерация отчёта по контрагенту '
                . $counterparty->inn)
            ->info()
            ->sendToDatabase($user);

        $description = $this->generateDescription($counterparty);

        $data = $counterparty->toArray();
        $data['report_description'] = $description;

        $file = $this->pdfReportGenerator->generate($data, $user->id);

        $report = Report::create([
            'name' => "Отчёт по {$counterparty->inn}",
            'description' => $description,
            'status' => 'completed',
            'counterparty_id' => $counterparty->id,
            'created_by' => $user->id,
            'file_id' => $file->id,
        ]);

        Notification::make()
            ->title('Генерация отчёта')
            ->body('Генерация отчёта по контрагенту '
                . $counterparty->inn . ' завершена')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('Посмотреть отчёт')
                    ->url(ReportResource::getUrl('view', ['record' => $report])),
            ])
            ->sendToDatabase($user);
    }

    /**
     * @param Counterparty $counterparty
     *
     * @return string
     */
    private function generateDescription(Counterparty $counterparty): string
    {
        try {
            return $this->descriptionGenerator->handle($counterparty);
        } catch (Exception $e) {
            report($e);

            return 'Не удалось сгенерировать описание контрагента.';
        }
    }
}
