<?php

namespace App\Http\Controllers\Admin;

use App\Models\Degree;
use App\Models\Requirement;
use Illuminate\Support\Facades\Input;

class RequirementController
{
    public function index(){

        $data = [];
        $requirements = Requirement::orderBy('id', 'desc');
        $data['requirements'] = $requirements->paginate(20);
        $data['count'] = $data['requirements']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.requirement.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['requirement'] = null;
        $data['degrees'] = Degree::pluck('name_ru', 'id')->all();
        if(!is_null($id)){
            $data['requirement'] = Requirement::findOrFail($id);
        }
        return view('admin.requirement.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Requirement::create($data);
        } else{
            Requirement::findOrFail($id)->update($data);
        }

        return \redirect('admin/requirement')->with('success', 'Запись успешна сохранена');
    }

    public function getView($id){

        $data['requirement'] = Requirement::findOrFail($id);
        return view('admin.requirement.view', $data);
    }

    public function getDelete($id){

        $requirement = Requirement::findOrFail($id);
        $requirement->delete();

        return \redirect('admin/requirement')->with('errors', 'Запись успешна удалена');
    }
}