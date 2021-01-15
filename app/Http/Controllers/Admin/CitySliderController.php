<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CitySliderController
{
    public function index()
    {
        $data = [];
        $city = City::orderBy('id', 'desc');
        $data['cityslider'] = $city->paginate(20);
        $data['count'] = $data['cityslider']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.cityslider.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['cityslider'] = null;
        if(!is_null($id)){
            $data['cityslider'] = City::findOrFail($id);
        }
        return view('admin.cityslider.add', $data);
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
            City::create($data);
        } else{
            unset($data['image']);
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/cities/', $fileName);
            }
            City::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/cityslider?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/cityslider')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['cityslider'] = City::findOrFail($id);
        return view('admin.cityslider.view', $data);
    }

    public function getDelete($id){

        $cityslider = City::findOrFail($id);
        if($cityslider->delete()){
            $old = getcwd();
            chdir(public_path().'/img/cities');
            unlink(public_path().'/img/cities/'.$cityslider->image);
            chdir($old);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/cityslider?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/cityslider')->with('errors', 'Запись успешна удалена');
        }
    }
}
