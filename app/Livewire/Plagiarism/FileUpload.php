<?php

namespace App\Livewire\Plagiarism;

use Livewire\Component;
use App\Models\Document;
use Exception;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;

    public function uploadDocument()
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf'
        ]);

        $parser = new Parser();

        $pathName = $this->file->getPathname();
        $pdf = $parser->parseFile($pathName);

        $metadata = $pdf->getDetails();

        try {
            // upload file and get filename
            $filename = $this->file->store('documents');

            $data = [
                'id' => Str::uuid(),
                'author' => $metadata['Author'] ?? null,
                'title' =>  isset($metadata['Title']) ? explode(".", $metadata['Title'])[0] : null,
                'pages' => $metadata['Pages'] ?? null,
                'creation_date' => $metadata['CreationDate'] ?? null,
                'mod_date' => $metadata['ModDate'] ?? null,
                'file' => $filename
            ];

            Document::create($data);

            return redirect()->back()->with('success', 'Dokumen berhasil di upload');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah dokumen');
        }
    }

    public function render()
    {
        return view('livewire.plagiarism.file-upload');
    }
}
