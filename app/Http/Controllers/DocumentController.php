<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $folders = Folder::latest()->get();

        return Inertia::render('Document/Index', [
            'folders' => $folders
        ]);
    }

    public function show($id)
    {
        $folder = Folder::with('user')->findOrFail($id);

        return inertia('Document/Show', [
            'folder' => $folder
        ]);
    }
}
