<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    protected $fillable = ['subcategory_id', 'title', 'author', 'registered_by', 'body', 'structure', 'is_structured', 'status'];

    protected $casts = [
        'structure' => 'array',
        'is_structured' => 'boolean'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}