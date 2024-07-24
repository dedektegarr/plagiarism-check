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

    public function generateCoverImage($pathName, $title)
    {
        $time = time();
        $coverOutputPath = storage_path('app/public/cover/' . $time . '-' . $title . '.png');

        $pdfCover = new Pdf($pathName);
        $pdfCover->saveImage($coverOutputPath);

        return 'cover/' . $time . '-' . $title . '.png';
    }
}
