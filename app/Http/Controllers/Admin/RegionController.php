<?php

namespace App\Http\Controllers\Admin;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RegionController
{
    public function index()
    {
        $data = [];
        $city = Region::orderBy('id', 'desc');
        $data['region'] = $city->paginate(20);
        $data['count'] = $data['region']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.region.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['region'] = null;
        if(!is_null($id)){
            $data['region'] = Region::findOrFail($id);
        }
        return view('admin.region.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if (is_null($data['priority'])){
            $data['priority'] = 1;
        }
        if(is_null($id)){
            Region::create($data);
        } else{
            Region::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/region?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/region')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['region'] = Region::findOrFail($id);
        return view('admin.region.view', $data);
    }

    public function getDelete($id){

        $region = Region::findOrFail($id);
        $region->delete();
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/region?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/region')->with('errors', 'Запись успешна удалена');
        }
    }
}
