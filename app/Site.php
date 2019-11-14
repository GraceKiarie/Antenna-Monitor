<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $incrementing = false;

    protected $fillable = ['node_id','node_name','site_id','site_name','lac','mcc','vendor','lat','long'];
}
