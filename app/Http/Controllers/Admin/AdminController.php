<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\WithdrawMethod;
use App\Models\Withdrawal;
use App\Models\CryptoCurrency;
use App\Models\TradeLog;
use App\Models\GeneralSetting;
use App\Models\KYC;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {
        $page_title = 'Dashboard';

        $widget['total_users'] = User::count();
        $widget['verified_users'] = KYC::where('status','approved')->count();
        $widget['email_unverified_users'] = User::where('email_verified_at', NULL)->count();
        //$widget['sms_unverified_users'] = User::where('sv', 0)->count();
        // Build an array of the dates we want to show, oldest first
        $dates['total_users'] = collect();
        $dates['verified_users'] = collect();
        $dates['email_unverified_users'] = collect();
        //$dates['sms_unverified_users'] = collect();

        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['total_users']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['verified_users']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['email_unverified_users']->put( $date, 0);
        }
        //foreach( range( -30, 0 ) AS $i ) {
        //    $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
        //    $dates['sms_unverified_users']->put( $date, 0);
        //}

        // Get the post counts
        $widgets['total_usersdate'] = User::where( 'created_at', '>=',  $dates['total_users']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $widgets['verified_usersdate'] = User::where('kyc', 1)->where( 'created_at', '>=', $dates['verified_users']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $widgets['email_unverified_usersdate'] = User::where('email_verified_at', NULL)->where( 'created_at', '>=', $dates['email_unverified_users']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        /*$widgets['sms_unverified_usersdate'] = User::where('sv', 0)->where( 'created_at', '>=', $dates['sms_unverified_users']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );*/

        $dates['total_users'] = $dates['total_users']->merge( $widgets['total_usersdate'] );
        $dates['verified_users'] = $dates['verified_users']->merge( $widgets['verified_usersdate'] );
        $dates['email_unverified_users'] = $dates['email_unverified_users']->merge( $widgets['email_unverified_usersdate'] );
        //$dates['sms_unverified_users'] = $dates['sms_unverified_users']->merge( $widgets['sms_unverified_usersdate'] );

        // Monthly Deposit & Withdraw Report Graph
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);


        $cryptoCurrency = CryptoCurrency::count();

        // Build an array of the dates we want to show, oldest first
        $dates['cryptoCurrency'] = collect();
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['cryptoCurrency']->put( $date, 0);
        }

        // Get the post counts
        $cryptoCurrencydate = CryptoCurrency::where( 'created_at', '>=', $dates['cryptoCurrency']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
        $dates['cryptoCurrency'] = $dates['cryptoCurrency']->merge( $cryptoCurrencydate );

        $tradeLog['log'] = TradeLog::count();
        $tradeLog['wining'] = TradeLog::where('result', 1)->where('status', 1)->count();
        $tradeLog['losing'] = TradeLog::where('result', 2)->where('status', 1)->count();

        // Build an array of the dates we want to show, oldest first
        $dates['log'] = collect();
        $dates['wining'] = collect();
        $dates['losing'] = collect();

        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['log']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['wining']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['losing']->put( $date, 0);
        }

        // Get the post counts
        $tradeLog['logdate'] = TradeLog::where( 'created_at', '>=', $dates['log']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $tradeLog['winingdate'] = TradeLog::where('status', 1)->where('result', 1)->where( 'created_at', '>=', $dates['wining']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $tradeLog['losingdate'] = TradeLog::where('status', 1)->where('result', 2)->where( 'created_at', '>=', $dates['losing']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
        $dates['log'] = $dates['log']->merge( $tradeLog['logdate'] );
        $dates['wining'] = $dates['wining']->merge( $tradeLog['winingdate'] );
        $dates['losing'] = $dates['losing']->merge( $tradeLog['losingdate'] );


        $depositsMonth = Deposit::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();

        $depositsMonth->map(function ($aaa) use ($report) {
            $report['months']->push($aaa->months);
            $report['deposit_month_amount']->push(getAmount($aaa->depositAmount));
        });

        $withdrawalMonth = Withdrawal::whereYear('created_at', '>=', Carbon::now()->subYear())->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();
        $withdrawalMonth->map(function ($bb) use ($report){
            $report['withdraw_month_amount']->push(getAmount($bb->withdrawAmount));
        });

        // Withdraw Graph
        $withdrawal = Withdrawal::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)
            ->select(array(DB::Raw('sum(amount)   as totalAmount'), DB::Raw('DATE(created_at) day')))
            ->groupBy('day')->get();
        $withdrawals['per_day'] = collect([]);
        $withdrawals['per_day_amount'] = collect([]);
        $withdrawal->map(function ($a) use ($withdrawals) {
            $withdrawals['per_day']->push(date('d M', strtotime($a->day)));
            $withdrawals['per_day_amount']->push($a->totalAmount + 0);
        });

        // user Browsing, Country, Operating Log
        $user_login_data = UserLogin::whereDate('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);


        $payment['total_deposit_amount'] = Deposit::where('status',1)->sum('amount');
        $payment['total_deposit_charge'] = Deposit::where('status',1)->sum('charge');
        $payment['total_deposit_pending'] = Deposit::where('status',2)->count();
        $payment['total_deposit'] = Deposit::where('status',1)->count();

        $paymentWithdraw['total_withdraw_amount'] = Withdrawal::where('status',1)->sum('amount');
        $paymentWithdraw['total_withdraw'] = Withdrawal::where('status',1)->count();
        $paymentWithdraw['total_withdraw_charge'] = Withdrawal::where('status',1)->sum('charge');
        $paymentWithdraw['total_withdraw_pending'] = Withdrawal::where('status',2)->count();
        // Build an array of the dates we want to show, oldest first
        $dates['total_withdraw'] = collect();
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['total_withdraw']->put( $date, 0);
        }

        // Get the post counts
        $paymentWithdraw['total_withdrawdate'] = Withdrawal::where('status',1)->where( 'created_at', '>=', $dates['total_withdraw']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
        $dates['total_withdraw'] = $dates['total_withdraw']->merge( $paymentWithdraw['total_withdrawdate'] );

        // Build an array of the dates we want to show, oldest first
        $dates['total_withdraw_pending'] = collect();
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['total_withdraw_pending']->put( $date, 0);
        }

        // Get the post counts
        $paymentWithdraw['total_withdraw_pendingdate'] = Withdrawal::where('status',2)->where( 'created_at', '>=', $dates['total_withdraw_pending']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
        $dates['total_withdraw_pending'] = $dates['total_withdraw_pending']->merge( $paymentWithdraw['total_withdraw_pendingdate'] );

        /*$kyc['totalkyc'] = KYC::count();
        $kyc['pendingkyc'] = KYC::where('status','pending')->count();
        $kyc['missingkyc'] = KYC::where('status','missing')->count();
        $kyc['approvedkyc'] = KYC::where('status','approved')->count();

        // Build an array of the dates we want to show, oldest first
        $dates['totalkyc'] = collect();
        $dates['pendingkyc'] = collect();
        $dates['missingkyc'] = collect();
        $dates['approvedkyc'] = collect();

        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['totalkyc']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['pendingkyc']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['missingkyc']->put( $date, 0);
        }
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates['approvedkyc']->put( $date, 0);
        }

        // Get the post counts
        $kyc['totalkyc'] = KYC::where( 'created_at', '>=', $dates['totalkyc']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $kyc['pendingkyc'] = KYC::where('status','pending')->where( 'created_at', '>=', $dates['pendingkyc']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $kyc['missingkyc'] = KYC::where('status','missing')->where( 'created_at', '>=', $dates['missingkyc']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );
        $kyc['approvedkyc'] = KYC::where('status','approved')->where( 'created_at', '>=', $dates['approvedkyc']->keys()->first() )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                    ->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
        $dates['totalkyc'] = $dates['totalkyc']->merge( $kyc['totalkyc'] );
        $dates['pendingkyc'] = $dates['pendingkyc']->merge( $kyc['pendingkyc'] );
        $dates['missingkyc'] = $dates['missingkyc']->merge( $kyc['missingkyc'] );
        $dates['approvedkyc'] = $dates['approvedkyc']->merge( $kyc['approvedkyc'] );*/

        $latestUser = User::latest()->limit(5)->get();
        $api = new UpdateController;
        $res = $api->check_update();
        $empty_message = 'User Not Found';
                    return view('admin.dashboard', compact('page_title', 'widget','res','dates', 'report', 'withdrawals', 'chart','payment','paymentWithdraw','latestUser','empty_message','depositsMonth','withdrawalMonth', 'cryptoCurrency', 'tradeLog'/*,'kyc'*/));
    }

    public function api()
    {
        $page_title = "API";
        $user = User::user();
        return view('api.index', compact('page_title', 'user'));
    }

    public function clean()
    {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $notify[] = ['success', 'System Optimized'];
        return  back()->withNotify($notify);
    }

    public function notifications(){
        $notifications = AdminNotification::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $page_title = 'Notifications';
        return view('admin.notifications',compact('page_title','notifications'));
    }


    public function notificationRead($id){
        $notification = AdminNotification::findOrFail($id);
        $notification->read_status = 1;
        $notification->save();
        return redirect($notification->click_url);
    }


}
