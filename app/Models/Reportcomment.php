<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportcomment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'comment_id'
        ]
        ;
    protected $primaryKey = 'id';
    protected $table = 'reportcomments';

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
  
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}

