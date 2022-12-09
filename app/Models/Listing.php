<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    //Mass assignment method 1
    //protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];



    //FILTERING
    public function scopeFilter($query, array $filters) { //will enable us to filter from controllers

        //filter by query i.e tag
        if($filters['tag'] ?? false ) {
            //choose where we want to filter from
            $query->where('tags', 'like', '%' . request('tag') . '%' ); 
            //above, it's going to search whatever that tag is in, in the tags column in the database table
        }


        //filter by search
        if($filters['search'] ?? false ) {
            //choose where we want to search from
            $query->where('title', 'like', '%' . request('search') . '%' )
            ->orWhere('description', 'like', '%' . request('search') . '%' ) 
            ->orWhere('tags', 'like', '%' . request('search') . '%' ); 
            
            //add we input search because thats what we are matching
            //above, it's going to search whatever that tag is in the tags column in the database table
        }
    }

    //Relatioship to user 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
