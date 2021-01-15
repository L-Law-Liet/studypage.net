<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Social;
use Illuminate\Support\Facades\Input;

class SocialController
{
    public function index(){

        $data = [];
        $directions = Social::orderBy('id', 'desc');
        $data['directions'] = $directions->paginate(20);
        $data['count'] = $data['directions']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.social.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['direction'] = null;
        if(!is_null($id)){
            $data['direction'] = Social::findOrFail($id);
        }
        return view('admin.social.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['link'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/social/', $fileName);
            }
            Social::create($data);
        } else{
            unset($data['image']);
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['link'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/social/', $fileName);
            }
            Social::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/social?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/social')->with('success', 'Запись успешна сохранена');
        }    }

    public function getView($id){

        $data['direction'] = Social::findOrFail($id);
        return view('admin.social.view', $data);
    }

    public function getDelete($id){

        $direction = Social::findOrFail($id);
        $direction->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/social?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/social')->with('errors', 'Запись успешна удалена');
        }
    }

}
