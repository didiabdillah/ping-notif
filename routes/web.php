<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

Route::get('/', function () {
	return redirect('login');
});

Auth::routes();


Route::get('/cronjob', 'User\WAbillingController@cronjob');
Route::get('/send-wa', 'User\WAController@sendwa');

Route::get('/ceksession', 'WAController@ceksession');
Route::post('/api-whatsapp', 'User\WAController@apiwhatsapp');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/send_email', 'EmailController@send_email');

	Route::group(['middleware' => 'MasaAktifMiddleware'], function () {
		Route::group(['namespace' => 'User'], function () {
			Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
			Route::get('/profile', 'ProfileController@index')->name('profile');
			Route::post('/profile/simpan', 'ProfileController@simpan')->name('simpanprofile');

			//user
			Route::get('/user', 'UserController@index')->name('user');
			Route::get('/user/tambah', 'UserController@tambah')->name('tambahuser');
			Route::get('/user/tambah/{id_wa}', 'UserController@tambah')->name('tambahuser');
			Route::post('/user/simpan', 'UserController@simpan')->name('simpanuser');
			Route::get('/user/edit/{id}', 'UserController@edit')->name('edituser');
			Route::post('/user/edit/simpan', 'UserController@simpanedit')->name('simpanedituser');
			Route::post('/user/hapus', 'UserController@hapus')->name('hapususer');

			//wa
			Route::get('/whatsapp', 'WAController@index')->name('whatsapp');
			// Route::get('/whatsapp/configurasi', 'WAController@tambah')->name('tambahwa');
			Route::get('/whatsapp/configurasi/{id_wa}', 'WAController@tambah')->name('tambahwa');
			Route::post('/whatsapp/edit/simpan', 'WAController@simpanedit')->name('simpaneditwa');
			Route::post('/whatsapp/hapus', 'WAController@hapus')->name('hapuswa');
			Route::get('/cek-whatsapp/{id_wa}', 'WAController@cek_wa');
			Route::post('/delete-no-wa', 'WAController@delete_no_wa')->name('delete_no_wa');
			// domain
			Route::get('/whatsapp/detail/{no_hp}', 'WAController@whatsappdetail');
			Route::post('/simpan-domain', 'WAController@simpandomain')->name('simpandomain');
			Route::post('/delete-Domain', 'WAController@deleteDomain')->name('deleteDomain');

			Route::get('/pesan-otomatis', 'OtomatisController@pesanotomatis');
			Route::post('/simpan-pesan-otomatis', 'OtomatisController@simpan_pesan_otomatis')->name('simpan_pesan_otomatis');

			Route::post('/save-no-wa', 'WAController@save_no_wa')->name('save_no_wa');
			Route::post('/save-session-whatsapp', 'WAController@savesessionwa');
			Route::post('/get-session', 'WAController@getsession');
			Route::post('/hapus-sesi', 'WAController@hapussesi');
			Route::post('/kirim-wa-manual', 'WAController@kirim_wa_manual')->name('kirim_wa_manual');

			Route::get('/billing', 'WAbillingController@billing')->name('billing');
			Route::post('/tambahkan-paket', 'WAbillingController@simpan_paket')->name('simpan_paket');
			Route::post('/tambahkan-saldo', 'WAbillingController@tambahkan_saldo')->name('simpan_saldo');
			Route::post('/history-billing', 'WAbillingController@load_history')->name('load_history');
			Route::post('/simpan-konfirmasi', 'WAbillingController@simpan_konfirmasi')->name('simpan_konfirmasi');
			Route::post('/perpanjang-konfirmasi', 'WAbillingController@perpanjang_konfirmasi')->name('perpanjang_konfirmasi');

			$date_url 				= md5('apppingnotif');
			Route::post($date_url, 'WAbillingController@notifikasi')->name('notifikasi');
			Route::get('/billing/{invoice}', 'WAbillingController@detail_billing');

			//sms
			// Route::get('/sms', 'SMSController@index')->name('sms');
			// Route::get('/sms/tambah', 'SMSController@tambah')->name('tambahsms');
			// Route::post('/sms/simpan', 'SMSController@simpan')->name('simpansms');
			// Route::get('/sms/edit/{id}', 'SMSController@edit')->name('editsms');
			// Route::post('/sms/edit/simpan', 'SMSController@simpanedit')->name('simpaneditsms');
			// Route::post('/sms/hapus', 'SMSController@hapus')->name('hapussms');

			//dokumentasi-api
			Route::get('/dokumentasi-api', 'WAController@dokumentasiapi');

			//tambahan saldo
			Route::get('/tambah-saldo-manual/{id_his}', 'WAbillingController@tambahsaldomanual');
		});
	});
	// super_admin
	Route::group(['middleware' => 'superAdminfMiddleware'], function () {
		Route::group(['namespace' => 'User'], function () {
			$date_url 				= Carbon\Carbon::now()->format('YMD');
			$date_url 				= md5($date_url . 'apppingnotif');
			Route::get($date_url, 'SuperAdminController@index')->name('super_admin');
			Route::get($date_url . '/billing', 'SuperAdminController@billing')->name('super_admin_billing');
			Route::get($date_url . '/konfirmasi', 'SuperAdminController@konfirmasi')->name('super_admin_konfirmasi');
			Route::post($date_url . '/detail_user', 'SuperAdminController@detail_user')->name('detail_user');
			Route::post($date_url . '/konfirmasi-manual', 'SuperAdminController@konfirmasi_manual')->name('konfirmasi_manual');
		});
	});
});



Route::group(['prefix' => 'superadmin'], function () {
	Route::get('logout', 'SuperAdmin\SuperAdminAuthController@logout')->name('superadmin_logout');

	Route::group(['middleware' => 'loginSuperAdmin'], function () {
		Route::get('dashboard', 'SuperAdmin\SuperAdminDashboardController@index')->name('superadmin_dashboard');
		Route::get('grafik', 'SuperAdmin\SuperAdminDashboardController@grafik_data')->name('superadmin_grafik');
	});

	Route::group(['middleware' => 'notLoginSuperAdmin'], function () {
		Route::get('login', 'SuperAdmin\SuperAdminAuthController@index');
		Route::post('login', 'SuperAdmin\SuperAdminAuthController@login')->name('superadmin_login');
	});
});

Route::group(['prefix' => 'test'], function () {
	Route::get('dashboard', function () {
		return view('under_construction/dashboard/dashboard');
	});
	Route::get('pengguna', function () {
		return 'pengguna';
	});
	Route::get('pengguna', function () {
		return 'pengguna';
	});
	Route::get('pengguna', function () {
		return 'pengguna';
	});
	Route::get('setting', 'SuperAdmin\AdminSuperController@index')->name('superadmin_setting');
});
