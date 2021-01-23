<?php

namespace App\Http\Controllers;

use App\CalculatorCost;
use App\GrantsDiscounts;
use App\Income;
use App\LearnProgramGroup;
use App\Models\City;
use App\Models\CostEducation;
use App\Models\Direction;
use App\Models\Faq;
use App\Models\Parner;
use App\Models\Requirement;
use App\Models\Social;
use App\Models\Specialty;
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use App\Models\Type;
use App\Models\University;
use App\Models\User;
use App\Profile;
use App\ProfileUniversity;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\Object_;

class PagesController extends Controller
{
    public function showCabinet(){
        $cities = Region::all();
        return view('cabinet')->with('map', 'Главная , Личные данные')->with('cities', $cities);
    }

//    public function showCollege($pages = 0){
//        $specialities = Specialty::where('degree_id', 1)->get();
//        $specIDs = array_column($specialities->toArray(), 'id');
//        $costs = CostEducation::whereIn('specialty_id', $specIDs)->get();
//        return view('college')->with('costs', $costs)->with('page', $pages)->with('active', 'college')->with('map', 'Главная , Колледж');
//    }
    public function viewCollege($sid, $uid){
        $u = University::find($uid);
        $speciality = Specialty::find($sid);
        $ar['requirement'] = Requirement::where('degree_id', $speciality->lpg->relDegree->id)->first();
        $features = ['Степень обучения'];
        if ($speciality->lpg->degree_id == 1){
        if($speciality->lpg->subdirection_id){
                $features = array_merge($features, ['Поступление в ВУЗ', $speciality->relIncome->name, 'Профильный предмет', $speciality->relSubject->name_ru, $speciality->relSubject2->name_ru ]);
            }
            else if (is_null($speciality->lpg->subdirection_id)){
                $features = array_merge($features, ['Поступление в ВУЗ', $speciality->relIncome->name, 'Профессиональные дисциплины', $speciality->relSubject->name_ru, $speciality->relSubject2->name_ru ]);
            }
        }
        else if ($speciality->lpg->degree_id == 2){
            $ar['requirement'] = Requirement::where('degree_id', 2)->first();
            $features = array_merge($features, ['Сфера направления', $speciality->relSphere->name_ru]);
        }
        else if ($speciality->lpg->degree_id == 3){
            $ar['requirement'] = Requirement::where('degree_id', 3)->first();
            $features = array_merge($features, ['Сфера направления', $speciality->relSphere->name_ru ]);
        }
        else if ($speciality->lpg->degree_id == 4) {
            $features = array_merge($features, ['Поступление в колледж', $speciality->relIncome->name]);
            $hrefTitle = 'college';
        }
        if ($speciality->lpg->degree_id != 4){
            $hrefTitle = 'univer';
        }
        return view('view-college')->with('s', $speciality)->with('u', $u)->with('requirement', $ar['requirement'])->with('f', $features)->with('href', $hrefTitle);
    }
    public function viewUniver($id){
//        $u = University::find($id);

        $ar['requirement'] = Requirement::where('degree_id', 1)->first();
        return view('view-univer')->with('requirement', $ar['requirement'])/*->with('college', $u)*/;
    }
    public function showUniversityAfterSchool($pages = 0){
        $specialities = Specialty::where('degree_id', 1)->get();
        $specIDs = array_column($specialities->toArray(), 'id');
        $costs = CostEducation::whereIn('specialty_id', $specIDs)->get();

        return view('university-school')->with('costs', $costs)->with('page', $pages)->with('active', 'university')->with('map', 'Главная , ВУЗ');
    }
    public function showUniversityAfterCollege($pages, Request $request){
        $city_id = 0;
        $direction_id = 0;
        $query = null;
        if ($request->get('direction_id')){
            $direction_id = $request->get('direction_id');
        }
        if ($request->get('city_id')){
            $city_id = $request->get('city_id');
        }
        if ($request->get('search')){
            $query = $request->get('search');
        }

        $specialities = PagesController::mainFilter(1, $direction_id, $city_id, $query);
        return view('university-college')->with('costs', $specialities)->with('page', $pages)->with('active', 'university')->with('query', $query)->with('dir_id', $request->get('direction_id'))->with('city_id', $request->get('city_id'))->with('map', 'Главная , Бакалавриат');
    }
public static function mainFilter($degree, $direction_id, $city_id, $query){
    $s = CostEducation::select(DB::raw('cost_education.*'));
    $s->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
    $s->join('universities', 'universities.id', '=', 'cost_education.university_id');
    if ($degree != 0) {
        $ar['specialties'] = $s->whereIn('specialties.learn_program_group_id', LearnProgramGroup::where('degree_id', $degree)->pluck('id'));
    }
    else {
        $ar['specialties'] = $s->whereIn('specialties.learn_program_group_id', LearnProgramGroup::where('degree_id', '<>', 4)->pluck('id'));
    }
    if ($city_id != 0) {
        $ar['specialties'] = $s->where('region_id', $city_id);
    }
    if ($query != null AND strlen($query) >= 1 AND $query != 'none') {
        $ar['specialties'] = $s->where('specialties.name_ru', 'LIKE', '%'.$query.'%');
    }
    if ($direction_id != 0) {
        $s = $s->where('education_form', $direction_id);
    }
    $S = $s->get();
    return $S;
}
    public function showDoctor(Request $request){
        $url = session()->get('_previous')['url'];
        $url = substr($url, 0, strpos($url, '?'));

        $sa = (object) array('sphere' => null, 'degree' => $request->get('degree'), 'region' => $request->get('city_id')??null, 'studyForm' => $request->get('studyForm')??null,
            'direction' => null, 'programGroup' => [],
            'when' => null, 'startCost' => null, 'endCost' => null, 'firstSubject' => null,
            'secondSubject' => null, 'sphereDirect' => null, 'univer' => null, 'uniType' => null,
            'sort' => null, 'pageBtn' => null, 'learnProgram' => []);

        if (session()->get('a') && ($url == url()->current() || session()->get('view_name') == 'view-college') ){
            $sa = session()->get('a');
        }
        if ($request->get('studyForm')){
            $studyForm = $request->get('studyForm');
        }
        if ($request->get('city_id')){
            $city_id = $request->get('city_id');
        }
        if ($request->get('search')){
            $query = $request->get('search');
        }
            $degree = $sa->degree;
        if ($sa->region){
            $city_id = $sa->region;
        }
        else{
            $city_id = 0;
        }
        if ($sa->studyForm){
            $studyForm = $sa->studyForm;
        }
        else{
            $studyForm = 0;
        }
        if(is_string($sa->programGroup))
            $sa->programGroup = array_map('intval', explode(',', substr($sa->programGroup??'', 1, strlen($sa->programGroup??'')-2)));
        if (is_string($sa->learnProgram))
            $sa->learnProgram = array_map('intval', explode(',', substr($sa->learnProgram??'', 1, strlen($sa->learnProgram??'')-2)));
        if(session()->get('query')){
            $query = session()->get('query');
        }
        else{
            $query = null;
        }
    //        dd($sa);
        $costs = PagesController::mainFilter($degree, $studyForm, $city_id, $query);


        if ($sa->when){
            $costs = $costs->whereIn('specialty_id', Specialty::where('income', $sa->when)->pluck('id'))->values();
        }
        if ($sa->sphere){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id',
                    LearnProgramGroup::whereIn('subdirection_id',
                        Subdirection::where('direction_id', $sa->sphere)->pluck('id')->toArray()
                    )->pluck('id')->toArray()
                )->pluck('id')->toArray()
            )->values();
            $subDir = Subdirection::where('direction_id', $sa->sphere)->get();
        }
        else {
            $subDir = Subdirection::all();
        }
        $dirs = Direction::orderBy('id', 'desc')->get();
        if ($sa->direction){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id',
                    LearnProgramGroup::where('subdirection_id', $sa->direction)->pluck('id')
                )->pluck('id')->toArray()
            )->values();
            $specs = LearnProgramGroup::where('subdirection_id', $sa->direction);
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

        if (count($sa->programGroup??[]) > 0 && $sa->programGroup[0] != 0){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id', $sa->programGroup??[])->pluck('id')
            )->values();
        }
        if (count($sa->learnProgram??[]) > 0 && $sa->learnProgram[0] != 0){
            $costs = $costs->whereIn('specialty_id',
                Specialty::whereIn('learn_program_group_id', $sa->learnProgram??[])->pluck('id')
            )->values();
        }
        if ($sa->univer){
            $costs = $costs->where('university_id', $sa->univer)->values();
            $cs = Region::where('id', University::find($sa->univer)->region_id)->get();
        }
        else {
            $cs = Region::orderBy('priority', 'desc')->orderBy('name')->get();
        }
        if ($sa->uniType){
            $costs = $costs->whereIn('university_id', University::where('type_id', $sa->uniType)->pluck('id'))->values();
        }
        if ($sa->startCost){
            $costs = $costs->where('price', '>=', $sa->startCost)->values();
        }
        if ($sa->endCost){
            $costs = $costs->where('price', '<=', $sa->endCost)->values();
        }
        if ($sa->pagSelect??''){
            $page = $sa->pagSelect;
        }
        elseif ($sa->pageBtn){
            $page = $sa->pageBtn;
        }
        else {
            $page = $request->get('page');
        }
        if ($sa->firstSubject){
            $costs = $costs->whereIn('specialty_id', Specialty::where('subject_id', $sa->firstSubject)->orWhere('subject_id2', $sa->firstSubject)->pluck('id'))->values();
        }
        if ($sa->secondSubject){
            $costs = $costs->whereIn('specialty_id', Specialty::where('subject_id', $sa->secondSubject)->orWhere('subject_id2', $sa->secondSubject)->pluck('id'))->values();
        }
        if ($sa->sphereDirect){
            $costs = $costs->whereIn('specialty_id', Specialty::where('sphere_id', $sa->sphereDirect)->pluck('id'))->values();
        }
        if ($sa->region){
            $us = University::where('region_id', $sa->region)->get();
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
        if ($sa->when){
            $forCollege = 1;
            if (mb_strtolower(Income::find($sa->when)->name) == 'после школы'){
                $forCollege = 0;
            }
            $subs = Subject::where('forCollege', $forCollege)->get();
//            dd([$forCollege, $subs]);
        }
        else {
            $subs = Subject::all();
        }
        $sp = Sphere::all();
        $ts = Type::all();
        switch ($sa->sort){
            case 'popular':

                break;
            case 'asc':
                $costs = $costs->sortBy('price')->values();
                break;
            case 'desc':
                $costs = $costs->sortByDesc('price')->values();
                break;
        }

//        $directions = Direction::orderBy('id', 'desc')->get();
//        $subDir = Subdirection::all();
//        $subs = [];
//        $sp = Sphere::all();
//        $cs = Region::orderBy('priority', 'desc')->orderBy('name')->get();
//        $ts = Type::all();

        $active = 'vuz';
        if ($degree == 1) {
            $map = 'Главная , Бакалавриат';
        }
        elseif ($degree == 2){
            $map = 'Главная , Магистратура';
        }
        elseif($degree == 3) {
            $map = 'Главная , Докторантура';
        }
        elseif($degree == 4) {
            $map = 'Главная , Колледжи';
            $active = 'college';
        }
        else {
            $map = 'Главная , ВУЗы';
        }
//        if (session()->get('a') && ($url == url()->current() || session()->get('view_name') == 'view-college')){
//            $a = $sa;
//        }
//        else {
//            $a =
//        }
        return view('doctor', compact('active', 'subDir', 'city_id'), ['dirs' => $dirs, 'subs' => $subs,
            'sp' => $sp, 'us' => $us, 'specs' => $specs, 'ts' => $ts, 'cs' => $cs])->with('costs', $costs)
            ->with('page', $page)->with('degree', $degree)->with('query', $query)->with('studyForm', $studyForm)
            ->with('map', $map)->with('a', $sa);
    }


    public function showFAQ($id = 1){
        $faq = Faq::find($id);
        $navActive = true;
        return view('faq.select-prof', compact('faq', 'navActive'))->with('map', 'Главная , Навигатор , '.$faq->question);
    }

    public function collegeList(Request $request){
        $r = null;
//        dd($request->all());
        $universities = University::where('hasCollege', 1);
        $region_ids = University::where('hasCollege', 1)->groupBy('region_id')->pluck('region_id');
        if($request->region){
            $universities = $universities->where('region_id', $request->region)->get();
            $r = $request->region;
        }
        else{
            $universities = $universities->get();
        }
        $regions = Region::whereIn('id', $region_ids)->get();
        return view('college-list', compact('regions', 'r'))->with('universities', $universities)->with('map', 'Главная , Навигатор , Список колледжей')->with('navActive', 1);
    }
    public function univerList(Request $request){
        $r = null;
        $universities = University::where('hasCollege', 0);
        $region_ids = University::where('hasCollege', 1)->groupBy('region_id')->pluck('region_id');
        if($request->region){
            $universities = $universities->where('region_id', $request->region)->get();
            $r = $request->region;
        }
        else{
            $universities = $universities->get();
        }
        $regions = Region::whereIn('id', $region_ids)->get();
        return view('college-list', compact('regions', 'r'))->with('universities', $universities)->with('map', 'Главная , Навигатор , Список ВУЗов')->with('navActive', 1);
    }
    public function partnerList(){
        $partners = Parner::all();
        return view('partner-list')->with('partners', $partners)->with('map', 'Главная , Навигатор , Партнеры')->with('navActive', 1);
    }
    public function entCalculator($error = null){
        if (!session()->get('refreshed')){
            session(['refreshed' => url()->previous()]);
        }
        if (strstr(session()->get('refreshed'), '?', TRUE) == strstr(url()->previous(), '?', TRUE)){
            $error = null;
        }
        return view('ent-calculator', ['ss' => Subject::where('forCollege', 0)->get()])->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ')->with('error', $error);
    }
    public function entResult(Request $request){
        $check = 0;
        if (!$request->get('access')){
            session()->forget('access');
            return redirect()->route('calculator-ent');
        }
        if (Auth::check()) {
//                if (Auth::user()->bill < CalculatorCost::all('calc_price')->first()->calc_price) {
//                    return redirect()->route('calculator-ent')->with('m', 'Недостаточно средств!')->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ');
//                }
//                else {
//                    $user = User::find(Auth::id());
//                    $user->bill -= CalculatorCost::all('calc_price')->first()->calc_price;
//                    Auth::user()->bill = $user->bill;
//                    $user->save();
//                }
                $L = $request->input('1profPoint') + $request->input('2profPoint') +
                    $request->input('matGr') + $request->input('readGr') + $request->input('historyKZ');
                $arrProf = [$request->input('1profSelect'), $request->input('2profSelect')];
                return redirect()->route('ent-show', ['score' => encrypt($L), 'profs1' => $arrProf[0], 'profs2' => $arrProf[1], 'lang' => $request->input('lang'), 'map' => 'Главная , Калькулятор ЕНТ , Результаты']);
        }
        else {
            return redirect()->route('calculator-ent')->with('m1', 'Данная услуга доступна в личном кабинете')->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ');
        }
    }
    public function showENTResult($L, $profs1, $profs2, $lang, $map){
        $L = decrypt($L);
        $arrProf = [$profs1, $profs2];
        // ->where('cost.'.($lang == 1)?'passing_score_kz':'passing_score_ru', '<>', null)

            $specs = CostEducation::with(['relSpecialty' => function($q) use ($arrProf){
                $q->whereIn('subject_id', Subject::where('forCollege', 0)
                    ->whereIn('id', $arrProf)->pluck('id'))
                    ->whereIn('subject_id2', Subject::where('forCollege', 0)
                        ->whereIn('id', $arrProf)->pluck('id'));
            }])->whereIn('language', [$lang, 3])->get();

        $sHigh = [];
        $sMiddle = [];
        $sLow = [];
        $sPaid = [];
        foreach ($specs as $s) {
            if ($s->language && $s->relSpecialty) {
                if ($lang == 1) {
                    if ($L >= $s->passing_score_kz && $s->passing_score_kz != 0) {
                        $sHigh[] = $s;
                    } elseif (($L >= $s->passing_score_kz - 5) && $s->passing_score_kz ) {
                        $sMiddle[] = $s;
                    } elseif (($L >= $s->passing_score_kz - 13) && $s->passing_score_kz > 0) {
                        $sLow[] = $s;
                    } elseif ($L >= $s->paid_score) {
                        $sPaid[] = $s;
                    }
                } else {
                    if (($L >= $s->passing_score_ru) && $s->passing_score_kz != 0) {
                        $sHigh[] = $s;
                    } elseif (($L >= $s->passing_score_ru - 5) && $s->passing_score_kz != 0) {
                        $sMiddle[] = $s;
                    } elseif (($L >= $s->passing_score_ru - 13) && $s->passing_score_kz != 0) {
                        $sLow[] = $s;
                    } elseif ($L >= $s->paid_score) {
                        $sPaid[] = $s;
                    }
                }
            }
        }
        $sHigh = collect($sHigh);
        $sMiddle = collect($sMiddle);
        $sLow = collect($sLow);
        if ($lang == 1){
            $sHigh = $sHigh->sortByDesc('passing_score_kz')->values();
            $sMiddle = $sMiddle->sortByDesc('passing_score_kz')->values();
            $sLow = $sLow->sortByDesc('passing_score_kz')->values();
        }
        else {
            $sHigh = $sHigh->sortByDesc('passing_score_ru')->values();
            $sMiddle = $sMiddle->sortByDesc('passing_score_ru')->values();
            $sLow = $sLow->sortByDesc('passing_score_ru')->values();
        }
//        dd($sLow[3]->cost);
        $sPaid = collect($sPaid);
        $sPaid = $sPaid->sortByDesc('paid_score')->values();
        $sRes = [$sHigh, $sMiddle, $sLow, $sPaid];
        return view('ent-result', ['sRes' => $sRes, 'score' => $L, 'profs' =>$arrProf, 'lang' => $lang, 'map' => $map]);
    }
    public function entResult2($type, $entScore, $profs1, $profs2, $lang, $page = 0){
        $array = [];
        $title = '';
        $n = 0;
        $entScore = decrypt($entScore);
        $arrProf = [$profs1, $profs2];
        $specs = CostEducation::with(['relSpecialty' => function($q) use ($arrProf){
            $q->whereIn('subject_id', Subject::where('forCollege', 0)
                ->whereIn('id', $arrProf)->pluck('id'))
                ->whereIn('subject_id2', Subject::where('forCollege', 0)
                    ->whereIn('id', $arrProf)->pluck('id'));
        }])->whereIn('language', [$lang, 3])->get();

        if($lang == 1){
            switch ($type){
                case 1:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->passing_score_kz) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на грант - Высокий ('.$n.')';
                    break;
                case 2:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->passing_score_kz - 5 && $entScore < $spec->passing_score_kz) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на грант - Средний ('.$n.')';
                    break;
                case 3:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->passing_score_kz - 13 && $entScore < $spec->passing_score_kz -5) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на грант - Низкий ('.$n.')';
                    break;
                case 4:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->paid_score && $entScore < $spec->passing_score_kz-13) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на платное ('.$n.')';
                    break;
                default:
                    return redirect()->action('IndexController@index');
            }
        }
        else{
            switch ($type){
                case 1:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->passing_score_ru) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на грант - Высокий ('.$n.')';
                    break;
                case 2:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->passing_score_ru - 5 && $entScore < $spec->passing_score_ru) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на грант - Средний ('.$n.')';
                    break;
                case 3:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->passing_score_ru - 13 && $entScore < $spec->passing_score_ru -5) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на грант - Низкий ('.$n.')';
                    break;
                case 4:
                    foreach ($specs as $spec){
                        if ($spec->language && $spec->relSpecialty) {
                            if ($entScore >= $spec->paid_score && $entScore < $spec->passing_score_ru-13) {
                                $array[] = $spec;
                                $n++;
                            }
                        }
                    }
                    $title = 'Шансы поступить на платное ('.$n.')';
                    break;
                default:
                    return redirect()->action('IndexController@index');
            }
        }
        $array = collect($array);
        if ($lang == 1){
            if ($type == 4){
                $array = $array->sortByDesc('paid_score')->values();
            }
            else{
                $array = $array->sortByDesc('passing_score_kz')->values();
            }
        }
        else {
            if ($type == 4){
                $array = $array->sortByDesc('paid_score')->values();
            }
            else{
                $array = $array->sortByDesc('passing_score_ru')->values();
            }
        }
        return view('ent-result2', compact('page', 'type', 'profs1', 'profs2'), ['score' => $entScore, 'title' => $title, 'lang' => $lang])->with('map', 'Главная , Калькулятор ЕНТ , Результаты , '.$title)->with('array', $array);
    }
    public  function multiRating($type, $id = -1){
        if ($id == -1){
            $id = Profile::where('forCollege', 2-$type)->first()->id;
        }
        $class = $type;
        if ($type == 2){
            $map = 'Главная , Рейтинг , Рейтинг ВУЗов';
            $ratingName = 'Рейтинг ВУЗов - '.Social::find(10)->link;
            if ($id){
                $map .= ' , '.Profile::find($id)->name;
                $us = University::join('profile_university', 'profile_university.university_id', '=', 'universities.id')->where('profile_university.profile_id', $id)->orderByDesc('profile_university.rating')->get();
                $class .= $id;
            }
        }
        elseif($type == 1) {
            $map = 'Главная , Рейтинг , Рейтинг колледжей';
            $ratingName = 'Рейтинг колледжей - '.Social::find(9)->link;
            if ($id){
                $map .= ' , '.Profile::find($id)->name;
                $us = University::join('profile_university', 'profile_university.university_id', '=', 'universities.id')->where('profile_university.profile_id', $id)->orderByDesc('profile_university.rating')->get();
                $class .= $id;
            }
        }
       return view('rating.multiprofile-rating', compact('type', 'ratingName'))->with('map', $map)->with('class', $class)->with('us', $us)->with('active', 'rating');
    }
    public function attributesCollegeFromList($name, $id, $nav = 0){
        $university = University::find($id);
        if ($name == 'college'){
            $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru;
        }
        else {
            $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru;
        }
        switch ($nav){
            case 1:
                $header = 'ДОСТИЖЕНИЯ';
                $data = $university->achievements;
                $class = 'achieve';
                $map .= ' , Достижения';
                break;
            case 2:
                $header = 'СОТРУДНИЧЕСТВО';
                $data = $university->coop;
                $class = 'coop';
                $map .= ' , Сотрудничество';
                break;
            case 3:
                $header = 'РЕЙТИНГ';
                $data = $university->rating;
                $class = 'rating';
                $map .= ' , Рейтинг';
                break;
            case 6:
                $header = 'ДОКУМЕНТЫ ДЛЯ ПОСТУПЛЕНИЯ';
                $data = $university->docs_income;
                $class = 'docs';
                $map .= ' , Документы для поступления';
                break;
            case 4:
                $header = 'ГРАНТЫ И СКИДКИ';
                $data = $university->grants;
                $class = 'discounts';
                $map .= ' , Гранты/Скидки';
                break;
            case 5:
                $header = 'ОБРАЗОВАТЕЛЬНЫЕ ПРОГРАММЫ';
                $data = $university->learn_program;
                $class = 'edu';
                $map .= ' , Образовательные программы';
                break;
            case 7:
                $header = 'КОНТАКТЫ';
                $data = $university->short_description;
                $class = 'contacts';
                $map .= ' , Контакты';
                break;
            default:
                $university = University::find($id);
                if ($name == 'college'){
                    $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru.' , О колледже';
                }
                else {
                    $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru.' , О ВУЗе';
                }
                $partners = Parner::all();
                return view('college.college-view', compact('map', 'partners'))->with('university', $university)->with('class', 'view')->with('name', $name);
        }
        return view('college.college-attributes', compact('map', 'class', 'header', 'data', 'id'))->with('university', $university)->with('name', $name);
    }
    public function showRegistrationForm(){
        $cs = City::all();
        return view('registration')->with('map', 'Главная , Регистрация')->with('cs', $cs);
    }
    public function changePassword(){
        if (session()->get('err')){
            $e = session()->get('err');
            session()->forget('err');
        }
        else {
            $e = null;
        }
        return view('change-password', compact('e'))->with('map', 'Главная , Сменить пароль');
    }
    public function showCallback(){
        return view('callback')->with('map', 'Главная , Обратная связь');
    }
    public function  showForgotPasswd(){;
        return view('forgot-passwd')->with('map', 'Главная , Забыли пароль');
    }
    public function successPayment($m, $sum){
        $user = User::find(Auth::id());
        $user->bill += $sum;
        $user->save();
        return redirect()->route('show-payment', $m);
    }
    public function failPayment($m){
        return redirect()->route('show-payment', $m);
    }
    public function showPayment($m){
        return redirect('/?message='.$m);
    }
}
