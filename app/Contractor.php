<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = ['contractor_name'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
