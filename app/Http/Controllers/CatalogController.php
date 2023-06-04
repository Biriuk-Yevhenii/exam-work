<?php

namespace App\Http\Controllers;

use App\Models\Admin\Comment;
use App\Models\Cart;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Country;
use App\Models\Season;
use App\Models\Size;
use Creativeorange\Gravatar\Gravatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all();
        $comments = Comment::all();
        $max_price = Catalog::max('price');
        return view('catalog.men', compact('catalogs', 'comments', 'max_price'));
    }
    public function showCategory(Category $category)
    {
        $catalogs = Catalog::where('category_id', $category->id)->get();
        $comments = Comment::all();
        $max_price = Catalog::max('price');
        return view('catalog.category', compact('catalogs', 'category', 'comments', 'max_price'));
    }

    public function showProduct(Catalog $catalog)
    {
        
        /* $user = Auth::user();  
        $avatar = gravatar($user->email); */

        $products = Catalog::orderByRaw('RAND()')->limit(4)->get(); /* Products */
        $comments = Comment::where('catalog_id', $catalog->id)->paginate(3); /* Comments */
        $max_price = Catalog::max('price'); /* Max price */

        $country = Country::where('id', $catalog->country_id)->get();
        $country_name = $country[0]->country; // Country 
        $season = Season::where('id', $catalog->season_id)->get();
        $season_name = $season[0]->season; // Season 

        $sizes = Size::where('catalog_id', $catalog->id)->get();

        return view('catalog.readMore', compact('catalog', 'comments', 'products', 'max_price', 'country_name', 'season_name', 'sizes'));
    }

    public function filter(Request $request)
    {
        $catalog = Catalog::with('country')->get();
        $query = Catalog::query();

        
        if($request->size){ /* Size */
            $query->whereHas('sizes', function ($query) use ($request) {
                $query->whereIn('size', $request->size);
            });
        }

        if($request->country) /* Country */
        {
            /* foreach($request->country as $r) { */
                /* $query->whereHas('country', function ($query) use ($request) { */
                    $query->whereIn('country_id', $request->country);
                /* }); */
            /* } */
        }

        if($request->season)  /* Sesason */
        {
            $query->whereIn('season_id', $request->season);
        }
        
        if($request->gender) /* Gender */
        {
            $genderArray = explode(',', $request->gender);
            $query->whereIn('gender', $genderArray);
        }

        $range = explode(';', $request->my_range);
        $first_number = (int)$range[0];
        $second_number = (int)$range[1];

        $query->whereBetween('price', [$first_number, $second_number]);
        
        
        
        $catalogs = $query->get();
        
        $comments = Comment::all();
        $max_price = Catalog::max('price');
        return view('catalog.men', compact('catalogs', 'comments', 'max_price'));
    }

    public function resetFilter()
    {
        return redirect()->back();
    }

    public function cartUpdates(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        echo $productId;
        $cart = Cart::where('product_id', $productId)->first();
        $cart->quantity = $quantity;
        $cart->save();
        //return response()->json(['success' => true]);
    }
    
}
