<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Author extends BaseModel
{
    use Searchable;

    protected $table = 'authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '*'
    ];

    public function searchableAs()
    {
        return 'author';
    }
    public function getKey()
    {
        return $this->id;
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'desc' => $this->desc
        ];
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
