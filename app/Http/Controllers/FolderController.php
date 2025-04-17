<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('folders')->where(function ($query) use ($request) {
                    return $query->where('user_id', Auth::id())
                                 ->where(function ($q) use ($request) {
                                     if ($request->parent_id) {
                                         $q->where('parent_id', $request->parent_id);
                                     } else {
                                         $q->whereNull('parent_id');
                                     }
                                 });
                }),
            ],
        ], [
            'name.required' => 'Nama folder tidak boleh kosong.',
            'name.unique' => 'Nama folder sudah ada.',
        ]);

        Folder::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back();
    }
}
