<?php
namespace App\Http\Controllers;
use App\Models\Good;
use App\Models\GoodCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        if(auth()->user()->is_admin) {
            return view('admin');
        } else {


            $search = request()->query('search');

            if ($search) {
                $products = Good::where('good_name', 'LIKE', '%'.$search.'%')->paginate(40);
            }
            else {
                $products = Good::paginate(40);
            }

            return view('home')
                ->with('products', $products)
                ->with('categories', GoodCategory::all());

        }
    }

    public function filterGoodBasedOnCategory($category_id) {
        $products = Good::where('good_category_id', $category_id)->paginate(40);
        $current_category_name = GoodCategory::find($category_id)->category_title;
        return view('home')
            ->with('products', $products)
            ->with('categories', GoodCategory::all())
            ->with('current_category_name', $current_category_name);
    }
}
