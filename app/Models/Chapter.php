<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Chapter extends Model implements Viewable
{
    
    use HasFactory;
    
    use InteractsWithViews;

    protected $dates = [
	    'created_at',
	    'updated_at'	   
	];
    public $timestamps = false;
    protected $fillable = [
        'truyen_id', 'tomtat', 'kichhoat', 'tieude',
        'noidung', 'slug_chapter', 'created_at','updated_at',
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
     }
     
     public function getModelLabel()
     {
         return $this->getOriginal('title', $this->title);
     }
}
