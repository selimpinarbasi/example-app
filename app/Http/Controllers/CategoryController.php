<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')
            ->only(
                'edit',
                'update',
                'destroy',
            );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        return view('category.index', compact('categories'));

        // bütün kategoriler
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description;

        //required must be entered
        //


        $category-> save();

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findorfail($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($request->id);

        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('category.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Gym::findOrFail($id)->delete();
        Category::findOrFail($id)->delete();
        /*
        $this->categoryNews($id)->delete();
        $cate->delete();*/
        return redirect()->route('category.index');
    }
    public function categoryNews($id)
    {
        //kullanıcılar kategoriye tıkladığı zaman kategoriyle ilgili haberleri görebiliyor.
        $category = Category::findorfail($id);
        $news = News::all()->where('category_id', '=', $category->id);
        return view('news.index', compact('news'));
    }
}
