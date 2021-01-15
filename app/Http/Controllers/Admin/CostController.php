<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\CostEducation;
use App\Models\Degree;
use App\Models\Language;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CostController
{
    public function index(){

        $data = [];
        $data['university'] = University::pluck('name_ru', 'id')->all();
        $data['degrees'] = Degree::pluck('name_ru', 'id')->all();
        $cost = CostEducation::select('cost_education.*')->orderBy('cost_education.id', 'desc');

        if (isset($_GET['degree_id']) OR isset($_GET['university_id'])) {
            $cost = CostEducation::select(DB::raw('cost_education.*, CAST(total AS int) AS total'));
            $cost->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
            if (isset($_GET['degree_id'])) {
                if ($_GET['degree_id'] != null) {
                    $cost->where('degree_id', $_GET['degree_id']);
                }
            }
            if (isset($_GET['university_id'])) {
                if ($_GET['university_id'] != null) {
                    $cost->where('university_id', $_GET['university_id']);
                }
            }
        }

        $data['cost'] = $cost->paginate(20);
        $data['count'] = $data['cost']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.cost.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['university'] = University::pluck('name_ru', 'id')->all();
        $data['specialties'] = Specialty::select(
            DB::raw("CONCAT(cipher, ' - ', name_ru, ' (', education_time, ')') AS name"),'id')
            ->pluck('name', 'id')->all();

//        print_r($data['specialties']);
//        die;
        $data['languages'] = Language::pluck('name_ru', 'id')->all();
        $data['cost'] = null;
        if(!is_null($id)){
            $data['cost'] = CostEducation::findOrFail($id);
         //   $data['cost']->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        //    print_r($data['cost']);
           // die;
        }
        return view('admin.cost.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(empty(['university_id']) || empty($data['specialty_id'])){
            return redirect()->back()->with('error', 'Специальность или университет не выбран');
        }
        if(is_null($id)){
            CostEducation::create($data);
        } else{
            CostEducation::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/cost?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/cost')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['cost'] = CostEducation::findOrFail($id);
        $data['university'] = University::findOrFail($data['cost']->university_id);
        $data['specialty'] = Specialty::findOrFail($data['cost']->specialty_id);
        $data['city'] = City::findOrFail($data['university']->city_id);
        return view('admin.cost.view', $data);
    }

    public function getDelete($id){

        $cost = CostEducation::findOrFail($id);
        $cost->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/cost?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/cost')->with('errors', 'Запись успешна удалена');
        }
    }

}