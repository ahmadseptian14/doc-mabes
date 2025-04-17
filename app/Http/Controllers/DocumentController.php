<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $folders = Folder::whereNull('parent_id')->latest()->get();

        return Inertia::render('Document/Index', [
            'folders' => $folders
        ]);
    }

    // public function show(Folder $folder)
    // {
    //     $childrens = Folder::with('user')->where('parent_id', $folder->id)->get();

    //     return inertia('Document/Show', [
    //         'folder' => $folder->load('user'),
    //         'childrens' => $childrens
    //     ]);
    // }

    public function show($path = null)
    {
        if (!$path) {
            // Jika tidak ada path, tampilkan root folder user
            $folder = Folder::whereNull('parent_id')->first();
        } else {
            // Split path berdasarkan "/"
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

        // Ambil sub-folder dari folder saat ini
        $childrens = Folder::with('user')
            ->where('parent_id', $folder->id)
            ->get();

        return inertia('Document/Show', [
            'folder' => $folder->load('user'),
            'childrens' => $childrens,
        ]);
    }

}
