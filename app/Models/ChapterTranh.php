<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
class ChapterTranh extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;
    protected $dates = [
	    'created_at',
	    'updated_at',
	];
    public $timestamps = false;
    protected $fillable = [
        'truyen_id', 'tomtat', 'kichhoat', 'tieude',
        'image', 'slug_chaptertranh','created_at','updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chaptertranh';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
     }
}
