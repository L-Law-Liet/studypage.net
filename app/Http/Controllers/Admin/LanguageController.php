<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Support\Facades\Input;

class LanguageController
{
    public function index(){

        $data = [];
        $languages = Language::orderBy('id', 'desc');
        $data['languages'] = $languages->paginate(20);
        $data['count'] = $data['languages']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.language.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['language'] = null;
        if(!is_null($id)){
            $data['language'] = Language::findOrFail($id);
        }
        return view('admin.language.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Language::create($data);
        } else{
            Language::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/language?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/language')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['language'] = Language::findOrFail($id);
        return view('admin.language.view', $data);
    }

    public function getDelete($id){

        $language = Language::findOrFail($id);
        $language->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/language?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/language')->with('errors', 'Запись успешна удалена');
        }
    }

}