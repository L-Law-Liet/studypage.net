<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SliderController extends Controller
{
    public function index()
    {
        $data = [];
        $sliders = Slider::orderBy('id', 'desc');
        $data['sliders'] = $sliders->paginate(20);
        $data['count'] = $data['sliders']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.slider.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['slider'] = null;
        if(!is_null($id)){
            $data['slider'] = Slider::findOrFail($id);
        }
        return view('admin.slider.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/sliders/', $fileName);
            }
            Slider::create($data);
        } else{
            unset($data['image']);
            if(Input::hasFile('image')) {
                $file = Input::file('image');
                $data['image'] = $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/img/sliders/', $fileName);
            }
            Slider::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/slider?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/slider')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['slider'] = Slider::findOrFail($id);
        return view('admin.slider.view', $data);
    }

    public function getDelete($id){

        $slider = Slider::findOrFail($id);
        if($slider->delete()){
            $old = getcwd();
            chdir(public_path().'/img/sliders');
            unlink(public_path().'/img/sliders/'.$slider->image);
            chdir($old);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/slider?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/slider')->with('errors', 'Запись успешна удалена');
        }
    }
}
