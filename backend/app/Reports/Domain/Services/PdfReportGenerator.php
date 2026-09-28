<?php

namespace App\Reports\Domain\Services;

use App\Reports\Infrastructure\Models\Report;
use App\Shared\Application\Services\FileService;
use App\Shared\Infrastructure\Services\FileStorage;
use App\Shared\Infrastructure\Models\File;
use Barryvdh\DomPDF\Facade\Pdf;



class PdfReportGenerator
{
    public function __construct(
        private readonly FileStorage $fileStorage,
        private readonly FileService $fileService,
    ) {}
    public function generate(array $data): File
    {
        $pdf = Pdf::loadView('reports.pdf.contractor-report', [
            'data' => $data,
        ]);

        $contents = $pdf->output();

        $path = sprintf(
            'reports/%s/%s.pdf',
            $data['inn'],
            $data['id'],
        );

        $this->fileStorage->put(
            path: $path,
            contents: $contents,
            meta: [
                'type' => 'contractor_report',
                'inn' => $data['inn'],
            ],
        );


        $file =  $this->fileService->createFromStoredPath(
            $path,
            null,
            auth()->id(),
            's3',
            [
                'original_name' => sprintf('report_%s.pdf', $data['id']),
                'mime' => 'application/pdf',
                'size' => strlen($contents),
                'hash' => md5($contents),
            ],
        );

        return $file;
    }
}
