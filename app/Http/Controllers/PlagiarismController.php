<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlagiarismController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->paginate(5)->map(function ($doc) {
            $doc->creation_date = Carbon::parse($doc->creation_date)->translatedFormat('d F Y');
            $doc->mod_date = Carbon::parse($doc->mod_date)->translatedFormat('d F Y');

            return $doc;
        });

        return view('plagiarism.index', ['title' => "Cek Plagiasi", 'documents' => $documents]);
    }

    public function details(Document $document)
    {
        return view('plagiarism.details', ['title' => $document->title ?? $document->author ?? 'Unkonwn']);
    }
}
