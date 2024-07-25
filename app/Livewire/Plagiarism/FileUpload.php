<?php

namespace App\Livewire\Plagiarism;

use Livewire\Component;
use App\Models\Document;
use App\Models\WordToken;
use Exception;
use Illuminate\Support\Str;
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
            // upload pdf and get filename
            $filename = $pdfService->uploadPdf($this->file);

            // parse metadata
            $metadata = $pdfService->parseMetadata($pathName);

            $document = [
                'id' => Str::uuid(),
                'author' => $this->author ?? null,
                'title' =>  $this->title ?? null,
                'pages' => $this->pages ?? null,
                'creation_date' => $metadata['CreationDate'] ?? null,
                'mod_date' => $metadata['ModDate'] ?? null,
                'file' => $filename
            ];

            // get preprocessed document text
            $wordTokens = ['id' => Str::uuid(), 'document_id' => $document['id'], 'word_tokens' => $pdfService->preprocessDocument($pathName)];

            // save to database
            Document::create($document);
            WordToken::create($wordTokens);

            return redirect()->route('plagiarism.details', $document['id'])->with('success', 'Dokumen berhasil di upload');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah dokumen');
        }
    }

    public function render()
    {
        return view('livewire.plagiarism.file-upload');
    }
}
