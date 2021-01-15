<?php

namespace App\Http\Controllers;

use App\Order;
use Dosarkz\EPayAlfaBank\Facades\AlfaBank;
use Dosarkz\EPayAlfaBank\Requests\DoRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpayController extends Controller
{
    public static function payment(Request $request){
        $order = new Order();
        $order->name = 'Temp';
        $order->user_id = Auth::id();
        $order->save();
        $params = [
            'userName' => 'studypage_kz-api',
            'password' =>  'studypage_kz*?1',
            'orderNumber' => $order->id+10,
            'amount'    => $request->get('sum').'00',
            'currency' => 398,
            'returnUrl' => route('success-payment', ['m' => 'Ваш счет успешно пополнен!', 'sum' => $request->get('sum')]),
            'failUrl' => route('fail-payment',['m' => 'Ошибка при попытке оплаты!']),
            'description'   => 'GG',
            'language'  => 'ru',
            'pageView'  => 'DESKTOP',
        ];
        $pay = AlfaBank::registerDo(new DoRegisterRequest($params));
        $order->name = $pay['orderId'];
        $order->save();
        session()->forget('refPay');
        return redirect($pay['formUrl']);
    }

    public function requestResult(Request $request) {
        \Log::info($request->all());
    }
}
