<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; // SoftDelete for inactive feature
use App\Models\User;  // import post

use Illuminate\Database\Eloquent\Relations\Relation;
Relation::morphMap([
  'Post' => 'App\Models\Post',
  'Comment' => 'App\Models\Comment',
]);

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    //  Polymorphic morphTo relation
    public function commentable(){
        return $this->morphTo();
    }

    //  Polymorphic morphMany relation
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    // use belongsTo relation(Inverse) with foreignkey & reduce read query
    public function user(){
        return $this->belongsTo(User::class);
    }

}
