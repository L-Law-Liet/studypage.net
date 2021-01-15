<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sphere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SpheresController extends Controller
{
    public function index(){

        $data = [];
        $spheres = Sphere::all();
        $data['spheres'] = Sphere::paginate(20);
        $data['count'] = $data['spheres']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.sphere.index', $data);
    }
    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['sphere'] = null;
        if(!is_null($id)){
            $data['sphere'] = Sphere::findOrFail($id);
        }
        return view('admin.sphere.add', $data);
    }
    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Sphere::create($data);
        } else{
            Sphere::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/sphere?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/sphere')->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDelete($id){

        $sphere = Sphere::findOrFail($id);
        $sphere->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/sphere?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/sphere')->with('errors', 'Запись успешна удалена');
        }
    }
}
