<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Login
Route::post('oauth/access_token', function (Request $request) {
    $controller = new \App\Http\Controllers\Auth\LoginController();
    return $controller->login($request);
});

Route::group(['middleware' => ['auth:api','role:user']], function () {
	// // Files
	// Route::get('/files', 'FilesController@getIndex');
	// Route::post('files/upload', 'FilesController@postUpload');
	// Route::post('files/files-grid', 'FilesController@getFilesGrid');

	// // Debtors Article37
	// Route::post('/debtors-article37', 'DebtorsArticle37Controller@getDebtors');

	// // Illegal Use
	// Route::post('/illegal-use', 'DebtorsIllegalUseController@getDebtors');

	// // Debtors-DPF
	// Route::post('/debtors-dpf', 'DebtorsDPFController@getDebtors');

	// //Debtors
	// Route::post('/debtors', 'DebtorsController@getIndex');
	// Route::post('/debtors/excel-export', 'DebtorsController@excelExport');
	// Route::post('/debtors/word-export', 'DebtorsController@wordExport');

	// //Farming years
	// Route::get('common/farming-years', 'FarmingYearsController@getIndex');

	// //districts uploaded data log
	// Route::post('data-history/data-history-grid', 'DataHistoryController@getFilesGrid');
});