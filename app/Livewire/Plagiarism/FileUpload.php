<?php

namespace App\Livewire\Plagiarism;

use Livewire\Component;
use App\Models\Document;
use Exception;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use \Spatie\PdfToImage\Pdf;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $title;
    public $author;

    public function uploadDocument()
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf'
        ]);

        $pathName = $this->file->getPathname();

        // PDF Parser
        $parser = new Parser();
        $pdf = $parser->parseFile($pathName);
        $metadata = $pdf->getDetails();

        try {
            // upload file and get filename
            $fileOutputPath = $this->file->store('public/documents');
            $filenameArr = explode('/', $fileOutputPath);
            $filename = 'documents/' . $filenameArr[count($filenameArr) - 1];

            $data = [
                'id' => Str::uuid(),
                'author' => $this->author ?? null,
                'title' =>  $this->title ?? null,
                'pages' => $metadata['Pages'] ?? null,
                'creation_date' => $metadata['CreationDate'] ?? null,
                'mod_date' => $metadata['ModDate'] ?? null,
                'file' => $filename
            ];

            // PDF to image for upload pdf cover
            $time = time();
            $coverOutputPath = storage_path('app/public/cover/' . $time . '-' . $data['title'] . '.png');

            $pdfCover = new Pdf($pathName);
            $pdfCover->saveImage($coverOutputPath);

            $data['cover'] = 'cover/' . $time . '-' . $data['title'] . '.png';

            // save to database
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
