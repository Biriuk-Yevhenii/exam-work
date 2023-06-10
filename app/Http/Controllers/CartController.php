<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Bi;
use App\Models\Buy;
use App\Models\Cart;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Library\LiqPay;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        $client = new Client(['base_uri' => 'https://restcountries.com/v3.1/']);
        $response = $client->get('all');
        $countries = json_decode($response->getBody(), true);

        $countryList = [];
        foreach ($countries as $country) {
            $countryList[] = $country['name']['common'];
        }

        $totalPrice = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        /* $order_id = uniqid();
        Cookie::queue('order_id', $order_id, 10);
        $liqpay = new LiqPay(env('LIQPAY_PUBLIC', ''), env('LIQPAY_PRIVATE', ''));
        $html = $liqpay->cnb_form(array(
        'action'         => 'pay',
        'amount'         => "$totalPrice",
        'currency'       => 'USD',
        'description'    => 'Thenks for yousing our shop.',
        'order_id'       => $order_id,
        'version'        => '3',
        'result_url'     => 'http://exam-work/api/carts/buyItNow'
        )); */


        return view('cart.index', compact('carts', 'countryList', 'totalPrice'));
    }
    public function addToCart($id)
    {
        $user_id = Auth::user()->id;
        $prod = Cart::where('product_id', $id)->where('user_id', $user_id)->get();
        if($prod->count() > 0)
        {
            $prod[0]->quantity++;
            $prod[0]->save(); // Сохраняем данные в таблицу "carts"
            return redirect()->back();
        }
        
        $product_id = $id;
        $cart = new Cart(); // Создаем новый экземпляр модели Cart
        $cart->product_id = $product_id; // Устанавливаем значение поля product_id
        $cart->user_id = $user_id; // Устанавливаем значение поля user_id
        $cart->quantity=1;
        $cart->save(); // Сохраняем данные в таблицу "carts"
        return redirect()->back();
    }

    public function quantity(Request $request)
    {
        $quantity = $request->input('quantity');
        $productId = $request->input('productId');
        $user_id = Auth::user()->id;

        // Выполните необходимые действия с полученными данными
        $prod = Cart::where('product_id', $productId)->where('user_id', $user_id)->first();
        $prod->quantity = $quantity;
        $prod->save();


        //Total Price
        $carts = Cart::with('product')->where('user_id', $user_id)->get();
        $totalPrice = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });


        // Верните данные в формате JSON
        return response()->json([
            'message' => 'Quantity updated successfully',
            'quantity' => $quantity,
            'productId' => $productId,
            'totalPrice' => $totalPrice // Добавьте обновленную общую стоимость
        ]);
    }

    public function buyItNow(Request $request)
    {
        $private_key = env('LIQPAY_PRIVATE', '');
        $data = $request->data;

        $sign = base64_encode( sha1( 
            $private_key .  
            $data . 
            $private_key 
            , 1 
        ));

        if($sign === $request->signature)
        {
            return redirect('end-chekout');
        }
        else dd('error');
            
        /* if ($request->has('action') && $request->input('action') == 'buyItNow' && $request->has('status') && $request->input('status') == 'success') {
            $buy = Buy::create($request->all());
    
            $name = 'Admin';
            $em = 'buying@admin.com';
            $message = 'Thank`s for buying our product. We will send it to you in 3 work days.';
            $email_to = $request->email;
            Mail::to($email_to)->send(new ContactEmail($name, $em, $message, 0));
    
            return redirect()->route('thankYouPage');
        } else {
            dd($request->all());
        } */

        /* $buy = Buy::create($request->all());

        $name = 'Admin';
        $em = 'buying@admin.com';
        $message = 'Thank`s for buyin our product. We will send it to you in 3 work days.';
        $email_to = $request->email;
        Mail::to($email_to)->send(new ContactEmail($name, $em, $message)); */
    }
    public function start_chekout(Request $request)
    {
        $buy_id = [];
        $order_id = uniqid();
        $bi_id = [];
        for($i = 1; $i <= $request->iterations; ++$i)
        {
            $carts = Cart::where('id',$request->input("prod$i"))->get();
            foreach($carts as $cart)
            {
                $bi = new Bi();
                $bi->user_id = $cart->user_id;
                $bi->product_id = $cart->product_id;
                $bi->quantity = $cart->quantity;
                $bi->save();
            }
            
            $buy = new Buy();
            $buy->country = $request->country;
            $buy->sity = $request->sity;
            $buy->post_code = $request->post_code;
            $buy->address = $request->address;
            $buy->name = $request->name;
            $buy->sec_name = $request->sec_name;
            $buy->tel = $request->tel;
            $buy->email = $request->email;
            $buy->bi_id = $bi->id;
            $buy->payment = $request->payment;
            $buy->user_id = $request->user_id;
            $buy->order_id = $order_id;
            $buy->save();
            $buy_id[] = $buy->id;
            echo $buy;
        }       
        $user_id = Auth::user()->id;
        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        $totalPrice = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        
        Cookie::queue('order_id', $order_id, 10);
        $liqpay = new LiqPay(env('LIQPAY_PUBLIC', ''), env('LIQPAY_PRIVATE', ''));
        $html = $liqpay->cnb_form(array(
        'action'         => 'pay',
        'amount'         => "$totalPrice",
        'currency'       => 'USD',
        'description'    => 'Thenks for yousing our shop.',
        'order_id'       => $order_id,
        'version'        => '3',
        'result_url'     => 'http://exam-work/api/carts/buyItNow'
        ));

        return view('cart.checking', compact('request', 'html', 'buy_id'));
    }
    public function end_chekout()
    {
        $liqpay = new LiqPay(env('LIQPAY_PUBLIC', ''), env('LIQPAY_PRIVATE', ''));
        $res = $liqpay->api("request", array(
        'action'        => 'status',
        'version'       => '3',
        'order_id'      => request()->cookie('order_id')
        ));
        if($res->status !=='error')
        {
            //Запись в бл
            $buys = Buy::where('order_id', $res->order_id)->get();
            foreach($buys as $b)
            {
                $b->payment = 1;
                $b->save();
            }
            return redirect('http://exam-work/history');
            //dd($res);
        }
        else{
            //отмена оплаты
            echo 'error';
            //слздать  страницу где будет писать что оплата не прошла
        }
    }

    public function history()
    {
        $user = User::with('buys.bi.product')->find(Auth::user()->id);
        return view('cart.history', compact('user'));
    }

    public function buys_delete(Buy $buy)
    {
        $buy->delete();
        /* $user_id = Auth::user()->id;
        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        $client = new Client(['base_uri' => 'https://restcountries.com/v3.1/']);
        $response = $client->get('all');
        $countries = json_decode($response->getBody(), true);

        $countryList = [];
        foreach ($countries as $country) {
            $countryList[] = $country['name']['common'];
        }

        $totalPrice = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        }); */

        /* return view('cart.index', compact('carts', 'countryList', 'totalPrice')); */
        return redirect('http://exam-work/carts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo ($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }

    
}
