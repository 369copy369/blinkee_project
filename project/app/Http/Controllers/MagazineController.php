<?php

namespace App\Http\Controllers;

use App\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Magazines search endpoint
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function search () 
    {
        $magazines = Magazine::where('id', '!=', 0)->with('publisher')->paginate(9);

        return response()->json([
            'magazines' => $magazines
        ]);
    }

    /**
     * Show magazine by given id
     * 
     * @param integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show ($id) 
    {
        $data = [
            'magazine' => "Sorry, there is no magazine with given id (> $id <)"
        ];

        $magazine = Magazine::where('id', $id)->with('publisher')->first();

        if ($magazine) 
        {
            $data['magazine'] = $magazine;
        }

        return response()->json($data);
    }
}
