<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['contractor_id','team_name'];

    public function contract()
    {
        return $this->belongsTo(Contractor::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
