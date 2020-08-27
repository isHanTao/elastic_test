<?php

namespace App\Models;


use Laravel\Scout\Searchable;

class Sentence extends BaseModel
{
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sentence', 'from', 'creator','type'
    ];

    public function getKey()
    {
        return $this->id;
    }
    public function toSearchableArray()
    {
        return [
            'sentence' => $this->sentence,
            'from' => $this->from,
            'creator' => $this->creator
        ];
    }

    public function searchableAs()
    {
        return 'sentence';
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
