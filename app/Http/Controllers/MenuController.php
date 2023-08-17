<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Table;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MenuController extends Controller
{
    public function __construct()
    {
        // $setting = Setting::find(1);
        // if ($setting->status == 'DEACTIVE') {
        //     return view('errors.400');
        // }
    }
    public function index($id, $branch_id)
    {
        $branch = Branch::find($branch_id);
        $table = Table::find($id);

        $reservation = Reservation::where([['table_id', $id], ['status', '!=', 'انتهى']])->first();
        // $reservationIn = Reservation::where([['table_id', $id], ['status', '!=', 'انتهى']])->first();

        if (!$reservation) {
            return view('errors.404');
        }
        // $reservation = Reservation::where([['id', 25]])->first();
        $reservation->status = 'تم الحضور';
        $reservation->update();
        if ($reservation->status != 'انتهى') {
            $table->status = "in_service";
            $table->update();
        }
        $categories = ProductCategory::where('category_status', 1)
            ->with([
                'branch' => function ($query) use ($branch_id) {
                    $query->where('branch_id',  $branch_id);
                }, 'Product' => function ($query) {
                    $query->where('status',  1);
                }
            ])
            ->orderBy('category_order', 'asc')
            ->whereHas('branch', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })

            ->get();
        return view('menu.home', compact(
            'categories',
            'branch',
            'table',
            'reservation'
        ));
    }

    public function cart($id, $branch_id)
    {
        // $reservation = Reservation::where([['table_id', $id], ['status', 'مؤكد']])->first();
        // if (!$reservation) {
        //     return view('errors.400');
        // }
        $reservation = Reservation::where([['id', 25]])->first();
        $branch = Branch::find($branch_id);
        $table = Table::find($id);
        return view('menu.cart', compact(
            'branch',
            'table',
            'reservation'
        ));
    }

    public function product($id, $branch_id, $product_id)
    {
        // $reservation = Reservation::where([['table_id', $id], ['status', 'مؤكد']])->first();
        // if (!$reservation) {
        //     return view('errors.400');
        // }
        $reservation = Reservation::where([['id', 25]])->first();
        $branch = Branch::find($branch_id);
        $table = Table::find($id);
        $product = Product::find($product_id);
        return view('menu.product', compact(
            'branch',
            'table',
            'reservation',
            'product'
        ));
    }

    public function storeOrder(Request $request, $id, $branch_id)
    {
        $paymentMethod = $request->input('paymentMethod');
        $cartItems = $request->input('cartItems');
        $reservation = Reservation::where([['table_id', $id], ['status', '!=', 'انتهى']])->first();
        $order = Order::where([['table_id', $id], ['package_id', $reservation->package_id], ['is_done', 0]])->first();
        if ($paymentMethod == 'الرصيد') {
            foreach ($cartItems as $cartItem) {
                $orderProduct = new OrderProduct();
                $orderProduct->product_id = $cartItem->id;
                $orderProduct->order_id = $order->id;
                $orderProduct->quantity = $cartItem->quantity;
                $orderProduct->price = $cartItem->price;
                $orderProduct->save();
            }
        } elseif ($paymentMethod == 'دفع إلكتروني') {
            return   $this->handlerPaymentOrder($cartItems, $reservation, $id, $branch_id);
        }
        // You can also save cart items related to this order

        return response()->json(['message' => 'Order stored successfully']);
    }

    private function handlerPaymentOrder($cartItems, $reservation, $id, $branch_id)
    {


        $fullPrice = 0;
        $products  = [];
        foreach ($cartItems as $index =>  $cartItem) {
            $fullPrice += $cartItem->price * $cartItem->quantity;
            $products[$index]['ItemName']  = $cartItem->name;
            $products[$index]['Quantity']  = $cartItem->quantity;
            $products[$index]['UnitPrice'] = $cartItem->price;
        }


        // final price without any discount
        $FinalPrice = number_format($fullPrice, 2, '.', '');

        $dataApiReturn = json_encode([
            'order_id' => '',
        ]);
        // return with success - price before discount - price after discount - order id - coupon object
        $data = [
            'NotificationOption' => 'ALL',
            'CustomerName'       => 'vkoa',
            'DisplayCurrencyIso' => 'SAR',
            'MobileCountryCode'  => '0096',
            'CustomerMobile'     => $reservation->client->phone,
            'CustomerEmail'      => 'customer@yalago.com',
            'InvoiceValue'       => $FinalPrice,
            'Language'           => app()->getLocale() == 'en' ? 'en' : 'ar',
            'CustomerReference'  => $reservation->client->id,
            'UserDefinedField'   => $dataApiReturn,
            'ApiCustomFileds'    => $dataApiReturn,
            'InvoiceItems'       => $products,
            "callBackUrl"        =>  route('paymentStatus', ['table_id' => $id, 'branch_id' => $branch_id]),
            'ErrorUrl'           =>  route('faild.payments', ['table_id' => $id, 'branch_id' => $branch_id]),
            "callBackUrl"        => 'https://dashboard.metaemenu.com/en/dashboard/congrate/marketplaces/pill',
            'API_URL'            => 'https://apitest.myfatoorah.com',
        ];
        $mf_base_url  = "https://apitest.myfatoorah.com/v2/SendPayment";
        $api_token = "Tfwjij9tbcHVD95LUQfsOtbfcEEkw1hkDGvUbWPs9CscSxZOttanv3olA6U6f84tBCXX93GpEqkaP_wfxEyNawiqZRb3Bmflyt5Iq5wUoMfWgyHwrAe1jcpvJP6xRq3FOeH5y9yXuiDaAILALa0hrgJH5Jom4wukj6msz20F96Dg7qBFoxO6tB62SRCnvBHe3R-cKTlyLxFBd23iU9czobEAnbgNXRy0PmqWNohXWaqjtLZKiYY-Z2ncleraDSG5uHJsC5hJBmeIoVaV4fh5Ks5zVEnumLmUKKQQt8EssDxXOPk4r3r1x8Q7tvpswBaDyvafevRSltSCa9w7eg6zxBcb8sAGWgfH4PDvw7gfusqowCRnjf7OD45iOegk2iYSrSeDGDZMpgtIAzYVpQDXb_xTmg95eTKOrfS9Ovk69O7YU-wuH4cfdbuDPTQEIxlariyyq_T8caf1Qpd_XKuOaasKTcAPEVUPiAzMtkrts1QnIdTy1DYZqJpRKJ8xtAr5GG60IwQh2U_-u7EryEGYxU_CUkZkmTauw2WhZka4M0TiB3abGUJGnhDDOZQW2p0cltVROqZmUz5qGG_LVGleHU3-DgA46TtK8lph_F9PdKre5xqXe6c5IYVTk4e7yXd6irMNx4D4g1LxuD8HL4sYQkegF2xHbbN8sFy4VSLErkb9770-0af9LT29kzkva5fERMV90w";

        return  $data = $this->sendPayment($mf_base_url, $api_token, $data);
    }
    function sendPayment($apiURL, $apiKey, $postFields)
    {
        $json = $this->callAPI($apiURL, $apiKey, $postFields);
        return redirect()->to($json['Data']['InvoiceURL']);
    }

    function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {

        $url = $endpointURL;
        $client  = new Client();
        $response  = $client->request($requestType, $url, [
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json'
            ],
            'json' => $postFields
        ]);

        $result = ($response->getBody());

        return $result = json_decode($result, true);


        // return Response::json($response);
        // return json_decode($response);
    }
    public function faild()
    {
        $data['Key'] = request('paymentId');
        $data['KeyType'] = 'paymentId';

        $url = "https://api-sa.myfatoorah.com/v2/getPaymentStatus";
        $client  = new Client();
        $response  = $client->request('post', $url, [
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer HO_GVNA4pZBcAD_KOmtjYzZ9pCqu1cvNg9es78dzH9Rj6JDDyAAOAHasooE7tN2HKqa9GLLCYrmYxvcM8yhFu9SsDaZ4wcyPD07aP8GMK4u37mTH2M_pZyphT9A-tfuhTck2Awt1bf1zA9cxv9bYzaujQllStH_NQda0BcQIUSpY2zD7Q_cTM8lWvhHCPO2BGd8YFbMs_UCsgUQfZzJzJJDJahPT19mN7Tm6NkJUzRrParecUwYZ7Getxw9rOQP7b9jqVq9E7Zivh7UutIPnu-aor_PzCvaJVK_uuyussbxsCLp0kPDjAosG-d07tIudvA27kJpnAnGfKpAJdnqB9l2x0D9levEWWhQ8BVPp5PArjBMWxqp7UYIPbIKNlYDnbWHcuacUe7u2DeRqB-VexwXdlz7LCC86vZvLmNnt3RYSjXTA79fwD6z7IS-rkHofn8UW1bua6yMcEg2sFc-v7gEsRE2XNJ0LrMKC_EcB-QD8vs4EYrxr0wVKk8aSYILKq_4GfXZG7AcMpnR6IqLGYkZuMTri3b-Uj6cq8f1_05iv-6hw_TdHBGn8RLWPRE1bvG7KS-TUSWeoG87Adp1QAsTz1Fr1Q7I_GZvtB3Gai2JkZ8jwRaObuGFf1kKa3wmYgd1fZG2yF_443YnMnSpkTayGK51h0VMHNEU1eUq6toK88n2pD7r4jYXUncCc6ONCnGV39Q",
                'Content-Type' => 'application/json'
            ], 'json' => $data
        ]);
        $result = ($response->getBody());
        $result = json_decode($result, true);
        $vendor_uuid = $this->vendor_uuid;
        $table =  $result['Data']['CustomerReference'];
        return view('menu.faild', compact('vendor_uuid', 'table'));
        // get all counts of products in basket
    }
    public function paymentStatus()
    {
        $url = $this->ApiUrl . "payment/myfatoorah-auth-table";
        $client  = new Client();
        $response  = $client->request('get', $url, [
            'verify' => false,
            'headers' => [
                'Lang' => \LaravelLocalization::getCurrentLocale()
            ],
        ]);
        $result = ($response->getBody());
        $result = json_decode($result, true);
        $data = [];
        $data['Key'] = request('paymentId');
        $data['KeyType'] = 'paymentId';
        $url = "https://apitest.myfatoorah.com/v2/getPaymentStatus";
        $client  = new Client();
        $response  = $client->request('post', $url, [
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => "Bearer HO_GVNA4pZBcAD_KOmtjYzZ9pCqu1cvNg9es78dzH9Rj6JDDyAAOAHasooE7tN2HKqa9GLLCYrmYxvcM8yhFu9SsDaZ4wcyPD07aP8GMK4u37mTH2M_pZyphT9A-tfuhTck2Awt1bf1zA9cxv9bYzaujQllStH_NQda0BcQIUSpY2zD7Q_cTM8lWvhHCPO2BGd8YFbMs_UCsgUQfZzJzJJDJahPT19mN7Tm6NkJUzRrParecUwYZ7Getxw9rOQP7b9jqVq9E7Zivh7UutIPnu-aor_PzCvaJVK_uuyussbxsCLp0kPDjAosG-d07tIudvA27kJpnAnGfKpAJdnqB9l2x0D9levEWWhQ8BVPp5PArjBMWxqp7UYIPbIKNlYDnbWHcuacUe7u2DeRqB-VexwXdlz7LCC86vZvLmNnt3RYSjXTA79fwD6z7IS-rkHofn8UW1bua6yMcEg2sFc-v7gEsRE2XNJ0LrMKC_EcB-QD8vs4EYrxr0wVKk8aSYILKq_4GfXZG7AcMpnR6IqLGYkZuMTri3b-Uj6cq8f1_05iv-6hw_TdHBGn8RLWPRE1bvG7KS-TUSWeoG87Adp1QAsTz1Fr1Q7I_GZvtB3Gai2JkZ8jwRaObuGFf1kKa3wmYgd1fZG2yF_443YnMnSpkTayGK51h0VMHNEU1eUq6toK88n2pD7r4jYXUncCc6ONCnGV39Q",
                'Content-Type' => 'application/json'
            ], 'json' => $data
        ]);
        $result = ($response->getBody());
        $result = json_decode($result, true);

        $table =  $result['Data']['CustomerReference'];
        $vendor_uuid = $this->vendor_uuid;
        return view('menu.sucess', compact('vendor_uuid', 'table'));
    }
}
