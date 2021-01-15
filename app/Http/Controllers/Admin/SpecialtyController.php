<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;

use App\Models\Degree;
use App\Models\Direction;
use App\Models\Specialty;
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use Illuminate\Support\Facades\Input;

class SpecialtyController
{
    public function index(){

        $data = [];
        $data['sphere'] = Sphere::pluck('name_ru', 'id')->all();
        $specialties = Specialty::orderBy('id', 'desc');

        if(count($_GET) > 0)
            $specialties = Specialty::filter($specialties, $_GET);

        $data['specialties'] = $specialties->paginate(20);
        $data['count'] = $data['specialties']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.specialty.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['directions'] = Direction::pluck('name_ru', 'id')->all();
        $data['subdirections'] = Subdirection::pluck('name_ru', 'id')->all();
        $data['subjects'] = Subject::pluck('name_ru', 'id')->all();
        $data['degrees'] = Degree::pluck('name_ru', 'id')->all();
        $data['sphere'] = Sphere::pluck('name_ru', 'id')->all();
        $data['specialty'] = null;
        if(!is_null($id)){
            $data['specialty'] = Specialty::findOrFail($id);
        }
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.specialty.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if ($data['cipher'] == null AND strlen($data['cipher']) <= 1) {
            $data['cipher'] = 'none';
        }
        if(is_null($id)){
            Specialty::create($data);
        } else{
            Specialty::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/specialty?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/specialty')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['specialty'] = Specialty::findOrFail($id);

        return view('admin.specialty.view', $data);
    }

    public function getDelete($id){

        $specialty = Specialty::findOrFail($id);
        $specialty->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/specialty?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/specialty')->with('errors', 'Запись успешна удалена');
        }
    }

}