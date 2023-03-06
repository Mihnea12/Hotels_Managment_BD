<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();
Route::get('/tables/{nameTable}','App\Http\Controllers\ViewTableController@showTable')->name('table');
Route::get('/tables','App\Http\Controllers\ViewTableController@show');

Route::get('/edit','App\Http\Controllers\EditTableController@show_edit');
Route::get('/edit/{nameTable}','App\Http\Controllers\EditTableController@showTable_edit')->name('edit');
Route::post('/edit/Camere/save','App\Http\Controllers\EditTableController@saveInfoCamere')->name('saveCamere');
Route::post('/edit/CamereUnitate/save','App\Http\Controllers\EditTableController@saveInfoCamereUnitate')->name('saveCamereUnitate');
Route::post('/edit/Clienti/save','App\Http\Controllers\EditTableController@saveInfoClienti')->name('saveClienti');
Route::post('/edit/Rezervari/save','App\Http\Controllers\EditTableController@saveInfoRezervari')->name('saveRezervari');
Route::post('/edit/TipUnitate/save','App\Http\Controllers\EditTableController@saveInfoTipUnitate')->name('saveTipUnitate');
Route::post('/edit/UnitateCazare/save','App\Http\Controllers\EditTableController@saveInfoUnitateCazare')->name('saveUnitateCazare');
Route::post('/edit/PachetRezervare/save','App\Http\Controllers\EditTableController@saveInfoPachetRezervare')->name('savePachetRezervare');
Route::post('/edit/PachetRezervare/delete','App\Http\Controllers\EditTableController@deleteInfoPachetRezervare')->name('deletePachetRezervare');
Route::post('/edit/TipUnitate/delete','App\Http\Controllers\EditTableController@deleteInfoTipUnitate')->name('deleteTipUnitate');
Route::post('/edit/Rezervari/delete','App\Http\Controllers\EditTableController@deleteInfoRezervari')->name('deleteRezervari');
Route::post('/edit/Clienti/delete','App\Http\Controllers\EditTableController@deleteInfoClienti')->name('deleteClienti');
Route::post('/edit/CamereUnitate/delete','App\Http\Controllers\EditTableController@deleteInfoCamereUnitate')->name('deleteCamereUnitate');
Route::post('/edit/Camere/delete','App\Http\Controllers\EditTableController@deleteInfoCamere')->name('deleteCamere');
Route::post('/edit/UnitateCazare/delete','App\Http\Controllers\EditTableController@deleteinfoUnitateCazare')->name('deleteUnitateCazare');

Route::get('/edit/{arg}/add','App\Http\Controllers\EditTableController@showAddRow');
Route::post('/edit/Camere/add/save','App\Http\Controllers\EditTableController@saveCamereRow');
Route::post('/edit/TipUnitate/add/save','App\Http\Controllers\EditTableController@saveTipUnitateRow');
Route::post('/edit/UnitateCazare/add/save','App\Http\Controllers\EditTableController@saveUnitateCazareRow');
Route::post('/edit/CamereUnitate/add/save','App\Http\Controllers\EditTableController@saveCamereUnitateRow');
Route::post('/edit/PachetRezervare/add/save','App\Http\Controllers\EditTableController@savePachetRezervareRow');
Route::post('/edit/Rezervari/add/save','App\Http\Controllers\EditTableController@saveRezervariRow');
Route::post('/edit/Clienti/add/save','App\Http\Controllers\EditTableController@saveClientiRow');

Route::get('/Cazare+Pachete','App\Http\Controllers\ViewTableController@pacheteCazari');
Route::post('/Cazare+Pachete/search','App\Http\Controllers\ViewTableController@searchPacheteCazari');

Route::get('/UnitatiCazare','App\Http\Controllers\ViewTableController@UnitatiCazare');
Route::post('/UnitatiCazare/search','App\Http\Controllers\ViewTableController@searchUnitatiCazare');

Route::get('/Camere','App\Http\Controllers\ViewTableController@Camere');

Route::get('/Clienti','App\Http\Controllers\ViewTableController@Clienti');
Route::post('/Clienti/search','App\Http\Controllers\ViewTableController@searchClienti');

Route::get('/StatisticiUnitati','App\Http\Controllers\ViewTableController@statisticiUnitatiCamere');
Route::post('/StatisticiUnitati/search','App\Http\Controllers\ViewTableController@searchstatisticiUnitatiCamere');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
