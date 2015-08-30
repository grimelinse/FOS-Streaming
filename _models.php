<?php
class User extends Illuminate\Database\Eloquent\Model {

    protected $table = 'users';

    public function categories()
    {
        return $this->belongsToMany('Category');
    }

    public function getCategoryNamesAttribute()
    {
        $return = "";
        $prefix = '';
        foreach($this->categories as $category)
        {
            $return .= $prefix . ' ' . $category->name . '';
            $prefix = ', ';
        }

        return $return;
    }


    public function laststream()
    {
        return $this->hasOne('Stream', 'id', 'last_stream');
    }
}

class Stream extends Illuminate\Database\Eloquent\Model {

    public function category()
    {
        return $this->hasOne('Category', 'id', 'cat_id');
    }

    public function transcode()
    {
        return $this->hasOne('Transcode', 'id', 'trans_id');
    }

    public function getStatusLabelAttribute()
    {
        $return = [];
        $return['label'] = 'important';
        $return['text'] = 'STOPPED';

        if ($this->status == '1') {
            $return['label'] = 'success';
            $return['text'] = 'RUNNING';
        } else if ($this->status == '2') {
            $return['label'] = 'important';
            $return['text'] = 'ERROR';
        }

        return $return;
    }
}

class Category extends Illuminate\Database\Eloquent\Model {

    public function streams()
    {
        return $this->hasMany('Stream', 'cat_id', 'id');
    }
}

class Admin extends Illuminate\Database\Eloquent\Model { }
class Setting extends Illuminate\Database\Eloquent\Model { }
class Transcode extends Illuminate\Database\Eloquent\Model { }