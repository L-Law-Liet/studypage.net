<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CostEducation;
use App\Models\Degree;
use App\Models\Direction;
use App\Models\Requirement;
use App\Models\Specialty;
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use App\Models\Type;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PoiskController extends Controller
{
    public static function GetTransliterate($s) {
        $s = (string) $s;
        $s = strip_tags($s);
        $s = str_replace(array("\n", "\r"), " ", $s);
        $s = preg_replace("/\s+/", ' ', $s);
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
        $s = str_replace(" ", "-", $s);
        return $s;
    }
    public function index()
    {
        $d = Input::get('degree_id');
        if($d == 1){
            $red = 'doctor.under';
        }
        elseif ($d == 2){
            $red = 'doctor.magistracy';
        }
        elseif ($d == 3){
            $red = 'doctor.doctor';
        }
        elseif ($d == 4){
            $red = 'doctor.college';
        }
        else{
            $red = 'doctor.vuz';
        }
        return redirect()->route($red, ['page' => 0, 'degree' => $d, 'studyForm' => Input::get('direction_id'),
            'city_id' => Input::get('city_id'), 'search' => Input::get('search')]);
    }

    public function getView($id){

        $ar = [];
        $ar['specialty'] = CostEducation::findOrFail($id);
        $ar['requirement'] = Requirement::where('degree_id', $ar['specialty']->relSpecialty->degree_id)->first();

        return view('find.view', $ar);
    }
}
