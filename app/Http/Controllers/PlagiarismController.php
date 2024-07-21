<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class PlagiarismController extends Controller
{
    public function index()
    {
        return view('plagiarism.index', ['title' => "Plagiarism Check", 'documents' => Document::all()]);
    }

    public function details(Document $document)
    {
        return view('plagiarism.details', ['title' => $document->title]);
    }
}
