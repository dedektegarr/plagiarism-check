<?php

namespace App\Livewire\Plagiarism;

use Livewire\Component;
use Livewire\WithFileUploads;
use Smalot\PdfParser\Parser;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;

    public function uploadDocument()
    {
        $parser = new Parser();

        $pathName = $this->file->getPathname();
        $pdf = $parser->parseFile($pathName);

        $metadata = $pdf->getDetails();

        $data = [
            'author' => $metadata['Author'] ?? null,
            'title' => explode(".", $metadata['Title'])[0] ?? null,
            'pages' => $metadata['Pages'],
            'creation_date' => $metadata['CreationDate'],
            'mod_date' => $metadata['ModDate'],
            'file' => $this->file->getFilename()
        ];

        dd($data);
    }

    public function render()
    {
        return view('livewire.plagiarism.file-upload');
    }
}
