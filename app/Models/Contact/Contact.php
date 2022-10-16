<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function contactItems()
    {
        return $this->hasMany(ContactItem::class);
    }
}
