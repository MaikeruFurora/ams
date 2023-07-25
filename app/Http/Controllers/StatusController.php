<?php

namespace App\Http\Controllers;

use App\Models\AssetStatus;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function list(){
        return AssetStatus::get(['id','name']);
    }
}
