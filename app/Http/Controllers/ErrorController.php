<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    // 404 Not Found
    public function not_found()
    {
        header('HTTP/1.1 404 Not Found');
        return view('page.errors.404');
    }

    // 403 Forbidden
    public function forbidden()
    {
        header('HTTP/1.1 403 Forbidden');
        return view('page.errors.403');
    }

    // 500 Internal Server Error
    public function server_error()
    {
        header('HTTP/1.1 500 Internal Server Error');
        return view('page.errors.500');
    }
}
