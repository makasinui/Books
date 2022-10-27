<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Section;
class Book extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'author_id',
        'author_name',
        'section_id',
        'year',
        'hide',
        'description',
        'img'
    ];

    public function authors()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

}
