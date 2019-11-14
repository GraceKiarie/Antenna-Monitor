<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    public $incrementing = false;

    protected $fillable = ['site_id','cell_id','cell_name','mnc','status','technology','bcch_uarfcn_earfcn','bsci_psc_pci'];
}
