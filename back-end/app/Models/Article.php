<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = ['title','content','description','image','isdraft','ischecked','read_number','last_read_at','deleted_by','created_by','updated_by'];
    protected $hidden = ['created_at','updated_at'];


}
