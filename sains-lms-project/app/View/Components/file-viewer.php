<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class FileViewer extends Component
{
    public $path;
    public $url;
    public $extension;
    public $basename;

    public function __construct($path)
    {
        $this->path = $path;
        $this->basename = basename($path);
        $this->extension = Str::lower(pathinfo($this->basename, PATHINFO_EXTENSION));
        $this->url = asset('storage/' . $this->path);
    }

    public function render()
    {
        return view('components.file-viewer');
    }
}
