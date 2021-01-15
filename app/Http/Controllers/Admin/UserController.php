<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;

class UserController
{
    public function index(){
        $data = [];
        $users = User::orderBy('id', 'desc');
        $data['users'] = $users->paginate(20);
        $data['count'] = $data['users']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.users.index', $data);
    }
    public function getView($id){

        $data['user'] = User::findOrFail($id);
        return view('admin.users.view', $data);
    }

    public function getDelete($id){

        $user = User::findOrFail($id);
        $user->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/user?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/user')->with('errors', 'Запись успешна удалена');
        }
    }
}
