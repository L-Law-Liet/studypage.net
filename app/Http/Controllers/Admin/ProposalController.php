<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proposal;

class ProposalController
{
    public function index()
    {
        $data = [];
        $proposal = Proposal::orderBy('id', 'desc');
        $data['proposal'] = $proposal->paginate(20);
        $data['count'] = $data['proposal']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.proposal.index', $data);
    }

    public function getView($id){

        $data['proposal'] = Proposal::findOrFail($id);
        return view('admin.proposal.view', $data);
    }

    public function getDelete($id){

        $callback = Proposal::findOrFail($id);
        $callback->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/proposal?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/proposal')->with('errors', 'Запись успешна удалена');
        }
    }
}
