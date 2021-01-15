<?php

namespace App\Http\Controllers\Admin;

use App\Models\Degree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DegreeController extends Controller
{
    public function index(){

        $data = [];
        $degrees = Degree::all();
        $data['degrees'] = Degree::paginate(20);
        $data['count'] = $data['degrees']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.degree.index', $data);
    }
    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['degree'] = null;
        if(!is_null($id)){
            $data['degree'] = Degree::findOrFail($id);
        }
        return view('admin.degree.add', $data);
    }
    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Degree::create($data);
        } else{
            Degree::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/degree?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/degree')->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDelete($id){

        $degree = Degree::findOrFail($id);
        $degree->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/degree?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/degree')->with('errors', 'Запись успешна удалена');
        }
    }
}
