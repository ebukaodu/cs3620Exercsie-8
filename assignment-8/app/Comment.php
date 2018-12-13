<?php

namespace App;

use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = array(
        'name',
        'comment',
        'user_id',
        'item_id'
    );


    public function replies(){
    	return $this->hasMany('App\Reply');
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
