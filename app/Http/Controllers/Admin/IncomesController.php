<?php

namespace App\Http\Controllers\Admin;

use App\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class IncomesController extends Controller
{
    public function index($t){

        $data = [];
        $isCollege = 1;
        if ($t == 'univer'){
            $isCollege = 0;
        }
        $incomes = Income::where('isCollege', $isCollege);
        $data['incomes'] = $incomes->paginate(20);
        $data['count'] = $data['incomes']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.income.index', compact('t'), $data);
    }
    public function getAdd($t, $id = null){
        $data = [];
        $data['id'] = $id;
        $data['income'] = null;
        if(!is_null($id)){
            $data['income'] = Income::findOrFail($id);
        }
        return view('admin.income.add', compact('t'), $data);
    }
    public function postAdd($t, $id = null){
        $data = Input::all();
        if(is_null($id)){
            $isCollege = 1;
            if ($t == 'univer'){
                $isCollege = 0;
            }
            $data['isCollege'] = $isCollege;
            Income::create($data);
        } else{
            Income::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/income/$t".'?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect("admin/income/$t")->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDelete($t, $id){

        $income = Income::findOrFail($id);
        $income->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/income/$t".'?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect("admin/income/$t")->with('errors', 'Запись успешна удалена');
        }
    }
}
