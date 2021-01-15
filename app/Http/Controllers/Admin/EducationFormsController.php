<?php

namespace App\Http\Controllers\Admin;

use App\EducationForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class EducationFormsController extends Controller
{
    public function index(){

        $data = [];
        $education_forms = EducationForm::all();
        $data['education_forms'] = EducationForm::paginate(20);
        $data['count'] = $data['education_forms']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.education_form.index', $data);
    }
    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['education_form'] = null;
        if(!is_null($id)){
            $data['education_form'] = EducationForm::findOrFail($id);
        }
        return view('admin.education_form.add', $data);
    }
    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            EducationForm::create($data);
        } else{
            EducationForm::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/education-form?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect("admin/education-form")->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDelete($id){

        $education_form = EducationForm::findOrFail($id);
        $education_form->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/education-form".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect("admin/education-form")->with('errors', 'Запись успешна удалена');
        }
    }
}
