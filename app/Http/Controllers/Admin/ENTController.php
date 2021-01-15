<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LearnProgramGroup;
use App\Models\CostEducation;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ENTController extends Controller
{
    public function index(Request $request){

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
        $education_forms = CostEducation::where('language', '<>', null);

        if ($q){
            $education_forms = $education_forms->whereIn('specialty_id', Specialty::where('qualification', 'LIKE', '%'.$q.'%')->pluck('id'));
        }
        if ($op){
            $education_forms = $education_forms->whereIn('specialty_id', Specialty::whereIn('learn_program_group_id', LearnProgramGroup::where('name_ru', 'LIKE', '%'.$op.'%')->pluck('id'))->pluck('id'));
        }
        if ($n){
            $education_forms = $education_forms->whereIn('university_id', University::where('name_ru', 'LIKE', '%'.$n.'%')->pluck('id'));
        }

        $education_forms->orderBy('id', 'desc');
        $data['education_forms'] = $education_forms->paginate(20);
        $data['count'] = $data['education_forms']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.ent.index', compact('q', 'n', 'op'), $data);
    }
    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['education_form'] = null;
        if(!is_null($id)){
            $data['education_form'] = CostEducation::findOrFail($id);
        }

        return view('admin.ent.add', compact('us'), $data);
    }
    public function postAdd($id = null){
        $data = Input::all();
            $c = CostEducation::findOrFail($id??$data['id']);
            $c->language = 0;
            $c->paid_score = $data['paid_score'];
            if ($data['passing_score_kz']){
                $c->passing_score_kz = $data['passing_score_kz'];
                $c->language += 1;
            }
            else{
                $c->passing_score_kz = null;
            }
            if($data['passing_score_ru']) {
                $c->passing_score_ru = $data['passing_score_ru'];
                $c->language += 2;
            }
            else{
                $c->passing_score_ru = null;
            }
            $c->save();
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/calculator-ent?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect((session()->get('q') || session()->get('op') || session()->get('n'))?"admin/calculator-ent?q=".session()->get('q')."&op=".session()->get('op')."&n=".session()->get('n'):"admin/calculator-ent")->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDelete($id){

        $c = CostEducation::findOrFail($id);
        $c->language = null;
        $c->passing_score_kz = null;
        $c->passing_score_ru = null;
        $c->save();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/calculator-ent".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect((session()->get('q') || session()->get('op') || session()->get('n'))?"admin/calculator-ent?q=".session()->get('q')."&op=".session()->get('op')."&n=".session()->get('n'):"admin/calculator-ent")->with('errors', 'Запись успешна удалена');
        }
    }

    // AJAX
    public function entSelect(Request $request){
        $search = '%'.$request->search.'%';
        if ($search == ''){
            $us = DB::select("select c.id, concat(u.name_ru, ' - ',
 lpg.name_ru, ' - ', s.qualification) as text from cost_education c 
 join specialties s on c.specialty_id = s.id 
 join learn_program_groups lpg on s.learn_program_group_id = lpg.id 
 join universities u on c.university_id = u.id where c.language is null and lpg.degree_id = 1");
        }
        else{
            $us = DB::select("select c.id, concat(u.name_ru, ' - ',
 lpg.name_ru, ' - ', s.qualification) as text from cost_education c 
 join specialties s on c.specialty_id = s.id 
 join learn_program_groups lpg on s.learn_program_group_id = lpg.id 
 join universities u on c.university_id = u.id where c.language is null and lpg.degree_id = 1 and
  (concat(u.name_ru, ' - ', lpg.name_ru, ' - ', s.qualification) like :searchName)", ['searchName' => $search]);
        }

        return response()->json($us);

    }
}