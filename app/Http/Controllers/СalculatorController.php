<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Specialty;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class СalculatorController extends Controller
{
    public function index()
    {
        $data['languages'] = Language::where('id', '<>', 3)->pluck('name_ru', 'id')->all();
        $data['subjects'] = Subject::pluck('name_ru', 'id')->all();

        return view('calculator.index', $data);
    }

    public function postResult(){

        $data = Input::all();
         $specilaties = Specialty::select(DB::raw('cost_education.id, specialties.cipher, specialties.name_ru, cost_education.passing_score, cost_education.passing_score_ru, cost_education.passing_score_kz, universities.name_ru AS university'))
            ->join('cost_education', 'cost_education.specialty_id', '=', 'specialties.id')
            ->join('universities', 'universities.id', '=', 'cost_education.university_id')
            ->where('degree_id', 1) //только Бакалавриат
            ->where(['subject_id' => $data['subject_id'], 'subject_id2' => $data['subject_id2']])
            ->where('cost_education.language_id', 3); //всегда из обоих языков
        if($data['language_id'] == 1){//kz
            $specilaties->whereNotNull('cost_education.passing_score_kz');
        }
        if($data['language_id'] == 2){//ru
            $specilaties->whereNotNull('cost_education.passing_score_ru');
        }
        $data['specilaties'] = $specilaties->get();
        $data['sum'] = $data['math'] + $data['literacy'] + $data['history'] + $data['subject_1_ball'] + $data['subject_2_ball'];
        //dd($data['specilaties']);
        return view('calculator.view', $data);
    }

}
