<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Review extends Model
{
    protected $fillable = ['title', 'body','image'];

    //
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
