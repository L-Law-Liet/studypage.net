<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Facades\Input;

class ArticleController
{
    public function index()
    {
        $data = [];
        $article = Article::orderBy('id', 'desc');
        $data['article'] = $article->paginate(20);
        $data['count'] = $data['article']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.article.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['article'] = null;
        if(!is_null($id)){
            $data['article'] = Article::findOrFail($id);
        }
        return view('admin.article.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Article::create($data);
        } else{
            Article::findOrFail($id)->update($data);
        }
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/article?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/article')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['article'] = Article::findOrFail($id);
        return view('admin.article.view', $data);
    }

    public function getDelete($id){

        $article = Article::findOrFail($id);
        $article->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/article?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/article')->with('errors', 'Запись успешна удалена');
        }
    }
}
