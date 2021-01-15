<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Navigator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class NavigatorController
{
    public function index()
    {
        $data = [];
        $city = Navigator::orderBy('id', 'desc');
        $data['cityslider'] = $city->paginate(20);
        $data['count'] = $data['cityslider']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.navigator.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['cityslider'] = null;
        if(!is_null($id)){
            $data['cityslider'] = Navigator::findOrFail($id);
        }
        return view('admin.navigator.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        $data['image'] = null;
        if(is_null($id)){
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/cities/', $fileName);
            }
            Navigator::create($data);
        } else{
            unset($data['image']);
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/cities/', $fileName);
            }
            Navigator::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/navigator?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/navigator')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['cityslider'] = Navigator::findOrFail($id);
        $map = 'Главная , Навигатор';
        return view('admin.navigator.view', compact('data', 'map'));
    }

    public function getDelete($id){

        $cityslider = Navigator::findOrFail($id);
        $cityslider->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/navigator?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/navigator')->with('errors', 'Запись успешна удалена');
        }
    }
}
