<?php

namespace App\Http\Controllers\Admin;

use App\LearnProgramGroup;
use App\Models\CostEducation;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class QualificationsInController extends Controller
{
    public function index($t, Request $request){

        if ($request->get('page')){
            $q = session()->get('q');
            $op = session()->get('op');
            $n = session()->get('n');
        }
        else {
            $q = $request->get('q');
            $op = $request->get('op');
            $n = $request->get('n');
        }
        session(['op' => $op, 'q' => $q, 'n' => $n]);

        $data = [];
        $specialties = CostEducation::whereIn('specialty_id', Specialty::whereIn('learn_program_group_id', LearnProgramGroup::where('degree_id', $t)->pluck('id'))->where('qualification', '<>', null)->pluck('id'));

        if ($q){
            $specialties = $specialties->whereIn('specialty_id', Specialty::where('qualification', 'LIKE', '%'.$q.'%')->pluck('id'));
        }
        if ($op){
            $specialties = $specialties->whereIn('specialty_id', Specialty::whereIn('learn_program_group_id', LearnProgramGroup::where('name_ru', 'LIKE', '%'.$op.'%')->pluck('id'))->pluck('id'));
        }
        if ($n){
            $specialties = $specialties->whereIn('university_id', University::where('name_ru', 'LIKE', '%'.$n.'%')->pluck('id'));
        }

        $specialties->orderBy('id', 'desc');
        $data['specialties'] = $specialties->paginate(20);
        $data['count'] = $data['specialties']->total();

        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.qualification-in.index', compact('t', 'n', 'q', 'op'), $data);
    }

    public function getAdd($t, $id = null){
        $data = [];
        $data['id'] = $id;
        $data['cost_education'] = null;
        if ($t == 4){
            $data['universities'] = University::where('hasCollege', 1)->pluck('name_ru', 'id');
        }
        else {
            $data['universities'] = University::where('hasCollege', 0)->pluck('name_ru', 'id');
        }
        $data['qualifications'] = Specialty::whereIn('learn_program_group_id', LearnProgramGroup::where('degree_id', $t)->pluck('id'))->get();
        if(!is_null($id)){
            $data['cost_education'] = CostEducation::findOrFail($id);
        }
        return view('admin.qualification-in.add', compact('t'), $data);
    }

    public function postAdd($t, $id = null){
        $data = Input::all();
        if(is_null($id)){
            CostEducation::create($data);
        } else{
            CostEducation::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/qualification-in/$t".'?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect((session()->get('q') || session()->get('op') || session()->get('n'))?"admin/qualification-in/$t?q=".session()->get('q')."&op=".session()->get('op')."&n=".session()->get('n'):"admin/qualification-in/$t")->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($t, $id){

        $data['cost_education'] = CostEducation::findOrFail($id);
        return view('admin.qualification-in.view', compact('t'), $data);
    }

    public function getDelete($t, $id){

        $specialty = CostEducation::findOrFail($id);
        $specialty->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/qualification-in/$t".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect((session()->get('q') || session()->get('op') || session()->get('n'))?"admin/qualification-in/$t?q=".session()->get('q')."&op=".session()->get('op')."&n=".session()->get('n'):"admin/qualification-in/$t")->with('errors', 'Запись успешна удалена');
        }
    }
}
