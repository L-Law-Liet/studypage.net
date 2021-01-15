<?php

namespace App\Http\Controllers\Admin;

use App\Models\RatingCategory;
use Illuminate\Support\Facades\Input;

class CategoryController
{
    public function index(){

        $data = [];
        $category = RatingCategory::orderBy('id', 'desc');
        $data['category'] = $category->paginate(20);
        $data['count'] = $data['category']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.category.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['category'] = null;
        if(!is_null($id)){
            $data['category'] = RatingCategory::findOrFail($id);
        }
        return view('admin.category.add', $data);
    }

    public function postAdd($id = null){

        $data = Input::all();
        if(is_null($id)){
            RatingCategory::create($data);
            return \redirect('admin/category')->with('success', 'Запись успешна сохранена');
        } else{
            RatingCategory::findOrFail($id)->update($data);
            return \redirect('admin/category')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['category'] = RatingCategory::findOrFail($id);
        return view('admin.category.view', $data);
    }

    public function getDelete($id){

        $category = RatingCategory::findOrFail($id);
        $category->delete();

        return \redirect('admin/category')->with('error', 'Запись успешна удалена');
    }

}