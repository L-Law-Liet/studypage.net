<?php

namespace App\Http\Controllers\Admin;

use App\Models\Callback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CallbackController
{
    public function index()
    {
        $data = [];
        $faq = Callback::orderBy('id', 'desc');
        $data['callback'] = $faq->paginate(20);
        $data['count'] = $data['callback']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.callback.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['callback'] = null;
        if(!is_null($id)){
            $data['callback'] = Callback::findOrFail($id);
        }
        return view('admin.callback.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Callback::create($data);
        } else{
            Callback::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/callback?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/callback')->with('success', 'Запись успешна сохранена');
        }

    }

    public function getView($id){

        $data['callback'] = Callback::findOrFail($id);
        return view('admin.callback.view', $data);
    }

    public function getDelete($id){

        $callback = Callback::findOrFail($id);
        $callback->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/callback?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/callback')->with('errors', 'Запись успешна удалена');
        }
    }
}
