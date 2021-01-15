<?php

namespace App\Http\Controllers\Admin;

use App\Income;
use App\LearnProgramGroup;
use App\Models\CostEducation;
use App\Models\Specialty;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class QualificationsController extends Controller
{
    public function ajax(Request $request){
        if ($request->get('income') == 4){
            $prof = 'проф. дисциплина';
            $subjects = Subject::where('forCollege', 1)->get();
        }
        else {
            $prof = 'профильный предмет';
            $subjects = Subject::where('forCollege', 0)->get();
        }
        $specialty = $request->get('specialty');
        $result = view('admin.qualification.ajax', compact('prof', 'subjects', 'specialty'));
        return $result;
    }
    public function index($t, Request $request){

        if ($request->get('page')){
            $q = session()->get('q');
            $op = session()->get('op');
        }
        else {
            $q = $request->get('q');
            $op = $request->get('op');
        }
        session(['op' => $op, 'q' => $q]);

        $data = [];
        $specialties = Specialty::whereIn('learn_program_group_id', LearnProgramGroup::where('degree_id', $t)->pluck('id')->toArray());

        if ($q){
            $specialties = $specialties->where('qualification', 'LIKE', '%'.$q.'%');
        }
        if ($op){
            $specialties = $specialties->whereIn('learn_program_group_id', LearnProgramGroup::where('name_ru', 'LIKE', '%'.$op.'%')->pluck('id')->toArray());
        }

        $specialties->orderBy('id', 'desc');
        $data['specialties'] = $specialties->paginate(20);
        $data['count'] = $data['specialties']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.qualification.index', compact('t', 'q', 'op'), $data);
    }

    public function getAdd($t, $id = null){
        $data = [];
        $data['id'] = $id;
        $data['specialty'] = null;
        $data['subjects'] = Subject::all();
        $data['learn_program_groups'] = LearnProgramGroup::where('degree_id', $t)->pluck('name_ru', 'id')->all();
        if(!is_null($id)){
            $data['specialty'] = Specialty::findOrFail($id);
            if ($t == 1){
                if ($data['specialty']->relSubject->forCollege){
                    $prof = 'проф. дисциплина';
                }
                else {
                    $prof = 'профильный предмет';
                }
            }
        }
        return view('admin.qualification.add', compact('t', 'prof'), $data);
    }

    public function postAdd($t, $id = null){
        $data = Input::all();
        if(is_null($id)){
            Specialty::create($data);
        } else{
            Specialty::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/qualification/$t".'?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect((session()->get('q') || session()->get('op'))?"admin/qualification/$t?q=".session()->get('q')."&op=".session()->get('op'):"admin/qualification/$t")->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($t, $id){

        $data['specialty'] = Specialty::findOrFail($id);
        if ($t == 1){
            if ($data['specialty']->relSubject->forCollege){
                $prof = 'проф. дисциплина';
            }
            else {
                $prof = 'профильный предмет';
            }
        }
        return view('admin.qualification.view', compact('t', 'prof'), $data);
    }

    public function getDelete($t, $id){

        $specialty = Specialty::findOrFail($id);
        $costs = CostEducation::where('specialty_id', $specialty->id)->get();
        if (count($costs)>0){
            foreach ($costs as $cost){
                $cost->delete();
            }
        }
        $specialty->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/qualification/$t".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect((session()->get('q') || session()->get('op'))?"admin/qualification/$t?q=".session()->get('q')."&op=".session()->get('op'):"admin/qualification/$t")->with('errors', 'Запись успешна удалена');
        }
    }
}
