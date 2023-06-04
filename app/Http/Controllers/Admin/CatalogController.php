<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Country;
use App\Models\Season;
use App\Models\Size;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::with('category')->get();
        return view('admin.catalog.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all()->pluck('name', 'id');
        $country = Country::all()->pluck('country', 'id');
        $season = Season::all()->pluck('season', 'id');
        $gender = Catalog::all()->pluck('gender');
        /* $size = Size::all()->pluck('size', 'id');
        $sizes = Size::where('catalog_id', $catalog->id)->get(); */
        $sizes = Size::where('size', '-')->get();
        $selectedSizes = $sizes->pluck('size')->toArray();
        $catalog = new Catalog();
        return view('admin.catalog.create', compact('category', 'catalog', 'country', 'selectedSizes', 'season', 'gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'country_id'=>'required',
            'content'=>'required',
            'size'=>'required',
            'season_id'=>'required',
            'price'=>'required|numeric',
        ]);
        
        $catalog = Catalog::create($request->all());

        // Создание нового размера в таблице sizes
        foreach($request->size as $size)
        {
            $newSize = Size::create([
                'size' => $size,
                'catalog_id' => $catalog->id
            ]);
            $newSize->save();
        }
        
        return redirect('/admin/catalogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        $category = Category::all()->pluck('name', 'id');
        $country = Country::all()->pluck('country', 'id');
        $season = Season::all()->pluck('season', 'id');
        $sizes = Size::where('catalog_id', $catalog->id)->get();
        $selectedSizes = $sizes->pluck('size')->toArray(); // определяем выбранные размеры
        return view('admin.catalog.edit', compact('category', 'catalog', 'country', 'selectedSizes', 'season'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'country_id'=>'required',
            'content'=>'required',
            'size'=>'required',
            'season_id'=>'required',
            'price'=>'required|numeric',
        ]);
        Size::where('catalog_id', $catalog->id)->delete();
        foreach($request->size as $size)
        {
            $newSize = Size::create([
                'size' => $size,
                'catalog_id' => $catalog->id
            ]);
            $newSize->save();
        }        
        $catalog->update($request->all());
        return redirect('/admin/catalogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect('/admin/catalogs');
    }
}
