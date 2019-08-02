<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property int user_id
 * @property int id
 * @property string description
 * @property string left_image
 * @property string right_image
 * Class Post
 * @package App
 */
class Post extends Model
{
    protected $fillable = ['description', 'left_image', 'right_image', 'user_id'];
    protected $appends = ['user', 'votes', 'user_is_voted'];
    protected $guarded = ['id'];

    function getUserAttribute()
    {
        return User::find($this->user_id)
            ->setHidden(['api_token', 'password', 'created_at', 'updated_at', 'email', 'remember_token']);
    }

    function getVotesAttribute()
    {
        $votes = DB::table('votes')->where('post_id', $this->id)->get();
        $thisVotes = $votes->where('is_this', 1)->count();
        $thatVotes = $votes->where('is_this', 0)->count();
        return array("thisVotes" => $thisVotes, "thatVotes" => $thatVotes);
    }

    function getUserIsVotedAttribute()
    {
        $user_id = Auth::user()->id; //current user
        $votes = DB::table('votes')
            ->where('user_id', $user_id)
            ->where('post_id', $this->id)->exists();

        return $votes;
    }

}
