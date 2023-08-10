<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StdAtt extends Model
{
    use HasFactory;

    protected $table = 'atts';
    protected $guarded = ['id'];
}
