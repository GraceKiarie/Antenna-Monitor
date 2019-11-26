<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'cell_id';

    protected $fillable = ['site_id','cell_id','sector_id','cell_name','mnc','status','technology','bcch_uarfcn_earfcn','bsci_psc_pci','heading',
        'pitch','roll'];

    //relationship
    public function site()
    {
        return $this->belongsTo(Site::class,'site_id','site_id');
    }

}
