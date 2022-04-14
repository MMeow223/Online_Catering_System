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
            ->with('goods', Good::orderBy('updated_at','DESC')->paginate(10));
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
            ->with('categories', GoodCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'food_type_option' => 'required|integer',
        ]);

        // check if has image file, then generate unique name, and store to public/images, otherwise assign a default image to it
        if($request->hasFile('image')){
            $image_file_path = 'image_'.time().'_'.rand(0,9).'.jpg';
            $request->file('image')->move(public_path('images'), $image_file_path);
        }
        else{
            $image_file_path = 'default.jpg';
        }

        // create new good
        DB::table('goods')->insert([
            'good_name' => $request->input('name'),
            'good_description' => $request->input('description'),
            'good_image' => $image_file_path,
            'good_price' => $request->input('price'),
            'good_category_id' => $request->input('category_id'),
            'is_warm' => $request->input('food_type_option'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // create the variety of the good
        GoodVarietyController::staticStoreGoodVariety($request);

        // redirect to index page
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
        // link to show page with good data and category data
        $good = Good::find($id);
        return view('goods.show')
            ->with('good',$good)
            ->with('category', GoodCategory::find($good->good_category_id))
            ->with('varieties', GoodVariety::where('good_id', $id)->orderBy('is_available','DESC')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // link to edit page with good data and category data
        $good = Good::find($id);
        return view('goods.edit')
            ->with('good',$good)
            ->with('categories', GoodCategory::all())
            ->with('default_category', GoodCategory::find($good->good_category_id))
            ->with('varieties', GoodVariety::where('good_id', $id)->orderBy('is_available','DESC')->get());
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
        // validate the data
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'food_type_option' => 'required',
            'availability_option' => 'required',
            ]);

        // check if has image file, then generate unique name, and store to public/images, otherwise assign a default image to it
        if($request->hasFile('image')){
            $image_file_path = 'image_'.time().'_'.rand(0,9).'.jpg';
            $request->file('image')->move(public_path('images'), $image_file_path);
        }
        else{
            $image_file_path = Good::find($id)->good_image;
        }

        // update good
        $query = DB::table('goods')
            ->where('id',$id)
            ->update([
                'good_name' => $request->input('name'),
                'good_price' => $request->input('price'),
                'good_description' => $request->input('description'),
                'good_category_id' => $request->input('category_id'),
                'is_warm' => $request->input('food_type_option'),
                'is_available' => $request->input('availability_option'),
                'good_image' => $image_file_path,
                'updated_at' => now(),
                // actually it will update this column automatically,
                // but we want to make sure the query is executed,
                // so add it wont give wrong error toast
            ]);

        // if update fail, then redirect to good.index page with error toast
        if(!$query){
            return redirect()->route('goods.index')->with('error','Record Added Failed. Please Try Again');
        }

        // update the variety of the good
        GoodVarietyController::staticEditGoodVariety($request);
        GoodVarietyController::staticStoreGoodVariety($request);

        // redirect to good.show page with success toast
        return redirect()->route('goods.show', $id)->with('success',$request->name . ' have been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // remove the varieties that are belongs to the good first
        GoodVariety::where('good_id',$id)->delete();

        // remove the good
        Good::destroy($id);

        // redirect admin back to the good.index page and prompt a success message
        return redirect()->route('goods.index')
            ->with('success','Good deleted');
    }

    public function view($id){
        $good = Good::find($id);
        return view('good-individual')
            ->with('products',Good::paginate(40))
            ->with('good',$good)
            ->with('category', GoodCategory::find($good->good_category_id))
            ->with('varieties', GoodVariety::where("good_id",$id)->get());
    }

}
