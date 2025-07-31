<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    protected $fillable = ['subcategory_id', 'title', 'author', 'body'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}