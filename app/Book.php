<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Nicolaslopezj\Searchable\SearchableTrait;

class Book extends Model
{
    use SearchableTrait;

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'books.title' => 10,
            'books.author' => 10,
            'books.published_year' => 5,
            'racks.name' => 4,
        ],
        "joins" => [
            'racks' => ['books.rack_id','racks.id'],
        ]
    ];
    protected $fillable = ["title","author","published_year", "rack_id"];


    public function rack(){
        return $this->belongsTo("App\Rack");
    }

    /**
     * @param string $term
     * @return Collection
     */
    public function searchBook(string $term) : Collection
    {
        return self::search($term)->get();
    }
}
