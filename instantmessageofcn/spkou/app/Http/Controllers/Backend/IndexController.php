<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Input;
use Datatables;
use Validator;
use DB;
use Carbon;
use App\Http\Controllers\BackendController;

class IndexController extends BackendController
{
    public function index() {
        return view('backend.index.index');
    }

}
