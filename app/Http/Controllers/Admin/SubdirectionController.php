<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\Direction;
use App\Models\Subdirection;
use Illuminate\Support\Facades\Input;

class SubdirectionController
{
    public function index(){

        $data = [];
        $subdirections = Subdirection::orderBy('id', 'desc');
        $data['subdirections'] = $subdirections->paginate(20);
        $data['count'] = $data['subdirections']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.subdirection.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['subdirections'] = null;
        $data['directions'] = Direction::pluck('name_ru', 'id')->all();
        if(!is_null($id)){
            $data['subdirections'] = Subdirection::findOrFail($id);
        }
        return view('admin.subdirection.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Subdirection::create($data);
        } else{
            Subdirection::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/subdirection?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/subdirection')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['subdirection'] = Subdirection::findOrFail($id);
        return view('admin.subdirection.view', $data);
    }

    public function getDelete($id){

        $subdirection = Subdirection::findOrFail($id);
        $subdirection->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/subdirection?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/subdirection')->with('errors', 'Запись успешна удалена');
        }
    }

}