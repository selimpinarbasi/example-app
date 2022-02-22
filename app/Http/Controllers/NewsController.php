<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use mysql_xdevapi\XSession;

class NewsController extends Controller
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
     * @return View
     */
    public function index()
    {
        //$category = Category::all();
        //$news = News::all()->sortByDesc('created_at');

        //return News::all()->sortByDesc('created_at');

        $news = Cache::remember('news',600, function () {
            return News::all()->sortByDesc('created_at');
        });
        Cache::forget('news');
        return view('news.index')->withNews($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('news.create', compact('category'));
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $randomString = $this->RandomString();

        $newImage = time() . '-' . $request->title . $randomString . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImage);

        News::create([
            'title'         => $request->title,
            'content'       => $request->content,
            'image'         => $newImage,
            'category_id'   => $request->category_id,
            'user_id'       => Auth::id(),
        ]);

        /*$article = new News;

        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $newImage;
        $article->category_id = $request->category_id;
        $article->user_id = Auth::id();*/
        //$article->date = $request->date;
        /*$request->merge([
            'user_id' => Auth::id(),
        ]);*/
        //$article-> save();

        //News::create($request->all());

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findorfail($id);

        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //kategorinin ismini çekmek için $category variable ını tanımladım
        $category = Category::all();
        $news = News::findOrFail($id);
        if (Auth::user()->isAdmin || $news->user()->is(\auth()->user()))
        {
            $news = News::findOrFail($id);
            return view('news.edit', compact('news','category'));
        }
        Cache::forget('news');
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $randomString = $this->rand_string(10);

        $article = News::find($request->id);

        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->category_id = $request->get('category_id');

        //adding image
        $path = public_path('images/');
        $fileOld = $path.$article->image;

        //unlink yani delete işlemi
        if (file_exists($fileOld))
        {
            unlink($fileOld);
        }

        $file = $request->image;
        $filename = $file->getClientOriginalName();
        $file->move($path, $filename);

        //DB ye kaydetme işlemi
        $article->image = $filename;
        $article->save();

        //Cache::forget('news');

        return redirect()->route('news.show', $article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($news->user_id == Au∑th::id() || Auth::user()->isAdmin) {

            $news->delete();

            return redirect()->route('news.index');
        }

        Cache::forget('news');
        return redirect('/');
    }

    //Kullanıcı haberlerim sekmesine tıkladığı zaman
    //haberlerini sıralı bir şekilde görebiliyor
    public function myNews()
    {
        $news = News::all()->where('user_id', '=', Auth::id())->sortByDesc('created_at');

        return view('news.index', compact('news'));
    }
    function RandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
