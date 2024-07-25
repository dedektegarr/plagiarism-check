<?php

namespace App\Services;

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

    public function preprocessDocument($pathname)
    {
        $scriptPath = "../app/Python/Preprocess.py";
        $escaped = escapeshellarg($pathname);
        $command = escapeshellcmd("python $scriptPath $escaped");
        $output = shell_exec($command);

        return $output;
    }
}
