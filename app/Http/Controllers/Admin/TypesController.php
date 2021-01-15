<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TypesController extends Controller
{
    public function index(){

        $data = [];
        $types = Type::all();
        $data['types'] = Type::paginate(20);
        $data['count'] = $data['types']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.type.index', $data);
    }
    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['type'] = null;
        if(!is_null($id)){
            $data['type'] = Type::findOrFail($id);
        }
        return view('admin.type.add', $data);
    }
    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Type::create($data);
        } else{
            Type::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/type?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect("admin/type")->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDelete($id){

        $type = Type::findOrFail($id);
        $type->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/type".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect("admin/type")->with('errors', 'Запись успешна удалена');
        }
    }
}
