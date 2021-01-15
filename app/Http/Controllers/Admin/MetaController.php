<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\Meta;
use Illuminate\Support\Facades\Input;

class MetaController
{
    public function index(){

        $data = [];
        $directions = Meta::orderBy('id', 'desc');
        $data['directions'] = $directions->paginate(20);
        $data['count'] = $data['directions']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.meta.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['direction'] = null;
        if(!is_null($id)){
            $data['direction'] = Meta::findOrFail($id);
        }
        return view('admin.meta.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Meta::create($data);
        } else{
            Meta::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/meta?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/meta')->with('success', 'Запись успешна сохранена');
        }    }

    public function getView($id){

        $data['direction'] = Meta::findOrFail($id);
        return view('admin.meta.view', $data);
    }

    public function getDelete($id){

        $direction = Meta::findOrFail($id);
        $direction->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/meta?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/meta')->with('errors', 'Запись успешна удалена');
        }
    }

}