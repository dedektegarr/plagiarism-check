<?php

namespace App\Services;

use Spatie\PdfToImage\Pdf;
use Smalot\PdfParser\Parser;

class PDFService
{
    public function parseMetadata($pathname)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($pathname);

        return $pdf->getDetails();
    }

    public function uploadPdf($file)
    {
        $fileOutputPath = $file->store('public/documents');
        $filenameArr = explode('/', $fileOutputPath);
        $filename = 'documents/' . end($filenameArr);

        return $filename;
    }

    public function generateCoverImage($pathName, $title)
    {
        $time = time();
        $coverOutputPath = storage_path('app/public/cover/' . $time . '-' . $title . '.png');

        $pdfCover = new Pdf($pathName);
        $pdfCover->saveImage($coverOutputPath);

        return 'cover/' . $time . '-' . $title . '.png';
    }

    public function preprocessDocument($pathname)
    {
        $scriptPath = "../app/Python/Preprocess.py";
        $escaped = escapeshellarg($pathname);
        $command = escapeshellcmd("python $scriptPath $escaped");
        $output = shell_exec($command);

        return $output;
    }
}
