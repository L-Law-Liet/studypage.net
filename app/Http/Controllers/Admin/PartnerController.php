<?php

namespace App\Http\Controllers\Admin;

use App\Models\Parner;
use Illuminate\Support\Facades\Input;

class PartnerController
{
    public function index()
    {
        $data = [];
        $faq = Parner::orderBy('id', 'desc');
        $data['partner'] = $faq->paginate(20);
        $data['count'] = $data['partner']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.partner.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['partner'] = null;
        if(!is_null($id)){
            $data['partner'] = Parner::findOrFail($id);
        }
        return view('admin.partner.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        $data['image'] = null;
        if(is_null($id)){
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/partners/', $fileName);
            }
            Parner::create($data);
        } else{
            unset($data['image']);
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/partners/', $fileName);
            }
            Parner::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/partner?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/partner')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['partner'] = Parner::findOrFail($id);
        return view('admin.partner.view', $data);
    }

    public function getDelete($id){

        $partner = Parner::findOrFail($id);
        if($partner->delete()){
            $old = getcwd();
            chdir(public_path().'/img/partners');
            unlink(public_path().'/img/partners/'.$partner->image);
            chdir($old);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/partner?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/partner')->with('errors', 'Запись успешна удалена');
        }
    }
}
