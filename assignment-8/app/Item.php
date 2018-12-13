<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
protected $fillable = ['name', 'detail', 'price'];


    public function likes(){
        return $this->hasMany('App\Like', 'item_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'item_tag', 'item_id', 'tag_id')
            ->withTimestamps();
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value) {
        return strtoupper($value);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}