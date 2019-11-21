<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallationReport extends Model
{

    protected $fillable =
        [
            'qr_number', 'installation_report','status', 'user_id'

            ];
}
