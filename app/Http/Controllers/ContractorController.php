<?php

namespace App\Http\Controllers;

use App\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function showContractorsList()
    {
        $cons = Contractor::all();
        return view('auth.contractorlist', compact('cons'));
    }

    public function showAddContractorForm()
    {
        return view('auth.register_contractor');
    }
}
