<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table = 'tweets';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        "id",
        "text"
    ];

    /**
     * @param $all
     */
    static public function countWords ($all)
    {

        $tweets = $all->pluck('text');
        $string = json_encode($tweets);

        $arr = explode(" ", $string);

        $doNotCount = [
            "metoo"
        ];

        $noDouble = array_unique($arr);

        $words = array_diff($doNotCount, $noDouble);

        foreach ($words as $word) {
            $count = substr_count($string, $word);
        }
    }

    static public function countAndSort ($tweets) {

       $supArr = [];
       foreach ($tweets as $tweet) {
           $exploded = explode (" ", $tweet);
           $supArr = array_merge($supArr, $exploded);
       }

       $countedTweets = array_count_values($supArr);
       arsort($countedTweets);

       return $countedTweets;
    }

}
