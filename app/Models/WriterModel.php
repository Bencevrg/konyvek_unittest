<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriterModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "writers";
    protected $fillable = ['name', 'portrait_path','bio'];

    public function books()
    {
        return $this->hasMany(BookModel::class, 'author_id');
    }
}
