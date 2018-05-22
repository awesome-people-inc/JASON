<?php
/**
 * Created by PhpStorm.
 * User: Nitish Kumar
 * Date: 5/22/2018
 * Time: 9:18 AM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $searchIp = $request->input('search');
        $results = User::where('name', 'like', '%'.$searchIp.'%')->get();
        return view('search')->with(['result' => $results]);
    }
}