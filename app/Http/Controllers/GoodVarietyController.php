<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\GoodVariety;
use Illuminate\Http\Request;

class GoodVarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd("index");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodVariety  $goodVariety
     * @return \Illuminate\Http\Response
     */
    public function show(GoodVariety $goodVariety)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoodVariety  $goodVariety
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodVariety $goodVariety)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoodVariety  $goodVariety
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodVariety $goodVariety)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodVariety  $goodVariety
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodVariety $goodVariety)
    {
        //
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function staticStoreGoodVariety(Request $request){
        // if there is new variety entered
        if($request->input('new_good_variety') != null){
            // separate the varieties by comma
            $good_varieties = explode(',',$request->input('new_good_variety'));

            // loop through the varieties and create new varieties
            foreach ($good_varieties as $good_variety) {
                GoodVariety::create([
                    'good_id' => Good::where('good_name',$request->input('name'))->first()->id,
                    'variety_name' => $good_variety,
                    'is_available' => 1
                ]);
            }
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public static function staticEditGoodVariety(Request $request){

        // get all the keys from the request list
        $keys = array_keys($request->all());

        // get the keys that contain "variety-checkbox-"
        $keys = array_filter($keys, function($key) {
            return str_contains($key, 'variety-checkbox-');
        });

        // get the id from these keys
        $keys = array_map(function($key) {
            return intval(str_replace('variety-checkbox-', '', $key));
        }, $keys);

        // get all the varieties that are belongs to the good
        $good_varieties = GoodVariety::where('good_id',Good::where('good_name',$request->input('name'))->first()->id)->get();

        // loop through the varieties and add them to an array
        $available_varieties_id = array();
        foreach ($good_varieties as $good_variety){
            // insert it into an array
            array_push($available_varieties_id,$good_variety->id);
        }

        // loop and check if the requested varieties match existing varieties, if so, update them to available, otherwise, make them unavailable
        foreach ($available_varieties_id as $available_variety_id){
            if(in_array($available_variety_id,$keys)){
                GoodVariety::find($available_variety_id)->update([
                    'is_available' => 1
                ]);
            }else{
                GoodVariety::find($available_variety_id)->update([
                    'is_available' => 0
                ]);
            }
        }
    }
}
