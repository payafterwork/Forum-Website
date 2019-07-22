<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use App\Question;
class Trending extends Model
{
    
    public function get()
	{
	    return array_map('json_decode',Redis::zrevrange($this->cacheKey(), 0, 4));	
	}
	public function pushh(Question $question){
        Redis::zincrby($this->cacheKey(),1,json_encode(['title'=>$question->qtitle,'path'=>$question->path()
      ])); // (what,incrementby,data)
	}
	public function cacheKey()
    {
        return app()->environment('testing')
            ? 'testing_trending_threads'
            : 'trending_threads';
    }
    /**
     * Reset all trending threads.
     */
    public function reset()
    {
        Redis::del($this->cacheKey());
    }
}
