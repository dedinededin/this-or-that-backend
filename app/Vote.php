<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int user_id
 * @property int post_id
 * @property boolean is_this
 * Class Vote
 * @package App
 */
class Vote extends Model
{
    protected $fillable = ['is_this', 'post_id', 'user_id'];
}
