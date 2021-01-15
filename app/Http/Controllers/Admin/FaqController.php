<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FaqController
{
    public function index()
    {
        $data = [];
        $faq = Faq::orderBy('id', 'desc');
        $data['faq'] = $faq->paginate(20);
        $data['count'] = $data['faq']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.faq.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['faq'] = null;
        if(!is_null($id)){
            $data['faq'] = Faq::findOrFail($id);
        }
        return view('admin.faq.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Faq::create($data);
        } else{
            Faq::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/faq?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/faq')->with('success', 'Запись успешна сохранена');
        }    }

    public function getView($id){

        $data['faq'] = Faq::findOrFail($id);
        return view('admin.faq.view', $data);
    }

    public function getDelete($id){

        $faq = Faq::findOrFail($id);
        $faq->delete();


        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/faq?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/faq')->with('errors', 'Запись успешна удалена');
        }
    }
}
