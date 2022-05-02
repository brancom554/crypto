<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\RssfeedController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('cron', 'CronController@index')->name('cron');
Route::get('cron/practice', 'CronController@practiceCron')->name('practice.cron');
Route::get('cron/crypto/price', 'CronController@store')->name('crypt.price');

Route::namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('paypal', 'paypal\ProcessController@ipn')->name('paypal');
    Route::get('paypal_sdk', 'paypal_sdk\ProcessController@ipn')->name('paypal_sdk');
    Route::post('perfect_money', 'perfect_money\ProcessController@ipn')->name('perfect_money');
    Route::post('stripe', 'stripe\ProcessController@ipn')->name('stripe');
    Route::post('stripe_js', 'stripe_js\ProcessController@ipn')->name('stripe_js');
    Route::post('stripe_v3', 'stripe_v3\ProcessController@ipn')->name('stripe_v3');
    Route::post('skrill', 'skrill\ProcessController@ipn')->name('skrill');
    Route::post('paytm', 'paytm\ProcessController@ipn')->name('paytm');
    Route::post('payeer', 'payeer\ProcessController@ipn')->name('payeer');
    Route::post('paystack', 'paystack\ProcessController@ipn')->name('paystack');
    Route::post('voguepay', 'voguepay\ProcessController@ipn')->name('voguepay');
    Route::get('flutterwave/{trx}/{type}', 'flutterwave\ProcessController@ipn')->name('flutterwave');
    Route::post('razorpay', 'razorpay\ProcessController@ipn')->name('razorpay');
    Route::post('instamojo', 'instamojo\ProcessController@ipn')->name('instamojo');
    Route::get('blockchain', 'blockchain\ProcessController@ipn')->name('blockchain');
    Route::get('blockio', 'blockio\ProcessController@ipn')->name('blockio');
    Route::post('coinpayments', 'coinpayments\ProcessController@ipn')->name('coinpayments');
    Route::post('coinpayments_fiat', 'coinpayments_fiat\ProcessController@ipn')->name('coinpayments_fiat');
    Route::post('coingate', 'coingate\ProcessController@ipn')->name('coingate');
    Route::post('coinbase_commerce', 'coinbase_commerce\ProcessController@ipn')->name('coinbase_commerce');
    Route::get('mollie', 'mollie\ProcessController@ipn')->name('mollie');
    Route::post('cashmaal', 'cashmaal\ProcessController@ipn')->name('cashmaal');
});

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});

Route::post('install', 'UpdateController@download_update')->name('install');

//Route::any('api/{any}', 'ViewController@app')->where('any','^(?!api).*$');

/*
|--------------------------------------------------------------------------
| Start Frontend Area
|--------------------------------------------------------------------------
*/

// Root route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('terms', [HomeController::class, 'terms'])->name('frontend.pages.terms');
Route::get('about', [HomeController::class, 'about'])->name('frontend.pages.about');
Route::post('/subscribe', 'SiteController@subscribe')->name('subscribe');
Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit')->name('contact.send');
Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholderImage');
//Route::get('/{slug}', 'SiteController@pages')->name('pages');

Route::group(['prefix' => config('blogetc.blog_prefix', 'blog'), 'namespace' => 'Blog'], static function () {
    Route::get('/', 'PostsController@index')->name('blogetc.index');
    Route::get('/search', 'PostsController@search')->name('blogetc.search');
    Route::get('/feed', 'BlogEtcRssFeedController@feed')->name('blogetc.feed');
    Route::get('/category/{categorySlug}', 'PostsController@showCategory')->name('blogetc.view_category');
    Route::get('/{blogPostSlug}', 'PostsController@show')->name('blogetc.single');

    Route::group(['middleware' => 'throttle:10,3'], static function () {
        Route::post('save_comment/{blogPostSlug}', 'CommentsController@store')->name('blogetc.comments.add_new_comment');
    });
});

/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/

Route::get('lang/{locale}', 'LanguageController@swap');

require_once __DIR__ . '/jetstream.php';
require_once __DIR__ . '/fortify.php';

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'verified', 'role:user', 'prefix' => 'user', 'as' => 'user.'], function() {

        // Dashboard
        Route::get('dashboard/trade', 'UserController@dash')->middleware('checkKYC')->name('home.trade');
        Route::get('dashboard/practice', 'UserController@practiceDash')->name('home.practice');
        //Route::get('dashboard1', 'UserController@home1')->name('home1');
        Route::get('dashboard', 'UserController@home')->name('home');
        Route::get('market', 'UserController@marketr')->name('market.redirect');


        // Wallet
        Route::get('dashboard/exchange', 'ExchangeController@home')->name('home.exchange');
        Route::get('/wallets', 'WalletController@index')->name('wallet.index');
        Route::post('/wallet/create', 'WalletController@createWallet')->name('wallet.create');

        //Watchlist
        Route::get('crypto/watchlists', [WatchlistController::class, 'index'])->name('watchlists');
        Route::post('crypto/watchlist/store', [WatchlistController::class, 'store'])->name('watchlist.store');
        Route::post('crypto/watchlist/delete', [WatchlistController::class, 'delete'])->name('watchlist.delete');

        //News
        Route::get('news', [RssfeedController::class, 'index'])->name('news');

        //KYC
        Route::get('/kyc', 'User\KycController@index')->name('kyc');
        Route::get('/kyc/application', 'User\KycController@application')->name('kyc.application');
        Route::get('/kyc/application/view', 'User\KycController@view')->name('kyc.application.view');
        Route::post('/kyc/submit', 'User\KycController@submit')->name('kyc.submit');

        // Transactions
        Route::get('transaction/history', 'UserController@transactionHistory')->name('transaction.log');
        Route::get('commissions/history', 'UserController@commissions')->name('commissions.log');
        Route::get('referral/log', 'UserController@referralog')->name('referralog.log');

        // Trade
        Route::get('crypto/rate', 'TradeController@btcRate')->name('crypto.rate');
        Route::group(['middleware' => 'checkKYC', 'prefix' => 'trade', 'as' => 'trade.'], function() {
            Route::get('/', 'TradeController@index')->middleware('checkKYC')->name('index');
            Route::get('{symbol}/{pair}', 'TradeController@trade')->middleware('checkKYC')->name('now');
            Route::post('store', 'TradeController@store')->name('store');
            Route::post('result', 'TradeController@tradeResult')->name('result');

            Route::get('contracts', 'TradeController@tradeContract')->middleware('checkKYC')->name('contract.log');
            Route::get('contract/{tradeLogId}', 'TradeController@ContractChart')->middleware('checkKYC')->name('contract.log.preview');
            Route::get('wining/contracts', 'TradeController@winingTradeContract')->middleware('checkKYC')->name('wining.contract.log');
            Route::get('losing/contracts', 'TradeController@losingTradeContract')->middleware('checkKYC')->name('losing.contract.log');
            Route::get('draw/contracts', 'TradeController@drawTradeContract')->middleware('checkKYC')->name('draw.contract.log');
            Route::get('market', [MarketController::class, 'index'])->name('market');
        });

        // Exchange
        Route::group(['middleware' => 'checkKYC', 'prefix' => 'exchange', 'as' => 'exchange.'], function() {
            Route::get('/', 'ExchangeController@index')->middleware('checkKYC')->name('index');
            Route::get('{symbol}/{pair}', 'ExchangeController@exchange')->middleware('checkKYC')->name('now');
            Route::post('store', 'ExchangeController@store')->name('store');
            Route::get('contracts', 'ExchangeController@exchangeLog')->middleware('checkKYC')->name('exchange.log');
            Route::get('market', [MarketController::class, 'index'])->name('market');
        });

        // Practice
        Route::group(['prefix' => 'practice', 'as' => 'practice.'], function() {
            Route::get('crypto/rate', 'PracticeController@btcRate')->name('crypto.rate');
            Route::get('/', 'PracticeController@index')->name('index');
            Route::get('{symbol}/{pair}', 'PracticeController@trade')->name('now');
            Route::post('exchange', 'PracticeController@exchange')->name('exchange');
            Route::post('store', 'PracticeController@store')->name('store');
            Route::post('result', 'PracticeController@tradeResult')->name('result');
            Route::get('contracts', 'PracticeController@practiceLog')->name('contract.log');
            Route::get('contract/{tradeLogId}', 'PracticeController@practiceLogChart')->name('contract.log.preview');
            Route::get('market', [MarketController::class, 'index'])->name('market');
        });
        Route::post('/add/practice/balance', 'UserController@addPracticeBalance')->name('add.practice.balance');

        // Deposit
        Route::any('/deposit', 'Gateway\PaymentController@deposit')->middleware('checkKYC')->name('deposit');
        Route::post('deposit/insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert');
        Route::get('deposit/preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview');
        Route::get('deposit/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');
        Route::get('deposit/manual', 'Gateway\PaymentController@manualDepositConfirm')->name('deposit.manual.confirm');
        Route::post('deposit/manual', 'Gateway\PaymentController@manualDepositUpdate')->name('deposit.manual.update');
        Route::get('deposit/history', 'UserController@depositHistory')->name('deposit.history');

        // Withdraw
        Route::get('/withdraw', 'UserController@withdrawMoney')->middleware('checkKYC')->name('withdraw');
        Route::post('/withdraw', 'UserController@withdrawStore')->name('withdraw.money');
        Route::get('/withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
        Route::post('/withdraw/preview', 'UserController@withdrawSubmit')->name('withdraw.submit');
        Route::get('/withdraw/history', 'UserController@withdrawLog')->name('withdraw.history');

    });
    Route::group(['middleware' => 'role:admin,demo', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('market', [MarketController::class, 'index'])->name('market');
        Route::get('api-tokens', 'AdminController@api')->name('api.index');
        Route::get('/clear', 'AdminController@clean')->name('clean')->middleware('demo');
        Route::match(array('GET','POST'),'update', 'UpdateController@index')->name('update')->middleware('demo');

        Route::get('notification/read/{id}','AdminController@notificationRead')->name('notification.read');
        Route::get('notifications','AdminController@notifications')->name('notifications');

        // Users Manager
        Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
        Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
        Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
        Route::get('users/email-verified', 'ManageUsersController@emailVerifiedUsers')->name('users.emailVerified');
        Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
        Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
        Route::get('users/sms-verified', 'ManageUsersController@smsVerifiedUsers')->name('users.smsVerified');

        Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
        Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
        Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update')->middleware('demo');
        Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance')->middleware('demo');
        Route::get('user/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
        Route::post('user/send-email/{id}', 'ManageUsersController@sendEmailSingle')->middleware('demo');
        Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
        Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
        Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageUsersController@depViaMethod')->name('users.deposits.method');
        Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
        Route::get('user/withdrawals/via/{method}/{type?}/{userId}', 'ManageUsersController@withdrawalsViaMethod')->name('users.withdrawals.method');

        Route::post('/wallet/create', '\App\Http\Controllers\WalletController@admincreateWallet')->name('wallet.create');

         Route::get('user/practice/trade/{id}', 'ManageUsersController@practiceLog')->name('users.practice.log');
         Route::get('user/trade/traded/{id}', 'ManageUsersController@traded')->name('users.traded');
         Route::get('user/trade/wining/{id}', 'ManageUsersController@wining')->name('users.wining');
         Route::get('user/trade/losing/{id}', 'ManageUsersController@losing')->name('users.losing');
         Route::get('user/trade/draw/{id}', 'ManageUsersController@draw')->name('users.draw');

        // Login History
        Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');
        Route::get('users/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
        Route::post('users/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.send')->middleware('demo');
        Route::get('users/referral/log/{id}', 'ManageUsersController@referralLog')->name('users.referral.log');
        Route::get('users/commission/log/{id}', 'ManageUsersController@commissionLog')->name('users.commission.log');

        // Crypto Currency Manage
        Route::get('crypto/currency/list', 'CryptoCurrencyController@index')->name('crypto.index');
        Route::post('crypto/currency/store', 'CryptoCurrencyController@store')->name('crypto.store')->middleware('demo');
        Route::post('crypto/currency/update', 'CryptoCurrencyController@update')->name('crypto.update')->middleware('demo');
        Route::post('crypto/currency/delete', 'CryptoCurrencyController@delete')->name('crypto.delete')->middleware('demo');

        // Crypto Pair Manage
        Route::get('crypto/pair/list', 'CryptoPairController@index')->name('crypto.pair.index');
        Route::post('crypto/pair/store', 'CryptoPairController@store')->name('crypto.pair.store')->middleware('demo');
        Route::post('crypto/pair/update', 'CryptoPairController@update')->name('crypto.pair.update')->middleware('demo');
        Route::post('crypto/pair/delete', 'CryptoPairController@delete')->name('crypto.pair.delete')->middleware('demo');

        // Trade Log Manage
        Route::get('trade/log', 'TradeLogController@index')->name('trade.log.list');
        Route::get('wining/trade/log', 'TradeLogController@wining')->name('trade.log.wining');
        Route::get('losing/trade/log', 'TradeLogController@losing')->name('trade.log.losing');
        Route::get('draw/trade/log', 'TradeLogController@draw')->name('trade.log.draw');
        Route::get('trade/{scope}/search', 'TradeLogController@search')->name('trade.log.search');


        //PracticeTrade
        Route::get('practice/trade/log', 'PracticeTradeController@index')->name('practice.log.list');
        Route::get('practice/wining/trade/log', 'PracticeTradeController@wining')->name('practice.log.wining');
        Route::get('practice/losing/trade/log', 'PracticeTradeController@losing')->name('practice.log.losing');
        Route::get('practice/draw/trade/log', 'PracticeTradeController@draw')->name('practice.log.draw');
        Route::get('practice/trade/{scope}/search', 'PracticeTradeController@search')->name('practice.log.search');


        // Subscriber
        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove')->middleware('demo');
        Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->middleware('demo');


        // Deposit Gateway
        Route::name('gateway.')->prefix('gateway')->group(function(){
            // Automatic Gateway
            Route::get('automatic', 'GatewayController@index')->name('automatic.index');
            Route::get('automatic/edit/{alias}', 'GatewayController@edit')->name('automatic.edit');
            Route::post('automatic/update/{code}', 'GatewayController@update')->name('automatic.update')->middleware('demo');
            Route::post('automatic/remove/{code}', 'GatewayController@remove')->name('automatic.remove')->middleware('demo');
            Route::post('automatic/activate', 'GatewayController@activate')->name('automatic.activate')->middleware('demo');
            Route::post('automatic/deactivate', 'GatewayController@deactivate')->name('automatic.deactivate')->middleware('demo');

            // Manual Methods
            Route::get('manual', 'ManualGatewayController@index')->name('manual.index');
            Route::get('manual/new', 'ManualGatewayController@create')->name('manual.create');
            Route::post('manual/new', 'ManualGatewayController@store')->name('manual.store')->middleware('demo');
            Route::get('manual/edit/{alias}', 'ManualGatewayController@edit')->name('manual.edit');
            Route::post('manual/update/{id}', 'ManualGatewayController@update')->name('manual.update')->middleware('demo');
            Route::post('manual/activate', 'ManualGatewayController@activate')->name('manual.activate')->middleware('demo');
            Route::post('manual/deactivate', 'ManualGatewayController@deactivate')->name('manual.deactivate')->middleware('demo');
        });


        // DEPOSIT SYSTEM
        Route::name('deposit.')->prefix('deposit')->group(function(){
            Route::get('/', 'DepositController@deposit')->name('list');
            Route::get('pending', 'DepositController@pending')->name('pending');
            Route::get('rejected', 'DepositController@rejected')->name('rejected');
            Route::get('approved', 'DepositController@approved')->name('approved');
            Route::get('successful', 'DepositController@successful')->name('successful');
            Route::get('details/{id}', 'DepositController@details')->name('details');

            Route::post('reject', 'DepositController@reject')->name('reject')->middleware('demo');
            Route::post('approve', 'DepositController@approve')->name('approve')->middleware('demo');
            Route::get('via/{method}/{type?}', 'DepositController@depViaMethod')->name('method');
            Route::get('/{scope}/search', 'DepositController@search')->name('search');
            Route::get('date-search/{scope}', 'DepositController@dateSearch')->name('dateSearch');

        });


        // WITHDRAW SYSTEM
        Route::name('withdraw.')->prefix('withdraw')->group(function(){
            Route::get('pending', 'WithdrawalController@pending')->name('pending');
            Route::get('approved', 'WithdrawalController@approved')->name('approved');
            Route::get('rejected', 'WithdrawalController@rejected')->name('rejected');
            Route::get('log', 'WithdrawalController@log')->name('log');
            Route::get('via/{method_id}/{type?}', 'WithdrawalController@logViaMethod')->name('method');
            Route::get('{scope}/search', 'WithdrawalController@search')->name('search');
            Route::get('date-search/{scope}', 'WithdrawalController@dateSearch')->name('dateSearch');
            Route::get('details/{id}', 'WithdrawalController@details')->name('details');
            Route::post('approve', 'WithdrawalController@approve')->name('approve')->middleware('demo');
            Route::post('reject', 'WithdrawalController@reject')->name('reject')->middleware('demo');


            // Withdraw Method
            Route::get('method/', 'WithdrawMethodController@methods')->name('method.index');
            Route::get('method/create', 'WithdrawMethodController@create')->name('method.create');
            Route::post('method/create', 'WithdrawMethodController@store')->name('method.store')->middleware('demo');
            Route::get('method/edit/{id}', 'WithdrawMethodController@edit')->name('method.edit');
            Route::post('method/edit/{id}', 'WithdrawMethodController@update')->name('method.update')->middleware('demo');
            Route::post('method/activate', 'WithdrawMethodController@activate')->name('method.activate')->middleware('demo');
            Route::post('method/deactivate', 'WithdrawMethodController@deactivate')->name('method.deactivate')->middleware('demo');
        });

        // Report
        Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
        Route::get('report/commission', 'ReportController@commission')->name('report.commission');
        Route::get('report/commission/search', 'ReportController@commissionSearch')->name('report.commission.search');
        Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');
        Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
        Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');

        // Admin Support
        Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
        Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
        Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
        Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
        Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
        Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply')->middleware('demo');
        Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete')->middleware('demo');

        // Language Manager
        /* Route::get('/language', 'LanguageController@langManage')->name('language.manage');
        Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
        Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
        Route::post('/language/update/{id}', 'LanguageController@langUpdatepp')->name('language.manage.update');
        Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
        Route::post('/language/import', 'LanguageController@langImport')->name('language.import_lang');


        Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
        Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
        Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key'); */

        // General Setting
        Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update')->middleware('demo');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo_icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo_icon_update')->middleware('demo');

        // Plugin
        Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
        Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update')->middleware('demo');
        Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate')->middleware('demo');
        Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate')->middleware('demo');

        // SMS Setting
        /*Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms.template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.global_update');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.sendTestSMS');*/

        // SEO
        Route::get('seo', [HomeController::class, 'seoEdit'])->name('seo');
        Route::post('frontend-content/{key}', [HomeController::class, 'frontendContent'])->name('seo.content')->middleware('demo');


        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {
            Route::get('/home', [HomeController::class, 'list'])->name('home');
            Route::get('/about', [HomeController::class, 'list'])->name('about');
            Route::get('/contact', [HomeController::class, 'list'])->name('contact');
            Route::post('/update', [HomeController::class, 'update'])->name('update')->middleware('demo');
        });

        /* Admin backend routes - CRUD for posts, categories, and approving/deleting submitted comments */
        Route::group(['prefix' => config('blogetc.admin_prefix', 'blog_admin')], static function () {
            Route::get('/', 'ManagePostsController@index')->name('blogetc.admin.index');

            Route::get('/add_post', 'ManagePostsController@create')->name('blogetc.admin.create_post');
            Route::post('/add_post', 'ManagePostsController@store')->name('blogetc.admin.store_post')->middleware('demo');

            Route::get('/edit_post/{blogPostId}', 'ManagePostsController@edit')->name('blogetc.admin.edit_post');
            Route::patch('/edit_post/{blogPostId}', 'ManagePostsController@update')->name('blogetc.admin.update_post');

            Route::group(['prefix' => 'image_uploads'], static function () {
                Route::get('/', 'ManageUploadsController@index')->name('blogetc.admin.images.all');

                Route::get('/upload', 'ManageUploadsController@create')->name('blogetc.admin.images.upload');
                Route::post('/upload', 'ManageUploadsController@store')->name('blogetc.admin.images.store')->middleware('demo');

                Route::get('/post/{postId}/delete-images', 'ManageUploadsController@deletePostImage')->name('blogetc.admin.images.delete-post-image');
                Route::delete('/post/{postId}/delete-images', 'ManageUploadsController@deletePostImageConfirmed')->name('blogetc.admin.images.delete-post-image-confirmed');
            });

            Route::delete('/delete_post/{blogPostId}', 'ManagePostsController@destroy')->name('blogetc.admin.destroy_post');

            Route::group(['prefix' => 'comments'], static function () {
                Route::get('/', 'ManageCommentsController@index')->name('blogetc.admin.comments.index');
                Route::patch('/{commentId}', 'ManageCommentsController@approve')->name('blogetc.admin.comments.approve');

                Route::delete('/{commentId}', 'ManageCommentsController@destroy')->name('blogetc.admin.comments.delete');
            });

            Route::group(['prefix' => 'categories'], static function () {
                Route::get('/', 'ManageCategoriesController@index')->name('blogetc.admin.categories.index');

                Route::get('/add_category', 'ManageCategoriesController@create')->name('blogetc.admin.categories.create_category');
                Route::post('/add_category', 'ManageCategoriesController@store')->name('blogetc.admin.categories.store_category')->middleware('demo');

                Route::get('/edit_category/{categoryId}', 'ManageCategoriesController@edit')->name('blogetc.admin.categories.edit_category');
                Route::patch('/edit_category/{categoryId}', 'ManageCategoriesController@update')->name('blogetc.admin.categories.update_category');

                Route::delete('/delete_category/{categoryId}', 'ManageCategoriesController@destroy')->name('blogetc.admin.categories.destroy_category');
            });
        });

        //KYC
        Route::get('/kyc-list/{status?}', 'KycController@index')->name('kycs');
        Route::get('/kyc/view/{id}/{type}', 'KycController@show')->name('kyc.view');
        Route::post('/kyc/view', 'KycController@ajax_show')->name('kyc.ajax_show');
        Route::post('/kyc/update', 'KycController@update')->name('kyc.update')->middleware('demo');
        Route::post('/kyc/delete', 'KycController@delete')->name('kyc.delete')->middleware('demo');

        Route::get('/settings/email', 'EmailSettingController@index')->name('settings.email');
        Route::post('/users/email/send', 'UsersController@send_email')->name('users.email')->middleware('demo');
        Route::post('/settings/email/template/view', 'EmailSettingController@show_template')->name('settings.email.template.view');
        Route::post('/settings/email/update', 'EmailSettingController@update')->name('settings.email.update')->middleware('demo');
        Route::post('/settings/email/template/update', 'EmailSettingController@update_template')->name('settings.email.template.update')->middleware('demo');

    });
});
