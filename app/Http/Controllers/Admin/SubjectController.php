<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SubjectController
{
    public function index($t, Request $request){
        if ($request->get('page')){
            $n = session()->get('n');
        }
        else {
            $n = $request->get('n');
        }
        session(['n' => $n]);

        $data = [];
        $forCollege = 1;
        if ($t == 'univer'){
            $forCollege = 0;
        }
        $subjects = Subject::where('forCollege', $forCollege);
        if ($n){
            $subjects = $subjects->where('name_ru', 'LIKE', '%'.$n.'%');
        }
        $subjects->orderBy('id', 'desc');
        $data['subjects'] = $subjects->paginate(20);
        $data['count'] = $data['subjects']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.subject.index', compact('t', 'n'), $data);
    }

    public function getAdd($t, $id = null){
        $data = [];
        $data['id'] = $id;
        $data['subject'] = null;
        if(!is_null($id)){
            $data['subject'] = Subject::findOrFail($id);
        }
        return view('admin.subject.add', compact('t'), $data);
    }

    public function postAdd($t, $id = null){
        $data = Input::all();
        if(is_null($id)){
            $forCollege = 1;
            if ($t == 'univer'){
                $forCollege = 0;
            }
            $data['forCollege'] = $forCollege;
            Subject::create($data);
        } else{
            Subject::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/subject/$t".'?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect("admin/subject/$t")->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($t, $id){

        $data['subject'] = Subject::findOrFail($id);
        return view('admin.subject.view', $data);
    }

    public function getDelete($t, $id){

        $subject = Subject::findOrFail($id);
        $subject->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/subject/$t".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect("admin/subject/$t")->with('errors', 'Запись успешна удалена');
        }
    }

}
