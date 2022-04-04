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


//        dd("store");
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
    public static function staticStoreGoodVariety(Request $request){
//        dd($request);
        if($request->input('new_good_variety')!=null){
            $good_varieties = explode(',',$request->input('new_good_variety'));

            foreach ($good_varieties as $good_variety) {
                GoodVariety::create([
                    'good_id' => Good::where('good_name',$request->input('name'))->first()->id,
                    'variety_name' => $good_variety,
                    'is_available' => 1
                ]);
            }
        }
    }

    public static function staticEditGoodVariety(Request $request){

        $keys = array_keys($request->all());
        $keys = array_filter($keys, function($key) {
            return str_contains($key, 'variety-checkbox-');
        });

        $keys = array_map(function($key) {
            return intval(str_replace('variety-checkbox-', '', $key));
        }, $keys);

        $available_varieties_id = array_values($keys);
        $good_varieties = GoodVariety::where('good_id',Good::where('good_name',$request->input('name'))->first()->id)->get();

        $available_varieties_id = array();
//        dd($good_varieties);
        foreach ($good_varieties as $good_variety){
            // insert it into an array
            array_push($available_varieties_id,$good_variety->id);
        }

//        dd($available_varieties_id);

//        dd($good_varieties);
//        foreach ($good_varieties as $good_variety){
//            GoodVariety::find($good_variety->id)->update([
//                'is_available' => 0
//            ]);
//            $good_variety->save();
//        }
//        dd($available_varieties_id);


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
//        for($i=0;$i<count($good_varieties);$i++){
//            if(in_array($good_varieties[$i]->id,$available_varieties_id)){
//                GoodVariety::find($good_varieties[$i]->id)->update([
//                    'is_available' => 1
//                ]);
//            }else{
//                GoodVariety::find($good_varieties[$i]->id)->update([
//                    'is_available' => 0
//                ]);
//            }
//        }
//        foreach ($good_varieties as $good_variety){
//            if(in_array($good_variety->id,$available_varieties_id)){
//                GoodVariety::find($good_variety->id)->update([
//                    'is_available' => 1
//                ]);
//            }else{
//                GoodVariety::find($good_variety->id)->update([
//                    'is_available' => 0
//                ]);
//            }
//            $good_variety->save();
//        }
    }

}
