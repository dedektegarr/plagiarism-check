<?php

namespace App\Services;

use Spatie\PdfToImage\Pdf;
use Smalot\PdfParser\Parser;

class PDFService
{
    public function getText($pathname)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($pathname);

        $text = $pdf->getText();

        // Mengganti simbol \n dan \t dengan spasi
        $cleanText = str_replace(["\n", "\t"], " ", $text);

        // Menghapus karakter whitespace berlebih (opsional)
        $cleanText = preg_replace('/\s+/', ' ', $cleanText);

        return $cleanText;
    }

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

    public function preprocessText($text)
    {
        $scriptPath = "../app/Python/PreprocessText.py";
        $escapedText = escapeshellarg($text);
        $command = escapeshellcmd("python $scriptPath $escapedText");
        $output = shell_exec($command);

        return $output;
    }
}
