<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporterrorTranh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'chaptertranh_id', 'chonloi', 'noidung', 'user_id'
        ]
        ;
    protected $primaryKey = 'id';
    protected $table = 'reporterrortranh';

    // public function truyen()
    // {
    //     return $this->belongsTo(Truyen::class);
    // }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function chaptertranh()
    {
        return $this->belongsTo(ChapterTranh::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
