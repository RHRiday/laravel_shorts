<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'faq_questions';
    protected $fillable = ['question', 'answer', 'tag'];
}
