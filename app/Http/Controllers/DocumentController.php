<?php

namespace App\Http\Controllers;

use App\Models\File;
use Inertia\Inertia;
use App\Models\Folder;

class DocumentController extends Controller
{
    public function index()
    {
        $folders = Folder::whereNull('parent_id')->latest()->get();
        $files = File::whereNull('folder_id')->latest()->get();

        return Inertia::render('Document/Index', [
            'folders' => $folders,
            'files' => $files
        ]);
    }

    public function show($path = null)
    {
        if (!$path) {
            $folder = Folder::whereNull('parent_id')->first();
        } else {
            $slugs = explode('/', $path);
            $parent = null;
            $folder = null;
            foreach ($slugs as $slug) {
                $folder = Folder::where('slug', $slug)
                    ->where('parent_id', optional($parent)->id)
                    ->firstOrFail();
                $parent = $folder;
            }
        }

        $childrens = Folder::with('user')
            ->where('parent_id', $folder->id)
            ->get();

        $files = File::where('folder_id', $folder->id)->get();

        return inertia('Document/Show', [
            'folder' => $folder->load('user'),
            'childrens' => $childrens,
            'files' => $files
        ]);
    }

}
