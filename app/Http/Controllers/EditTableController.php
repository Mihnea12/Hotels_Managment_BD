<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EditTableController extends Controller
{
    public function show_edit()
    {
        $user = auth()->user();
        $user = $user->name;
        $userType = DB::select('SELECT UserType FROM users WHERE name = ?', [$user]);
        $userType = $userType[0]->UserType;

        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);
        return view('edit_table')->with('result', $tables)->with('userType', $userType);
    }

    public function showTable_edit($nameTable)
    {
        $infoNumeUnitate = DB::select('SELECT * FROM UnitateCazare');
        $numereCamere = DB::select('SELECT * FROM Camere');
        $numePachete = DB::select('SELECT * FROM PachetRezervare');
        $numeTip = DB::select('SELECT * FROM TipUnitate');

        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);
        $columns = DB::select(DB::raw("DESC $nameTable "));
        //return DB::select(DB::raw("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_NAME ='$nameTable' AND COLUMN_NAME NOT LIKE '%ID'"));
        $result = DB::select(DB::raw("SELECT * FROM $nameTable"));
        return view('showEditTable')->with('result', $tables)->with('info', $result)->with('columns', $columns)->with('info1', $infoNumeUnitate)->with('info2', $numereCamere)->with('info3', $numePachete)->with('info4', $numeTip);

    }

    public function saveInfoCamere(Request $request)
    {

            $etaj = $request->input('Etaj');
            $numarcamera = $request->input('NumarCamera');
            $cameraid = $request->input('CameraID');
            DB::update('UPDATE Camere SET Etaj = ?, NumarCamera = ? WHERE CameraID = ?', [$etaj, $numarcamera, $cameraid]);
            return redirect()->back();
            //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveInfoCamereUnitate(Request $request)
    {
        $unitateid = $request->input('UnitateID');
        $unitateid = DB::select('SELECT UnitateID FROM UnitateCazare WHERE NumeUnitate = ?',[$unitateid]);

        $cameraid = $request->input('CameraID');
        $cameraid  = DB::select('SELECT CameraID FROM Camere WHERE NumarCamera = ?',[$cameraid]);

        $numetipcamera = $request->input('NumeTipCamera');
        DB::update('UPDATE CamereUnitate SET  NumeTipCamere = ? WHERE CameraID = ? AND UnitateID = ? ', [$numetipcamera, $cameraid[0]->CameraID, $unitateid[0]->UnitateID]);
        DB::update('UPDATE CamereUnitate SET  UnitateID = ? WHERE CameraID = ? AND NumeTipCamere = ? ', [$unitateid[0]->UnitateID, $cameraid[0]->CameraID,$numetipcamera]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveInfoClienti(Request $request)
    {
        $clientid = $request->input('ClientID');
        $prenume = $request->input('Prenume');
        $nume = $request->input('Nume');
        $adresa = $request->input('Adresa');
        $localitate = $request->input('Localitate');
        $telefon = $request->input('Telefon');
        $rezervareid = $request->input('RezervareID');
        DB::update('UPDATE Clienti SET Nume = ?, Prenume = ?, Adresa = ?, Localitate = ?, Telefon = ? WHERE ClientID = ?', [$nume, $prenume, $adresa, $localitate, $telefon, $clientid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveInfoRezervari(Request $request)
    {
        $rezervareid = $request->input('RezervareID');
        $pachetid = $request->input('PachetID');
        try {
            $pachetid = DB::select('SELECT PachetID FROM PachetRezervare WHERE NumePachet = ?', [$pachetid]);
            $pretNoapte = DB::select('SELECT PretNoapte FROM PachetRezervare WHERE PachetID = ?',[$pachetid[0]->PachetID]);
            $numarNopti = DB::select('SELECT NumarNoptiCazare FROM PachetRezervare WHERE PachetID = ?',[$pachetid[0]->PachetID]);



        } catch (Exception $ex){

            return  back();
        }

        $datarezervare = $request->input('DataRezervare');
        $datasosire = $request->input('DataSosire');
        $prettotal = $request->input('PretTotal');
        $avans = $request->input('Avans');
        $cameraid = $request->input('CameraID');

        $prettotal = $numarNopti[0]->NumarNoptiCazare * $pretNoapte[0]->PretNoapte;
        $avans = $prettotal / 2;

        $cameraid = DB::select('SELECT CameraID FROM Camere WHERE NumarCamera = ?', [$cameraid]);
        DB::update('UPDATE Rezervari SET PachetID = ?, DataRezervare = ?, DataSosire = ?, PretTotal = ?, Avans = ?, CameraID = ? WHERE RezervareID = ?', [$pachetid[0]->PachetID, $datarezervare, $datasosire, $prettotal, $avans, $cameraid[0]->CameraID, $rezervareid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveinfoTipUnitate(Request $request)
    {
        $tipid = $request->input('TipID');
        $numetip = $request->input('NumeTip');

        DB::update('UPDATE TipUnitate SET NumeTip = ? WHERE TipID = ?', [$numetip, $tipid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveinfoUnitateCazare(Request $request)
    {
        $unitateid = $request->input('UnitateID');


        $tipunitateid = $request->input('TipUnitateID');
        $tipunitateid = DB::select('SELECT TipID FROM TipUnitate WHERE NumeTip = ?', [$tipunitateid]);

        $numeunitate = $request->input('NumeUnitate');
        $adresa = $request->input('Adresa');
        $codpostal = $request->input('CodPostal');

        DB::update('UPDATE UnitateCazare SET TipUnitateID = ?, NumeUnitate = ?, Adresa = ?, CodPostal = ? WHERE UnitateID = ?', [$tipunitateid[0]->TipID, $numeunitate, $adresa, $codpostal, $unitateid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveinfoPachetRezervare(Request $request)
    {
        $pachetid = $request->input('PachetID');
        $numepachet = $request->input('NumePachet');

        $unitateid = $request->input('UnitateID');
        $unitateid = DB::select('SELECT UnitateID FROM UnitateCazare WHERE NumeUnitate = ?', [$unitateid]);

        $transport = $request->input('Transport');
        $numarpersoane = $request->input('NumarPersoane');
        $numarnopticazare = $request->input('NumarNoptiCazare');
        $pretnoapte = $request->input('PretNoapte');



        DB::update('UPDATE PachetRezervare SET UnitateID = ?, Transport = ?, NumarPersoane = ?, NumarNoptiCazare = ?, PretNoapte = ?, NumePachet = ? WHERE PachetID = ?', [$unitateid[0]->UnitateID, $transport, $numarpersoane, $numarnopticazare, $pretnoapte, $numepachet, $pachetid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function deleteinfoPachetRezervare(Request $request)
    {
        $pachetid = $request->input('PachetID');

        DB::delete('DELETE FROM PachetRezervare WHERE PachetID = ?',[$pachetid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function deleteinfoTipUnitate(Request $request)
    {
        $tipid = $request->input('TipID');


        DB::delete('DELETE FROM TipUnitate WHERE TipID = ?', [$tipid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }
    public function deleteInfoRezervari(Request $request)
    {
        $rezervareid = $request->input('RezervareID');

        DB::delete('DELETE FROM Rezervari WHERE RezervareID = ?', [$rezervareid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function deleteInfoClienti(Request $request)
    {
        $clientid = $request->input('ClientID');

        DB::delete('DELETE FROM Clienti WHERE ClientID = ?', [$clientid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function deleteInfoCamereUnitate(Request $request)
    {
        $unitateid = $request->input('UnitateID');
        $cameraid = $request->input('CameraID');
        DB::delete('DELETE FROM CamereUnitate WHERE CameraID = ? AND UnitateID = ?', [$cameraid, $unitateid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function deleteInfoCamere(Request $request)
    {
        $cameraid = $request->input('CameraID');
        DB::delete('DELETE FROM Camere WHERE CameraID = ?', [$cameraid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function deleteinfoUnitateCazare(Request $request)
    {
        $unitateid = $request->input('UnitateID');


        DB::delete('DELETE FROM UnitateCazare WHERE UnitateID = ?', [$unitateid]);
        return redirect()->back();
        //return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function showAddRow(){
        $info = DB::select('SELECT NumeTip FROM TipUnitate');
        $infoNumeUnitate = DB::select('SELECT NumeUnitate FROM UnitateCazare');
        $infoNumePachet = DB::select('SELECT NumePachet FROM PachetRezervare');
        $infoCamereUnitateNume = DB::select('SELECT NumeUnitate FROM UnitateCazare');
        $infoCamereUnitateNumar = DB::select('SELECT NumarCamera FROM Camere');
        $infoNumarCamera = DB::select('SELECT NumarCamera FROM Camere');

        return view('newRow')->with('info',$info)->with('infoNumeUnitate',$infoNumeUnitate)->with('infoNumePachet',$infoNumePachet)->with('infoCamereUnitateNume',$infoCamereUnitateNume)->with('infoCamereUnitateNumar',$infoCamereUnitateNumar)->with('infoNumarCamera',$infoNumarCamera);
    }
    public function saveCamereRow(Request $request){
        $etaj = $request->input("Etaj");
        $numarcamera = $request -> input("NumarCamera");

        DB::insert('INSERT  INTO Camere (Etaj, NumarCamera) VALUES (?,?)',[$etaj,$numarcamera]);
        return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveTipUnitateRow(Request $request){
        $numetip = $request->input("NumeTip");


        DB::insert('INSERT  INTO TipUnitate (NumeTip) VALUES (?)',[$numetip]);
        return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveUnitateCazareRow(Request $request){


        $tipunitate= $request->input("TipUnitate");
        $tipunitateid = DB::select('SELECT TipID FROM TipUnitate WHERE NumeTip = ?',[$tipunitate]);
        $numeunitate = $request->input("NumeUnitate");
        $adresa = $request->input("Adresa");
        $codpostal = $request->input("CodPostal");


        DB::insert('INSERT  INTO UnitateCazare (TipUnitateID, NumeUnitate, Adresa, CodPostal) VALUES (?,?,?,?)',[$tipunitateid[0]->TipID,$numeunitate,$adresa,$codpostal]);
        return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveCamereUnitateRow(Request $request){
        $unitate = $request->input("UnitateID");
        $unitateid = DB::select('SELECT UnitateID FROM UnitateCazare WHERE NumeUnitate = ?',[$unitate]);
        $camera = $request->input("CameraID");
        $cameraid = DB::select('SELECT CameraID FROM Camere WHERE NumarCamera = ?',[$camera]);
        $numetipcamera = $request->input("NumeTipCamere");


        DB::insert('INSERT  INTO CamereUnitate (UnitateID, CameraID, NumeTipCamere) VALUES (?,?,?)',[$unitateid[0]->UnitateID, $cameraid[0]->CameraID, $numetipcamera]);
        return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function savePachetRezervareRow(Request $request){
        $numeUnitate = $request->input("NumeUnitate");
        $unitateid = DB::select('SELECT UnitateID FROM UnitateCazare WHERE NumeUnitate = ?',[$numeUnitate]);

        $transport = $request->input("Transport");
        $numarpersoane = $request->input("NumarPersoane");
        $numarnopticazare = $request->input("NumarNoptiCazare");
        $pretnoapte = $request->input("PretNoapte");
        $numepachet = $request->input("NumePachet");


        DB::insert('INSERT  INTO PachetRezervare (UnitateID, Transport, NumarPersoane, NumarNoptiCazare, PretNoapte, NumePachet) VALUES (?,?,?,?,?,?)',[$unitateid[0]->UnitateID, $transport, $numarpersoane, $numarnopticazare, $pretnoapte, $numepachet]);
        return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }

    public function saveRezervariRow(Request $request){
        $numepachet = $request->input("NumePachet");
        $pachetid = DB::select('SELECT PachetID FROM PachetRezervare WHERE NumePachet = ?',[$numepachet]);

        $numarcamera = $request->input("NumarCamera");
        $cameraid = DB::select('SELECT CameraID FROM Camere WHERE NumarCamera = ?',[$numarcamera]);

        $datarezervare = $request->input("DataRezervare");
        $datasosire = $request->input("DataSosire");
        $dataplecare = $request->input("DataPlecare");

         $pretNoapte = DB::select('SELECT PretNoapte FROM PachetRezervare WHERE PachetID = ?',[$pachetid[0]->PachetID,]);

        $numarNopti = DB::select('SELECT NumarNoptiCazare FROM PachetRezervare WHERE PachetID = ?',[$pachetid[0]->PachetID,]);
        $prettotal = $numarNopti[0]->NumarNoptiCazare * $pretNoapte[0]->PretNoapte;
        $avans = $prettotal / 2;



        DB::insert('INSERT  INTO Rezervari (PachetID, DataRezervare, DataSosire, PretTotal, Avans, CameraID) VALUES (?,?,?,?,?,?)',[$pachetid[0]->PachetID, $datarezervare, $datasosire, $prettotal, $avans, $cameraid[0]->CameraID ]);
        return redirect('/edit/Rezervari');
    }

    public function saveClientiRow(Request $request){
        $nume = $request->input("Nume");
        $prenume = $request->input("Prenume");
        $adresa = $request->input("Adresa");
        $localitate = $request->input("Localitate");
        $telefon = $request->input("Telefon");
        $rezervareid = $request->input("RezervareID");

        DB::insert('INSERT  INTO Clienti (Nume, Prenume, Adresa, Localitate, Telefon, RezervareID) VALUES (?,?,?,?,?,?)',[$nume, $prenume, $adresa, $localitate, $telefon, $rezervareid]);
        return redirect()->action('App\Http\Controllers\EditTableController@show_edit');
    }
}
