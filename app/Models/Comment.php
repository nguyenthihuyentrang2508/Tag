<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'truyen_id', 'parent_id' , 'body'];
    protected $primaryKey = 'id';
    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function truyen()
    {
        return $this->belongsTo(Truyen::class);
    }
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function report_comment()
    {
        return $this->hasOne(Reportcomment::class);
    }
}

