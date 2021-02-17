<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable=['name'];

    protected $guarded=[];

    public function classroom()

    {
            return $this->belongsTo( Classroom::class,'class_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
