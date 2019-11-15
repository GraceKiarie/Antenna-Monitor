<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $incrementing = false;
    protected $primaryKey ='site_id';

    protected $fillable = ['node_id','node_name','site_id','site_name','lac','mcc','vendor','lat','long'];

    //relationship
    public function cells()
    {
       return $this->hasMany(Cell::class,'site_id','site_id');
    }
}
