<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'user_id', 'slug'];
    protected $appends = ['full_path'];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function getFullPathAttribute()
    {
        $segments = [];
        $folder = $this;

        while ($folder) {
            array_unshift($segments, $folder->slug);
            $folder = $folder->parent;
        }

        return implode('/', $segments);
    }


}
