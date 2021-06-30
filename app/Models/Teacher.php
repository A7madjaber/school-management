<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable=['Name'];

    protected $guarded=[];

public function gender(){
    return $this->belongsTo(Gender::class,'Gender_id');
}
public function specializations(){
    return $this->belongsTo(Specialization::class,'Specialization_id');
}

public function sections(){
    return $this->belongsToMany(Section::class,'teacher_section');
}

}
