<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

abstract class Controller
{
    public function site_id()
    {
        $site = Store::where('url', strtolower(request()->server('SERVER_NAME')))->first();
        return $site->id;
    }
}
