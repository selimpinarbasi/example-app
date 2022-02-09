<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    function category($id=null)
    {
        return $id?Category::find($id):Category::all();
    }

    function addCategory(Request $request)
    {
        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description;

        $result = $category->save();

        if ($result)
        {
            return ["Data saved"];
        }
        else
        {
            return ["Failed"];
        }
    }

    function updateCategory(Request $request)
    {
        $category = Category::find($request->id);

        $category->name = $request->name;
        $category->description = $request->description;
        $result = $category->save();

        if ($result)
        {
            return ["Data update"];
        }
        else
        {
            return ["Failed"];
        }
    }

    function deleteCategory($id)
    {
        $category = Category::find($id);
        $result = $category->delete();

        if ($result)
        {
            return ["Data deleted"];
        }
        else
        {
            return ["Fail"];
        }
    }
}
