<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    // 404 Not Found
    public function not_found()
    {
        header('HTTP/1.1 404 Not Found');
        return view('pages.error.404');
    }

    // 403 Forbidden
    public function forbidden()
    {
        header('HTTP/1.1 403 Forbidden');
        return view('pages.error.403');
    }

    // 500 Internal Server Error
    public function server_error()
    {
        header('HTTP/1.1 500 Internal Server Error');
        return view('pages.error.500');
    }
}
