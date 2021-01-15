<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 19:22
 */

namespace App\Http\Controllers;


use App\Income;
use App\LearnProgramGroup;
use App\Models\City;
use App\Models\CostEducation;
use App\Models\Degree;
use App\Models\Direction;
use App\Models\Specialty;
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use App\Models\Type;
use App\Models\University;
use App\Profile;
use App\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class AjaxController extends Controller
{
    public function resToSearch($lid, $uid, $sub1, $sub2){
        $lpg = LearnProgramGroup::find($lid);
        $r = new Request(['degree' => 1, 'sphere' => $lpg->relSubdirection->direction_id, 'direction' => $lpg->subdirection_id,
            'learnProgram' => null,
            'univer' => $uid, 'firstSubject' => $sub1, 'secondSubject' => $sub2, 'region' => University::find($uid)->region_id,
            'studyForm' => null, 'when' => 3, 'programGroup' => json_encode($lid), 'uniType' => null, 'startCost' => null,
            'endCost' => null, 'pagSelect' => null, 'sort' => null, 'sphereDirect' => null, 'pageBtn' => null]);

        return $this->doctorFilter(0, $r, null);
    }

    public function doctorFilter($page, Request $request, $query = null){
        $Test = false;
        if ($request->get('a')) {
            $Test = true;
            $a = json_decode($request->get('a'));
        }
        else {
            $a = (object)$request->all();
        }
        if ($a->degree){
            $degree = $a->degree;
        }
        else{
            $degree = 0;
        }
        $a->programGroup = array_map('intval', explode(',', substr($a->programGroup, 1, strlen($a->programGroup)-2)));
        $a->learnProgram = array_map('intval', explode(',', substr($a->learnProgram, 1, strlen($a->learnProgram)-2)));
        $costs = PagesController::mainFilter($degree, $a->studyForm, $a->region, $query);
        if ($a->when){
           $costs = $costs->whereIn('specialty_id', Specialty::where('income', $a->when)->pluck('id'))->values();
        }
        if ($a->sphere){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id',
                    LearnProgramGroup::whereIn('subdirection_id',
                        Subdirection::where('direction_id', $a->sphere)->pluck('id')->toArray()
                    )->pluck('id')->toArray()
                )->pluck('id')->toArray()
            )->values();
            $subDir = Subdirection::where('direction_id', $a->sphere)->get();
        }
        else {
            $subDir = Subdirection::all();
        }
        $dirs = Direction::orderBy('id', 'desc')->get();
        if ($a->direction){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id',
                    LearnProgramGroup::where('subdirection_id', $a->direction)->pluck('id')
                )->pluck('id')->toArray()
            )->values();
            $specs = LearnProgramGroup::where('subdirection_id', $a->direction);
            if ($degree)
                $specs = $specs->where('degree_id', $degree);
            $specs = $specs->get()->groupBy('name_ru')->toArray();
        }
        else if ($degree){
            $specs = LearnProgramGroup::where('degree_id', $degree)->get()->groupBy('name_ru')->toArray();
        }
        else {
            $specs = LearnProgramGroup::all()->groupBy('name_ru')->toArray();
        }
        $L = [];
        foreach ($specs as $spec){
            $Lname = $spec[0]['name_ru'];
            $LID = [];
            foreach ($spec as $s){
                array_push($LID, $s['id']);
            }
            $L[] = [$Lname, $LID];
        }
        $specs = $L;

        if (count($a->programGroup??[]) > 0 && $a->programGroup[0] != 0){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id', $a->programGroup)->pluck('id')
            )->values();
        }
        if (count($a->learnProgram??[]) > 0 && $a->learnProgram[0] != 0){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id', $a->learnProgram)->pluck('id')
            )->values();
        }
        if ($a->univer){
            $costs = $costs->where('university_id', $a->univer)->values();
            $cs = Region::where('id', University::find($a->univer)->region_id)->get();
        }
        else {
            $cs = Region::orderBy('priority', 'desc')->orderBy('name')->get();
        }
        if ($a->uniType){
            $costs = $costs->whereIn('university_id', University::where('type_id', $a->uniType)->pluck('id'))->values();
        }
        if ($a->startCost){
            $costs = $costs->where('price', '>=', $a->startCost)->values();
        }
        if ($a->endCost){
            $costs = $costs->where('price', '<=', $a->endCost)->values();
        }
        if ($a->pagSelect??''){
            $page = $a->pagSelect;
        }
        elseif ($a->pageBtn){
            $page = $a->pageBtn;
        }
        else {
            $page = 0;
        }
        if ($a->firstSubject){
            $costs = $costs->whereIn('specialty_id', Specialty::where('subject_id', $a->firstSubject)->orWhere('subject_id2', $a->firstSubject)->pluck('id'))->values();
        }
        if ($a->secondSubject){
            $costs = $costs->whereIn('specialty_id', Specialty::where('subject_id', $a->secondSubject)->orWhere('subject_id2', $a->secondSubject)->pluck('id'))->values();
        }
        if ($a->sphereDirect){
            $costs = $costs->whereIn('specialty_id', Specialty::where('sphere_id', $a->sphereDirect)->pluck('id'))->values();
        }
        if ($a->region){
            $us = University::where('region_id', $a->region)->get();
        }
        else {
            $us = University::all();
        }
        if ($degree == 4){
            $us = $us->where('hasCollege', 1)->values();
        }
        else {
            $us = $us->where('hasCollege', 0)->values();
        }
        if ($a->when){
            $forCollege = 1;
            if (mb_strtolower(Income::find($a->when)->name) == 'после школы'){
                $forCollege = 0;
            }
            $subs = Subject::where('forCollege', $forCollege)->get();
        }
        else {
            $subs = Subject::all();
        }
        $sp = Sphere::all();
        $ts = Type::all();
        switch ($a->sort){
            case 'popular':

                break;
            case 'asc':
                $costs = $costs->sortBy('price')->values();
                break;
            case 'desc':
                $costs = $costs->sortByDesc('price')->values();
                break;
        }
        if ($degree == 1) {
            $map = 'Бакалавриат';
            $active = 'university';
        }
        elseif ($degree == 2){
            $map = 'Магистратура';
            $active = 'university';
        }
        elseif($degree == 3) {
            $map = 'Докторантура';
            $active = 'university';
        }
        elseif($degree == 4) {
            $map = 'Колледжи';
            $active = 'college';
        }
        else {
            $map = 'ВУЗы';
            $active = 'university';
        }
        $city_id = $a->region;
        $studyForm = $a->studyForm;
        session(['a' => $a, 'query' => $query]);
        if ($Test){
            $result = [view('filter', compact('a', 'degree', 'dirs', 'subDir','specs', 'subs', 'sp',
                'cs', 'ts', 'us', 'costs', 'page', 'query', 'studyForm', 'city_id'))->render(), $map, $active];
            return $result;
        }
        else {
            return view('doctor', compact('a', 'degree', 'dirs', 'subDir','specs', 'subs', 'sp',
                'cs', 'ts', 'us', 'costs', 'page', 'query', 'studyForm', 'city_id', 'learnProgram'));
        }
    }

    public function getCity(){
        $data = Input::all();
        $cities = City::where('id', $data['city_id'])->where('active', 1)->pluck('name_ru', 'id')->all();
        $res = '';
        foreach($cities as $k => $v){
            $res .= '<option value="'.$k.'">'.$v.'</option>';
        }
        return json_encode($res);
    }
    public function getSubdirection(){
        $data = Input::all();
        if ($data['direction_id'] != 'any') {
            $directionId = Direction::where('url', $data['direction_id'])->pluck('id');
            $sdirections = Subdirection::where('direction_id', $directionId)->pluck('name_ru', 'url')->all();
            $res = '<option value="">Выберите</option>';
            foreach ($sdirections as $k => $v) {
                $res .= '<option value="' . $k . '">' . $v . '</option>';
            }
        } else {
            $res = 'any';
        }
        return json_encode($res);
    }
    public function getUn(){
        $data = Input::all();
        if ($data['city_id'] != 'any') {
            $cityId = City::where('url', $data['city_id'])->pluck('id');
            $un = $data = University::where('city_id', $cityId)->pluck('name_ru', 'id');
            $res = '<option value="">Выберите</option>';
            foreach ($un as $k => $v) {
                $res .= '<option value="' . $k . '">' . $v . '</option>';
            }
        } else {
            $un = $data = University::pluck('name_ru', 'id');
            $res = '<option value="">Выберите</option>';
            foreach ($un as $k => $v) {
                $res .= '<option value="' . $k . '">' . $v . '</option>';
            }
        }
        return json_encode($res);
    }
    public function getSpecialties(){
        $data = Input::all();
        if (!empty($data['subdirection_id']) AND $data['subdirection_id'] != 'any') {
            if ($data['degree_id'] != 'any') {
                $degreeId = Degree::where('url', $data['degree_id'])->pluck('id');
                $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
                $specialties = Specialty::select('name_ru', 'id', 'url')->where('subdirection_id', $subdirectionId)->where('degree_id', $degreeId)->get();
            } else {
                $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
                $specialties = Specialty::select('name_ru', 'id', 'url')->where('subdirection_id', $subdirectionId)->get();
            }

        } else {
            //$degreeId = Degree::where('url', $data['degree_id'])->pluck('id');
            //$specialties = Specialty::where('degree_id', $degreeId)->pluck('name_ru', 'id')->all();
            $specialties = null;
        }
        if ($specialties != null) {
            $mass = array();
            $res = '<option value="any">Выберите</option>';
            foreach ($specialties as $k => $v) {
                if (!in_array($v->name_ru, $mass)) {
                    $res .= '<option value="' . $v->url . '">' . $v->name_ru . '</option>';
                    $mass[] = $v->name_ru;
                }
            }
        } else {
            $res = 'any';
        }
        return json_encode($res);
    }
    public function getSpecialty(){
        $data = Input::all();
        
        $specialties = CostEducation::select(DB::raw('cost_education.*'));
        $specialties->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        $specialties->join('universities', 'universities.id', '=', 'cost_education.university_id');
        $specialties->join('cities', 'cities.id', '=', 'universities.city_id');
        $ar['type'] = !empty($data['type']) ? $data['type'] : '';

        if(empty($data['degree_id']) OR $data['degree_id'] == 'any'){
            $ar['degree_id'] = null;
        } else {
            $ar['degree_id'] = $data['degree_id'];
            $degreeId = Degree::where('url', $ar['degree_id'])->pluck('id');
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($degreeId) {
                $q->where('degree_id', $degreeId);
            });
        }

        if(!empty($data['direction_id']) AND $data['direction_id'] != 'any') {
            $directionId = Direction::where('url', $data['direction_id'])->pluck('id');
            $subdirectionIds = Subdirection::select('id')->where('direction_id', $directionId)->get()->toArray();
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subdirectionIds) {
                    $q->whereIn('subdirection_id', $subdirectionIds);
                });
        }


        if(!empty($data['subdirection_id']) AND $data['subdirection_id'] != 'any') {
            $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subdirectionId) {
                $q->where('subdirection_id', $subdirectionId);
            });
        }

        if(!empty($data['specialty_id']) AND $data['specialty_id'] != 'any')
            $specialties->where('specialties.url', $data['specialty_id']);

        if(!empty($data['subject_id'])) {
            $subjectId = $data['subject_id'];
            if(count($subjectId) == 1) {
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subjectId) {
                    $q->whereIn('subject_id', $subjectId);
                    $q->orWhereIn('subject_id2', $subjectId);
                });
            } else {
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subjectId) {
                    $q->whereIn('subject_id', $subjectId);
                    $q->whereIn('subject_id2', $subjectId);
                });
            }
        }

        if(count($data) > 1){
            if(!empty($data['search'])){
                $specialties = $specialties->where('specialties.name_ru', 'LIKE', '%'.$data['search'].'%');
            }
        }

        if(!empty($data['city_id']) AND $data['city_id'] != 'any') {
            $cityId = City::where('url', $data['city_id'])->pluck('id');
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($cityId) {
                $q->where('city_id', $cityId);
            });
        }

        if(!empty($data['un_id'])) {
            $un = $data['un_id'];
            $ar['un_id'] = $un;
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($un) {
                $q->where('id', $un);
            });
        }

        if(!empty($data['type_id'])) //ВУЗ
            $specialties->where('type_id', $data['type_id']);

        if(!empty($data['program_id'])) //Программа (ранее сфера называлась)
            $specialties->where('sphere_id', $data['program_id']);

        if(isset($data['sort']) && !empty($data['sort'])){
            if($data['sort'] == 'town')
                $specialties = $specialties->orderBy('cities.name_ru');
            elseif($data['sort'] == 'name')
                $specialties = $specialties->orderBy('specialties.name_ru');
            elseif($data['sort'] == 'cost')
                $specialties = $specialties->orderBy('cost_education.price');
        } else {
            $specialties = $specialties->orderBy('specialties.name_ru'); //По умолчанию сортировка по названию специальности
        }

        $ar['specialties'] = $specialties->paginate(10);
        $ar['count'] = $ar['specialties']->total();
        $ar['sort'] = $data['sort'];

        return view('paginate', $ar);
    }

    public function postUniversity()
    {
        $name = Input::get('name', '');
        if (isset($name)) {
            $university = University::where('name_ru', 'LIKE', '%' . $name . '%')->take(10)->select('name_ru', 'id')->get();
            if ($university) {
                $array = [];
                foreach ($university as $val) {
                    $array[] = [
                        'label' => $val->name_ru,
                        'value' => $val->id
                    ];
                }
                return $array;
            }
        }
        return false;
    }

}