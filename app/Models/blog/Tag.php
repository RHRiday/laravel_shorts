<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'blog_tags';
    public $guarded = ['id'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
