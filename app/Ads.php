<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    
    public $timestamps = false;
    public $attributes = [

    ];
    public $appends = [
        'title_any',
        'description_any'
    ];
    
    public function getTitleAnyAttribute () {
        $attr = $this->attributes;
        return $attr['titleru']
            ?? $attr['titleuk']
            ?? $attr['titleen']
            ?? $attr['titlepl']
            ?? ''; 
    }

    public function getDescriptionAnyAttribute () {
        $attr = $this->attributes;
        return $attr['textru']
            ?? $attr['description']
            ?? $attr['textuk']
            ?? $attr['texten']
            ?? $attr['textpl']
            ?? ''; 
    }
}
