<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __construct()
    {
        // $this->middleware('api');
    }

    /**
     * Publishers list
     */
    public function list(Request $request)
    {
        $publishers = Publisher::where('id', '!=', 0)->with('magazines')->paginate(9);

        return response()->json([
            'publishers' => $publishers
        ]);
    }
}
