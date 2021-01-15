<?php

namespace App\Http\Controllers\Admin;

use App\Models\CostEducation;
use App\Models\Specialty;
use App\Models\Subdirection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LearnProgramGroupsController extends Controller
{
    public function index($id, Request $request){

        if ($request->get('page')){
            $search = session()->get('search');
        }
        else {
            $search = $request->get('search');
        }
        session(['search' => $search]);

        $data = [];
        $data['degree_id'] = $id;
        $learn_program_groups = \App\LearnProgramGroup::where('degree_id', $id);

        if ($search){
            $learn_program_groups = $learn_program_groups->where('name_ru', 'LIKE', '%'.$search.'%');
        }
        $learn_program_groups = $learn_program_groups->orderBy('id', 'desc');
        $data['learn_program_groups'] = $learn_program_groups->paginate(20);
        $data['count'] = $data['learn_program_groups']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.learn-program-group.index', compact('search'), $data);
    }

    public function getAdd($d, $id = null){
        $data = [];
        $data['degree_id'] = $d;
        $data['id'] = $id;
        $data['learn_program_groups'] = null;
        $data['subdirections'] = Subdirection::pluck('name_ru', 'id')->all();
        if(!is_null($id)){
            $data['learn_program_groups'] = \App\LearnProgramGroup::findOrFail($id);
        }
        return view('admin.learn-program-group.add', $data);
    }

    public function postAdd($d, $id = null){
        $data = Input::all();
        if(is_null($id)){
            $data['degree_id'] = $d;
            \App\LearnProgramGroup::create($data);
        } else{
            \App\LearnProgramGroup::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/group/$d".'?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect((session()->get('search'))?"admin/group/$d?search=".session()->get('search'):"admin/group/$d")->with('success', 'Запись успешна сохранена');
        }
    }

    public function getDelete($d, $id){

        $subdirection = \App\LearnProgramGroup::findOrFail($id);
        $costs = CostEducation::whereIn('specialty_id', Specialty::where('learn_program_group_id', $subdirection->id)->pluck('id'))->get();
        if (count($costs)>0){
            foreach ($costs as $cost){
                $cost->delete();
            }
        }
        $subdirection->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/group/$d".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect((session()->get('search'))?"admin/group/$d?search=".session()->get('search'):"admin/group/$d")->with('errors', 'Запись успешна удалена');
        }
    }
}
