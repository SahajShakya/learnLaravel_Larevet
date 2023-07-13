<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
//    protected $fillable = ['title', 'tags', 'company', 'location' ,'website', 'email', 'description'];

    public static function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false) {
            $query->where('tags','like','%' . request('tag') . '%');
            ////in query select * from 'listing' where 'tags' like '%laravel%' order by _created_at Desc
        }

        if($filters['search'] ?? false) {
            $query->where('title','like','%' . request('search') . '%')
                                    ->orWhere('description','like','%' . request('search') . '%')
                                        ->orWhere('tags','like','%' . request('search') . '%');
        }
    }

    //Define relationship to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
