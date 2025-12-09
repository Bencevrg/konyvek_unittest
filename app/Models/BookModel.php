<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "books";
    protected $fillable = ['title', 'author_id', 'image_path', 'iban', 'price', 'description','genre'];

    public function writer()
    {
        return $this->belongsTo(WriterModel::class, 'author_id');
    }
}
