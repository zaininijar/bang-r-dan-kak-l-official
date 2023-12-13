<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exchange;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExchangeController extends Controller
{
    public function index()
    {
        $exchanges_model = new Exchange();

        $exchanges_roblox = $exchanges_model->where('exchange_type', 'RBX')->get();
        $exchanges_ff = $exchanges_model->where('exchange_type', 'FF')->get();
        $exchanges_ewallet = $exchanges_model->where('exchange_type', 'E-WALLET')->get();
        $exchanges_ml = $exchanges_model->where('exchange_type', 'ML')->get();

        $exchanges = array(
            'RBX' => $exchanges_roblox,
            'FF' => $exchanges_ff,
            'E-WALLET' => $exchanges_ewallet,
            'ML' => $exchanges_ml,
        );

        return view('user.exchange', ['exchanges' => $exchanges]);
    }

    public function history()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('user.transaction-history', ['transactions' => $transactions]);
    }

    public function store(Request $request)
    {



        $this->validateMainFields($request);

        try {
            DB::beginTransaction();

            $requestData = $request->all();
            $account_identity = "";

            if ($request->input('exchange_type') === 'ML' || $request->input('exchange_type') === 'E-WALLET') {
                $this->validate($request, ['account_identity_second' => 'required'], ['account_identity_second.required' => 'Server harus diisi ya....']);
                $account_identity = $requestData['account_identity_main'] . '-' . $requestData['account_identity_second'];
            } else {
                $account_identity = $requestData['account_identity_main'];
            }

            $exchange = Exchange::where('id', $requestData['exchange_id'])->first();

            $isEnough = $this->isEnoughPoin($exchange->point);

            if (!$isEnough) {
                throw new \Exception('Poin anda tidak cukup.');
            }

            Transaction::create([
                'user_id' => Auth::user()->id,
                'exchange_id' => $requestData['exchange_id'],
                'account_identity' => $account_identity,
            ]);

            DB::commit();

            $url = 'https://graph.facebook.com/v17.0/153288241210140/messages';
            $accessToken = 'EAAoIi7MKg9cBO33vZBwWqOH11GoDqS914TGAWxkdWGrRZCKE74bhAlpwWLjdft66u5ymucRtHAeTo26XdKB8W6hZCdl8drAF9BPjNxIUPbSExPcKZBbuaXC0Kuxlrg8X29NOzEjUu5yeuTp5KinZAuYdeN7NKy6Tpxm2FCARlTiAHZBtTddZADk6vZBlTHQGABfuo0dhYOZBqjAQwZCMzjbwYZD';

            $data = array(
                'messaging_product' => 'whatsapp',
                'to' => '6282286947001',
                'type' => 'template',
                'template' => array(
                    'name' => 'penukaran_poin',
                    'language' => array(
                        'code' => 'en_US'
                    ),
                    'components' => [
                        [
                            "type" => "header",
                            "parameters" => [
                              [
                                "type" => "image",
                                "image" => [
                                  "link" => "https://static.vecteezy.com/system/resources/thumbnails/008/386/647/small/lr-or-rl-initial-letter-logo-design-vector.jpg"
                                ]
                              ]
                            ]
                        ],
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => Auth::user()->username,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $exchange->exchanged_to,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $exchange->exchange_type,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $account_identity,
                                ],
                            ],
                        ],
                    ],
                )
            );

            $data_string = json_encode($data);

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ));

            $response = curl_exec($ch);

            curl_close($ch);

            echo $response;

            return redirect()->back()->with('success', 'Transaction successful.');

        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    private function validateMainFields(Request $request)
    {
        $rules = [
            'exchange_type' => 'required',
            'exchange_id' => 'required',
            'account_identity_main' => 'required',
        ];

        $messages = [
            'exchange_type.required' => 'Anda lupa memilih metode penukaran.',
            'exchange_id.required' => 'Tentukan point anda mau di tukar keaman',
            'account_identity_main.required' => 'ID, Link Game Pass, atau No. E-Wallet harus diisi ya...',
        ];

        $this->validate($request, $rules, $messages);
    }

    private function isEnoughPoin(int $point)
    {

        $user = User::where('id', Auth::user()->id)->first();

        if ($user->point >= $point) {
            $user->point -= $point;
            $user->save();

            return true;
        }

        return false;
    }

}
