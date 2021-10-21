<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(Request $request)
    {
        $jResponse = array();
        $jResponse['success'] = true;
        $jResponse['message'] = 'OK';
        $path = \Storage::cloud()->put('files', $request->file('item'));
        $url=\Storage::cloud()->temporaryUrl($path, \Carbon\Carbon::now()->addMinutes(1));
        $jResponse['data'] = array(
            "url"=>$url,
            "path"=>$path
        );

        return \Response::json($jResponse, 201);
    }

    public function show(Request $request)
    {
        $jResponse = array();
        $jResponse['success'] = true;
        $jResponse['message'] = 'OK';
        $jResponse['data'] = array(
            "url" => \Storage::cloud()->temporaryUrl($request->path, 
            \Carbon\Carbon::now()->addMinutes(1))
        );
        return \Response::json($jResponse, 201);
    }
}
