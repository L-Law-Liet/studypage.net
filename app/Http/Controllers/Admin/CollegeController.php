<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;

use App\Models\University;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;

class CollegeController
{
    public function index(Request $request){

        if ($request->get('page')){
            $n = session()->get('n');
        }
        else {
            $n = $request->get('n');
        }
        session(['n' => $n]);

        $data = [];
        $universities = University::where('hasCollege', 1);
        if ($n){
            $universities = $universities->where('name_ru', 'LIKE', '%'.$n.'%');
        }

        $universities->orderBy('id', 'desc');
        $data['universities'] = $universities->paginate(20);
        $data['count'] = $data['universities']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }

        return view('admin.university.index', compact('n'), $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['cities'] = Region::pluck('name', 'id')->all();
        $data['university'] = null;
        if(!is_null($id)){
            $data['university'] = University::findOrFail($id);
        }
        return view('admin.university.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
        $data['type_id'] = null;
        if(is_null($id)){
            $data['hasCollege'] = 1;
            University::create($data);
        } else{
            University::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/college?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect((session()->get('n'))?'admin/college?n='.session()->get('n'):'admin/college')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['university'] = University::findOrFail($id);
        $data['city'] = Region::findOrFail($data['university']->region_id);
        return view('admin.university.view', $data);
    }

    public function getDelete($id){

        $university = University::findOrFail($id);
        $university->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/college?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect((session()->get('n'))?'admin/college?n='.session()->get('n'):'admin/college')->with('errors', 'Запись успешна удалена');
        }
    }
    public function list(Request $request){

        if ($request->get('page')){
            $n = session()->get('n');
        }
        else {
            $n = $request->get('n');
        }
        session(['n' => $n]);

        $data = [];
        $universities = University::where('hasCollege', 1)->where('description', '<>', null);

        if ($n){
            $universities = $universities->where('name_ru', 'LIKE', '%'.$n.'%');
        }

        $universities->orderBy('id', 'desc');
        $data['universities'] = $universities->paginate(20);
        $data['count'] = $data['universities']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.list.index', compact('n'), $data);
    }
    public function getPageView($id){
        $university = University::find($id);
        return view('admin.list.view', compact('university'));
    }

    public function getPageAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['university'] = null;
        if(!is_null($id)){
            $data['university'] = University::findOrFail($id);
        }
        return view('admin.list.add', $data);
    }

    public function postPageAdd($id = null){
        $data = Input::all();
        $data['image'] = null;
        $data['user_id'] = Auth::user()->id;
        $u = University::findOrFail($id??$data['id']);
        $u->description = $data['description'];
        $u->short_description = $data['short_description'];
        $u->achievements = $data['achievements'];
        $u->coop = $data['coop'];
        $u->rating = $data['rating'];
        $u->grants = $data['grants'];
        $u->learn_program = $data['learn_program'];
        $u->docs_income = $data['docs_income'];
        $u->user_id = $data['user_id'];
        $u->save();
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/list/college?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect((session()->get('n'))?'admin/list/college?n='.session()->get('n'):'admin/list/college')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getPageDelete($id){

        $university = University::findOrFail($id);
        $university->description = null;
        $university->achievements = null;
        $university->short_description = null;
        $university->coop = null;
        $university->rating = null;
        $university->docs_income = null;
        $university->learn_program = null;
        $university->grants = null;
//        if ($university->image){
//            $old = getcwd();
//            chdir(public_path().'/img/universities');
//            unlink(public_path().'/img/universities/'.$university->image);
//            chdir($old);
//            $university->image = null;
//        }
//        $university->military_dep = null;
//        $university->dormitory = null;
//        $university->web_site = null;
        $university->logo = 0;
        $university->save();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/list/college?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect((session()->get('n'))?'admin/list/college?n='.session()->get('n'):'admin/list/college')->with('errors', 'Запись успешна удалена');
        }
    }
}
