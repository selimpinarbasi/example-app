<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    //iki method ve bir çok satır ile yapılar işlem tek method ve tek satırda halledildi.
    //buna binayen route kısmında uri kısmına news/{id?} yandaki gibi ? işareti eklenmesi gerekmekte.
    /*function news()
    {
        $news = News::all();
        return $news;
    }*/
    //get News with id and without id {get}
    function news($id=null)
    {
        //$news = News::findorfail($id);
        return $id?News::find($id):News::all();
    }

    //create News {post}
    function addNews(Request $request)
    {
        $randomString = $this->RandomString();
        $newImage = time() . '-' . $request->title . $randomString . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImage);

        $news = new News;
        $news->category_id = $request->category_id;
        $news->user_id = $request->user_id;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->image = $newImage;

        $result = $news->save();

        if ($result)
        {
            return ["Data saved"];
        }
        else
        {
            return ["Fail"];
        }
    }

    // update news {put}
    function updateNews(Request $request)
    {
        $news = News::find($request->id);

        $news->category_id = $request->category_id;
        $news->user_id = $request->user_id;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->image = $request->image;

        $result = $news->save();

        if ($result)
        {
            return ["Data updated"];
        }
        else
        {
            return ["Fail"];
        }
    }

    function deleteNews($id)
    {
        $news = News::find($id);
        $result = $news->delete();
        if ($result)
        {
            return ["Data deleted"];
        }
        else
        {
            return ["Fail"];
        }
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