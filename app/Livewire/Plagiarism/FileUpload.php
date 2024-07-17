<?php

namespace App\Livewire\Plagiarism;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;

    public function uploadDocument()
    {
        dd($this->file);
    }

    public function render()
    {
        return view('livewire.plagiarism.file-upload');
    }
}
