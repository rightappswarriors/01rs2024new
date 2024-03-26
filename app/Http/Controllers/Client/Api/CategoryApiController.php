<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryApiController extends Controller
{
    public function fetch() {
        $category = Category::get();
        return response()->json($category, 200);
    }
}
