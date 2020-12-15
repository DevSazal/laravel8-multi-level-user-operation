<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; // SoftDelete for inactive feature

use App\Models\User;  // import post

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    // use belongsTo relation(Inverse) with foreignkey & reduce read query
    public function user(){
        return $this->belongsTo(User::class);
    }
}
