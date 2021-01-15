<?php

namespace App\Http\Controllers;

use App\LearnProgramGroup;
use App\Models\CostEducation;
use App\Models\ListUn;
use App\Models\Rating;
use App\Models\Subdirection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index()
    {
        $rating = Rating::all();
        return view('list.index')->with('rating', $rating)->with('map', 'Главная , Рейтинг');
    }

    public function getFmain ($degree_id = 0, $direction_id = 0, $city_id = 0, $query = null) {
        $s = CostEducation::select(DB::raw('cost_education.*'));
        $s->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        $s->join('universities', 'universities.id', '=', 'cost_education.university_id');
        $s->join('learn_program_groups', 'learn_program_groups.id', '=', 'specialties.learn_program_group_id');
        if ($degree_id != 0) {
            $ar['specialties'] = $s->whereIn('specialties.learn_program_group_id', LearnProgramGroup::where('degree_id', $degree_id)->pluck('id'));
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
        $ar['specialties'] = $s->paginate(10000);
        $ar['count'] = $ar['specialties']->total();

        return number_format($ar['count'], 0, "", " ");
    }
}
