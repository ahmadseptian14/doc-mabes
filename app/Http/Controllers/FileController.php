<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:51200', // 50MB
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();

        // Default path jika tidak ada folder
        $pathPrefix = 'files';

        if ($request->folder_id) {
            $folder = Folder::findOrFail($request->folder_id);
            $segments = [];

            // Ambil semua parent slug ke atas
            while ($folder) {
                array_unshift($segments, $folder->slug);
                $folder = $folder->parent;
            }

            // Jadi: folders/slug/slug...
            $pathPrefix = 'folders/' . implode('/', $segments);
        }

        // Simpan file ke lokasi yang ditentukan
        $path = $file->storeAs($pathPrefix, $originalName, 'public');

        File::create([
            'folder_id' => $request->folder_id,
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => $file->getClientOriginalExtension(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }
}
