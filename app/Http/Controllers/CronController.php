<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TradeLog;
use App\Models\User;
use Carbon\Carbon;
use App\Models\PracticeLog;
use App\Models\Transaction;
use App\Models\GeneralSetting;
use App\Models\CryptoCurrencyPrice;
use App\Models\Wallet;
use Illuminate\Support\Arr;

class CronController extends Controller
{
    public function index()
    {
    	$tradeLogs = TradeLog::where('status', 0)->where('in_time', '<', Carbon::now())->get();
        $gnl = GeneralSetting::first();
        $gnl->last_cron_run =  Carbon::now();
        $gnl->save();

        foreach($tradeLogs as $tradeLog)
    	{
			$cryptoRate = getCoinRate($tradeLog->crypto->symbol);
			$user = User::find($tradeLog->user_id);
			$wallet = Wallet::where('user_id',$tradeLog->user_id)->where('symbol','USDT')->first();
			if($tradeLog->result == 0)
			{

				if($tradeLog->hilow == 1)
				{
					if($tradeLog->price_was < $cryptoRate)
					{
						$wallet->balance += $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
						$wallet->save();

                        $tradeLogAmount = $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                        $details = 'Trade ' . $tradeLog->crypto->name . ' ' . "WIN";
                        $this->transactions($wallet, $tradeLogAmount, $details);
                        $tradeLog->result = 1;
					}
					else if($tradeLog->price_was > $cryptoRate) {
                        $tradeLog->result = 2;
                    }else{
                    	$wallet->balance += $tradeLog->amount;
						$wallet->save();

                        $tradeLogAmount = $tradeLog->amount;
                        $details = 'Trade ' . $tradeLog->crypto->name . ' ' .  "Refund";
                        $this->transactions($wallet, $tradeLogAmount, $details);
                        $tradeLog->result = 3;
                    }
				}
                else if($tradeLog->hilow == 2)
                {
                    if($tradeLog->price_was > $cryptoRate)
                    {
                        $wallet->balance += $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                        $wallet->save();

                        $tradeLogAmount = $tradeLog->amount + (($tradeLog->amount / 100) * $gnl->profit);
                        $details = 'Trade ' . $tradeLog->crypto->name . ' ' . "WIN";
                        $this->transactions($wallet, $tradeLogAmount, $details);
                        $tradeLog->result = 1;
                    }
                    else if($tradeLog->price_was < $cryptoRate)
                    {
                        $tradeLog->result = 2;
                    }
                    else{
                        $wallet->balance += $tradeLog->amount;
                        $wallet->save();

                        $tradeLogAmount = $tradeLog->amount;
                        $details = 'Trade ' . $tradeLog->crypto->name . ' ' .  "Refund";
                        $this->transactions($wallet, $tradeLogAmount, $details);
                        $tradeLog->result = 3;
                    }
                }
                $tradeLog->status = 1;
                $tradeLog->save();
    		}
    	}
    }

    public function transactions($wallet, $tradeLogAmount, $details)
    {
        $transaction = new Transaction();
        $transaction->user_id = $wallet->user_id;
        $transaction->amount = $tradeLogAmount;
        $transaction->post_balance = $wallet->balance;
        $transaction->trx_type = "+";
        $transaction->details = $details;
        $transaction->trx = getTrx();
        $transaction->save();
    }

    public function store()
    {
        $gnl = GeneralSetting::first();
        $gnl->last_cron_run =  Carbon::now();
        $gnl->save();

        $apiKey = $gnl->coin_api_key;
        $symbols = CryptoCurrencyPrice::get(['symbol']);

        if($symbols->isNotEmpty())
        {
            $symbolArray = $symbols->groupBy('symbol')->map(function ($item, $key) {
                return collect($item);
            });
            $symbol = Arr::flatten($symbolArray->keys());
            $crypto = implode(",", $symbol);

            $parameters = [
                'symbol' => $crypto
            ];
            $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
            $headers = [
              'Accepts: application/json',
              'X-CMC_PRO_API_KEY:'. $apiKey
            ];
            $qs = http_build_query($parameters);
            $request = "{$url}?{$qs}";

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $request,
              CURLOPT_HTTPHEADER => $headers,
              CURLOPT_RETURNTRANSFER => 1
            ));
            $responses = json_decode(curl_exec($curl));
            curl_close($curl);
            foreach ($responses->data as  $da) {
                $symbol = $da->symbol;
                $cryptoCurrencyPrice = CryptoCurrencyPrice::where('symbol', $da->symbol)->first();
                if ($cryptoCurrencyPrice) {
                    $cryptoCurrencyPrice->name = $da->name;
                    $cryptoCurrencyPrice->symbol = @$da->symbol;
                    $cryptoCurrencyPrice->one_hour = @$da->quote->USD->percent_change_1h;
                    $cryptoCurrencyPrice->price = @$da->quote->USD->price;
                    $cryptoCurrencyPrice->seven_day = @$da->quote->USD->percent_change_7d;
                    $cryptoCurrencyPrice->market_cap = @$da->quote->USD->market_cap;
                    $cryptoCurrencyPrice->twenty_four = @$da->quote->USD->percent_change_24h;
                    $cryptoCurrencyPrice->volume24h = @$da->quote->USD->volume_24h;
                    $cryptoCurrencyPrice->circulating = @$da->circulating_supply;
                    $cryptoCurrencyPrice->save();
                }
            }
        }
        else{
            $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
            $parameters = [
              'start' => '1',
              'limit' => '10',
              'convert' => 'USD'
            ];

            $headers = [
              'Accepts: application/json',
              'X-CMC_PRO_API_KEY:'. $apiKey
            ];

            $qs = http_build_query($parameters);
            $request = "{$url}?{$qs}";

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $request,
              CURLOPT_HTTPHEADER => $headers,
              CURLOPT_RETURNTRANSFER => 1
            ));

            $response = json_decode(curl_exec($curl));
            curl_close($curl);
            foreach ($response->data as  $da) {
                $cryptoCurrencyPrice = new CryptoCurrencyPrice;
                $cryptoCurrencyPrice->name = $da->name;
                $cryptoCurrencyPrice->symbol = @$da->symbol;
                $cryptoCurrencyPrice->one_hour = @$da->quote->USD->percent_change_1h;
                $cryptoCurrencyPrice->price = @$da->quote->USD->price;
                $cryptoCurrencyPrice->seven_day = @$da->quote->USD->percent_change_7d;
                $cryptoCurrencyPrice->market_cap = @$da->quote->USD->market_cap;
                $cryptoCurrencyPrice->twenty_four = @$da->quote->USD->percent_change_24h;
                $cryptoCurrencyPrice->volume24h = @$da->quote->USD->volume_24h;
                $cryptoCurrencyPrice->circulating = @$da->circulating_supply;
                $cryptoCurrencyPrice->save();
            }
        }
    }

    public function practiceCron()
    {
        $practiceLogs = PracticeLog::where('status', 0)->where('in_time', '<', Carbon::now())->get();
        $gnl = GeneralSetting::first();
        $gnl->last_cron_run =  Carbon::now();
        $gnl->save();

        foreach($practiceLogs as $practiceLog)
        {
            $cryptoRate = getCoinRate($practiceLog->crypto->symbol);
            $user = User::find($practiceLog->user_id);
            if($practiceLog->result == 0)
            {
                if($practiceLog->hilow == 1)
                {
                    if($practiceLog->price_was < $cryptoRate)
                    {
                        $user->practice_balance += $practiceLog->amount + (($practiceLog->amount / 100) * $gnl->profit);
                        $user->save();

                        $practiceLog->result = 1;
                    }
                    else if($practiceLog->price_was > $cryptoRate) {
                        $practiceLog->result = 2;
                    }else{
                        $user->practice_balance += $practiceLog->amount;
                        $user->save();

                        $practiceLog->result = 3;
                    }
                }
                else if($practiceLog->hilow == 2)
                {
                    if($practiceLog->price_was > $cryptoRate)
                    {
                        $user->practice_balance += $practiceLog->amount + (($practiceLog->amount / 100) * $gnl->profit);
                        $user->save();
                        $practiceLog->result = 1;
                    }
                    else if($practiceLog->price_was < $cryptoRate)
                    {
                        $practiceLog->result = 2;
                    }
                    else{
                        $user->practice_balance += $practiceLog->amount;
                        $user->save();
                        $practiceLog->result = 3;
                    }
                }
                $practiceLog->status = 1;
                $practiceLog->save();
            }
        }
    }
}
