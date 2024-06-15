<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

//use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Vacancy extends Model


{

use HasFactory;
use Commentable;
use SoftDeletes;
 

//use Commentable;

protected $fillable = [

'user_id',

'title',

'body',

'image_path',

'time_to_read',

'is_published',

'priority',

];

public function user() {
    return $this->belongsTo(User::class);
}
public function categories() {
    return $this->belongsToMany(Category::class);
}
}