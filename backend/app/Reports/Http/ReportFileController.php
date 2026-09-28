<?php

namespace App\Reports\Http;

use App\Reports\Infrastructure\Models\Report;
use Illuminate\Support\Facades\Storage;

class ReportFileController
{
    public function download(Report $report)
    {
        abort_unless($report->file, 404);

        return Storage::disk($report->file->disk)->download(
            $report->file->path,
            $report->file->original_name,
        );
    }

    public function preview(Report $report)
    {
        abort_unless($report->file, 404);

        $file = $report->file;

        return response(
            Storage::disk($file->disk)->get($file->path),
            200,
            [
                'Content-Type' => $file->mime,
                'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
            ],
        );
    }
}
