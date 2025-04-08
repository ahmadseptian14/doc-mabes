<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    // public function index()
    // {
    //     $folders = Folder::all();

    //     return inertia('Pages/Document/Index', [
    //         'folders' => $folders
    //     ]);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Folder::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
