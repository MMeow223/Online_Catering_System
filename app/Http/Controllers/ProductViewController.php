<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Good;
use App\Http\Controllers\Controller;

class ProductViewController extends Controller
{
    public function productInfo()
    {
        /*
         * if no query, then display all the products available
         * if there is a query, then display the queried products
        */
        $search = request()->query('search');

        if ($search) {
            $products = Good::where('good_name', 'LIKE', '%'.$search.'%')->paginate(40);
        }
        else {
            $products = Good::paginate(40);
        }

        return view('home')
            ->with('products', $products);
    }

}
