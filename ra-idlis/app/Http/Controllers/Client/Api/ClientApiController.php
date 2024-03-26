<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use Illuminate\Http\Request;
use App\Models\Users;

class ClientApiController extends Controller {
    public function index() {
        // Client Fetching
        $user = Users::where('grpid', 'C')->paginate(20);
        return $user;
    }
    public function store(Request $request) {}
    public function show(String $slug) {}
    public function update(Request $request, String $slug) {}
    public function destroy(String $slug) {}
    protected function validator(array $data) {}
}