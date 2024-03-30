<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppUpload;

class UploadController extends Controller
{
    public function index() {
        return view('sample');
    }

    public function store(Request $request) {
    $file = $request->file('upload');
    if($file) {
        $name = $file->getClientOriginalName();
            $save = new AppUpload();
            $save->filepath = $name;
            return $save->filepath;
    } else {
        return "No uploaded file";
    }}
}