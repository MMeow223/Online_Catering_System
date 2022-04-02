<?php

namespace App\Http\Controllers;

use App\Models\GoodCategory;
use App\Models\GoodVariety;
use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //link to index page
        return view('goods.index')
            ->with('goods', Good::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //link to create page
        return view('goods.create')
            ->with('categories', GoodCategory::all());;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        //         validate
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'food_type_option' => 'required',
        ]);

        DB::table('goods')->insert([
            'good_name' => $request->input('name'),
            'good_description' => $request->input('description'),
            'good_image' => ($request->input('image') != "")?$request->input('image'):"default.jpg",
            'good_price' => $request->input('price'),
            'good_category_id' => $request->input('category_id'),
            'is_warm' => $request->input('food_type_option'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('goods.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $good = Good::find($id);
        return view('goods.show')
            ->with('good',$good)
            ->with('category', GoodCategory::find($good->good_category_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $good = Good::find($id);
        return view('goods.edit')
            ->with('good',$good)
            ->with('categories', GoodCategory::all())
            ->with('default_category', GoodCategory::find($good->good_category_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,int $id)
    {
//         validate
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required'
            ]);
//        dd($request->input('name'));

        DB::table('goods')
            ->where('id',$id)
            ->update([
                'good_name' => $request->input('name'),
                'good_price' => $request->input('price'),
                'good_description' => $request->input('description'),
                'good_category_id' => $request->input('category_id')
            ]);


        // redirect
        return redirect()->route('goods.show', $id)->with('success', 'Good updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // remove item from database
        GoodVariety::where('good_id',$id)->delete();
        Good::destroy($id);

        return redirect()->route('goods.index')
            ->with('success','Good deleted');
    }
}
