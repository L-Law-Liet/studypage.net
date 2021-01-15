<?php

namespace App\Http\Controllers;

use App\Models\RankingSource;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index()
    {
        setcookie("asd", 'OK', time()+3600000);
      //  echo '1:'.$_COOKIE["asd"];
       // die;
        $rating= Rating::where('category_id', 1)->orderBy('overall_rating', 'DESC');
        $data['rating'] = $rating->paginate(100);
        $data['count'] = $data['rating']->total();
        $data['ranking'] = RankingSource::first();
        //$data['categories'] = RatingCategory::pluck('name', 'id')->all();

        return view('rating.index', $data)->with('map', 'Главная → Рейтинг');
    }
}
