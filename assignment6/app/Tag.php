<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function items(){
        return $this->belongsToMany('App\Item', 'item_tag', 'tag_id', 'item_id')
            ->withTimestamps();
    }
}
