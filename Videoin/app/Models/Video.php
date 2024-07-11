<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
    ];

    public function getHasAccessAttribute()
    {
        // Implement your logic to check if the user has access
        return $this->access_status; // Example field
    }
}
