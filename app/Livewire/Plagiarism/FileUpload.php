<?php

namespace App\Livewire\Plagiarism;

use Livewire\Component;
use App\Models\Document;
use Exception;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use \Spatie\PdfToImage\Pdf;
use Livewire\WithFileUploads;
use App\Services\PDFService;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $title;
    public $author;
    public $pages;

    public function uploadDocument(PDFService $pdfService)
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf'
        ]);

        $pathName = $this->file->getPathname();

        try {
            // get document text and parse metadata
            $fullText = $pdfService->getText($pathName);
            $metadata = $pdfService->parseMetadata($pathName);

            // upload pdf and get filename
            $filename = $pdfService->uploadPdf($this->file);

            $data = [
                'id' => Str::uuid(),
                'author' => $this->author ?? null,
                'title' =>  $this->title ?? null,
                'pages' => $this->pages ?? null,
                'creation_date' => $metadata['CreationDate'] ?? null,
                'mod_date' => $metadata['ModDate'] ?? null,
                'file' => $filename
            ];

            // Generate Document Cover
            $data['cover'] = $pdfService->generateCoverImage($pathName, $data['title']);

            // save to database
            Document::create($data);

            // === SAVE PREPROCESS TEXT ===
            $preprocessedText = $pdfService->preprocessText($fullText);

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
