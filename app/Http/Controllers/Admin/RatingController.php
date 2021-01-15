<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\RankingSource;
use App\Models\Rating;
use App\Models\RatingCategory;
use App\Models\University;
use App\Profile;
use App\ProfileUniversity;
use Illuminate\Support\Facades\Input;
use function Sodium\compare;

class RatingController
{
    public function index($t){

        $data = [];
        $rating = ProfileUniversity::whereIn('university_id', University::where('hasCollege', $t-1)->pluck('id'))->orderBy('id', 'desc');
        $data['rating'] = $rating->paginate(20);
        $data['count'] = $data['rating']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.rating.index', compact('t'), $data);
    }
    public function getAdd($t, $id = null){
        $data = [];
        $data['id'] = $id;
        $data['rating'] = null;
        $data['profiles'] = Profile::where('forCollege', $t-1)->pluck('name', 'id')->all();
        $data['universities'] = University::where('hasCollege', $t-1)->pluck('name_ru', 'id')->all();
        if(!is_null($id)){
            $data['rating'] = ProfileUniversity::findOrFail($id);
        }
        return view('admin.rating.add', compact('t'), $data);
    }
    public function postAdd($t, $id = null){
        $data = Input::all();
        if(is_null($data['university_id']) || empty($data['university_id'])){
            return redirect()->back()->withInput()->withErrors(['errors' => 'Выберите университет']);
        }
        if(is_null($id)){
            $validator = Rating::validate($data);
            if(!$validator->fails()) { //Если проходит валидацю
                ProfileUniversity::create($data);
                return \redirect("admin/rating/$t")->with('success', 'Запись успешна сохранена');
            } else{
                return redirect()->back()->withInput()->withErrors(['errors' => $validator->errors()->all()]);
            }
        } else{
            ProfileUniversity::findOrFail($id)->update($data);
            return \redirect("admin/rating/$t")->with('success', 'Запись успешна сохранена');
        }
    }
    public function getView($t, $id){
        $data['rating'] = ProfileUniversity::findOrFail($id);
        return view('admin.rating.view', compact('t'), $data);
    }
    public function getDelete($t, $id){

        $rating = ProfileUniversity::findOrFail($id);
        $rating->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect("admin/rating/$t?page=".$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect("admin/rating/$t")->with('errors', 'Запись успешна удалена');
        }
    }

    public function indexCategory(){

        $data = [];
        $profiles = Profile::all();
        $data['profiles'] = Profile::paginate(20);
        $data['count'] = $data['profiles']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.rating-profiles.index', $data);
    }
    public function getAddCategory($id = null){
        $data = [];
        $data['id'] = $id;
        $data['profile'] = null;
        if(!is_null($id)){
            $data['profile'] = Profile::findOrFail($id);
        }
        return view('admin.rating-profiles.add', $data);
    }
    public function postAddCategory($id = null){
        $data = Input::all();
        $data['forCollege'] -= 1;
        if(is_null($id)){
            Profile::create($data);
        } else{
            Profile::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/rating-category?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/rating-category')->with('success', 'Запись успешна сохранена');
        }
    }
    public function getDeleteCategory($id){

        $profile = Profile::findOrFail($id);
        $profile->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/rating-category?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/rating-category')->with('errors', 'Запись успешна удалена');
        }
    }

}
