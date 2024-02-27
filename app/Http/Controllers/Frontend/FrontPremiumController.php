<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Price;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPremiumController extends Controller
{
    public function show_premium($name)
    {
        $page = 'premium';
        $show = User::where('name', $name)->first();
        $price = Price::all();
        return view('frontend.subscribe.front_gopremium', compact('show', 'page', 'price'));
    }

    public function choice($name, $price)
    {
        $page = 'choice';
        $show = User::where('name', $name)->first();
        return view('frontend.subscribe.front_choice', compact('page', 'show', 'price'));
    }

    public function pay(Request $request, $name, $price)
    {
        $page = 'pay';
        $show = User::where('name', $name)->first();
        $selectedPrice = Price::where('price', $price)->first();
        if (!$selectedPrice) {
            // Handle jika price tidak ditemukan
            return response()->json(['error' => 'Invalid price selected'], 404);
        }

        // Menambahkan nilai langsung ke dalam array request
        $request->request->add([
            'user_id' => Auth::user()->id,
            'price_id' => $selectedPrice->id,
            'total_price' => $selectedPrice->price,
            'status' => 'Unpaid',
            'snaptoken' => ''
        ]);

        // Membuat objek Order dan menyimpan ke dalam database
        $order = Order::create($request->all());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->snaptoken = $snapToken;
        // dd($snapToken);
        // die;
        $order->save();
        return view('frontend.subscribe.front_pay', ['name' => $name, 'price' => $price], compact('snapToken', 'order', 'show', 'page'))->with('success', 'Akun anda akan segera premium');
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $order = Order::find($request->order_id);
                if ($order) {
                    $order->update(['status' => 'Paid']);

                    $user = User::find($order->user_id);
                    if ($user) {
                        $user->update(['role' => 'premium']);
                        $price = Price::find($order->price_id);
                        $selectedPackage = $price->name;
                        if ($selectedPackage == '1 Bulan') {
                            $user->update(['premium_expiry' => now()->addMonth()]);
                        } elseif ($selectedPackage == '6 Bulan') {
                            $user->update(['premium_expiry' => now()->addMonths(6)]);
                        } elseif ($selectedPackage == '1 Tahun') {
                            $user->update(['premium_expiry' => now()->addYear()]);
                        } elseif ($selectedPackage == '3 Menit') {
                            $user->update(['premium_expiry' => now()->addMinutes(3)]);
                        }
                    }
                }
            }
        }
        // return redirect()->route('invoice', ['id' => $order->id])->with('success', 'Akun anda sudah premium');
    }

    public function invoice($id)
    {
        $page = 'invoice';
        $order = Order::find($id);
        $show = User::find($order->user_id);
        $price = Price::find($order->price_id);
        return view('frontend.subscribe.front_invoice', ['id' => $id], compact('order', 'show', 'price', 'page'));
    }
    // public function premium(Request $request, $name)
    // {
    //     $update = User::where('name', $name)->first();
    //     $update->role = 'pending';
    //     $update->update();
    //     compact('update');
    //     return redirect()->route('home')->with('success', 'Akun anda akan segera premium');
    // }

    // public function noHp()
    // {
    //     $no = Auth::user()->hp;

    //     return response()->json($no);
    // }
}
