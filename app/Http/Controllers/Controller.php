<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getResponse($path, $method, $params)
    {
        $request = Request::create(config('service.api') . $path, $method, [$params]);
        $response = Route::dispatch($request);
        if ($method != 'DELETE') {
            return json_decode($response->getContent(), true);
        } else {
            return $response->getContent();
        }
    }
}
