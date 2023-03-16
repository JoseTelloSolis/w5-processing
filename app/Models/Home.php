<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $table = "home";
    protected $fillable = [
        'image',
        'title',
        'title_section1',
        'text_section1',
        'image_section1',
        'title_section2',
        'text_section2',
        'subtitle1_section2',
        'text1_section2',
        'image1_section2',
        'subtitle2_section2',
        'text2_section2',
        'image2_section2',
        'subtitle3_section2',
        'text3_section2',
        'image3_section2',
        'title_section3'
    ];
}
