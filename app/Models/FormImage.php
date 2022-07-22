<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormImage extends Model
{
    protected $table = 'form_images';
    use HasFactory;

    public static function getByForm_id($form_id)
    {
        return self::where('general_form_id', $form_id)->get();
    }
}
