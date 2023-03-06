<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewTableController extends Controller
{
    public function show(){
        $tables =  DB::select('SHOW TABLES');
        $tables = array_map('current',$tables);
        return view('table') -> with('result',$tables);
    }

    public function showTable($nameTable){
        $infoNumeUnitate = DB::select('SELECT * FROM UnitateCazare');
        $numereCamere = DB::select('SELECT * FROM Camere');
        $numePachete = DB::select('SELECT * FROM PachetRezervare');
        $numeTip = DB::select('SELECT * FROM TipUnitate');

        $tables =  DB::select('SHOW TABLES');
        $tables = array_map('current',$tables);
        $columns =  DB::select(DB::raw("DESC $nameTable "));
       // $columns = DB::select(DB::raw("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_NAME ='$nameTable' AND COLUMN_NAME NOT LIKE '%ID'"));
        $result =  DB::select(DB::raw("SELECT * FROM $nameTable"));
        return view('table') -> with('result',$tables) ->with('info',$result) ->with('columns',$columns)->with('info1', $infoNumeUnitate)->with('info2', $numereCamere)->with('info3', $numePachete)->with('info4', $numeTip);;

    }

    public function pacheteCazari(){
        $result = DB::select('SELECT PR.NumePachet , PR.PretNoapte , UC.NumeUnitate , UC.Adresa
                                    FROM PachetRezervare PR INNER JOIN UnitateCazare UC ON PR.UnitateID = UC.UnitateID ');
        return view('pacheteCazari')->with('result', $result);
    }
    public function searchPacheteCazari (Request $request)
    {
        $nume= $request->input('Search');

        if($nume==''){
            $result = DB::select('SELECT PR.NumePachet , PR.PretNoapte , UC.NumeUnitate , UC.Adresa
                                    FROM PachetRezervare PR INNER JOIN UnitateCazare UC ON PR.UnitateID = UC.UnitateID ');
            return view('pacheteCazari')->with('result', $result);
        } else {
            $result = DB::select('SELECT PR.NumePachet , PR.PretNoapte , UC.NumeUnitate , UC.Adresa
                                    FROM PachetRezervare PR INNER JOIN UnitateCazare UC ON PR.UnitateID = UC.UnitateID
                                    WHERE UC.NumeUnitate = ?',[$nume]);

            return view('pacheteCazari')->with('result', $result);
        }
    }

    public function UnitatiCazare(){
        $result = DB::select('SELECT UC.NumeUnitate , UC.Adresa , TU.NumeTip
                                    FROM UnitateCazare UC INNER JOIN TipUnitate TU ON UC.TipUnitateID  = TU.TipID ');
        return view('unitati')->with('result', $result);
    }

    public function searchUnitatiCazare (Request $request)
    {
        $tip= $request->input('Search');

        if($tip==''){
            $result = DB::select('SELECT UC.NumeUnitate , UC.Adresa , TU.NumeTip
                                        FROM UnitateCazare UC INNER JOIN TipUnitate TU ON UC.TipUnitateID  = TU.TipID');
            return view('unitati')->with('result', $result);
        } else {
            $result = DB::select('SELECT UC.NumeUnitate , UC.Adresa , TU.NumeTip
                                        FROM UnitateCazare UC INNER JOIN TipUnitate TU ON UC.TipUnitateID  = TU.TipID
                                        WHERE TU.NumeTip = ?', [$tip]);

            return view('unitati')->with('result', $result);
        }
    }

    public function Camere(){
        $result = DB::select('SELECT uc.NumeUnitate , c.Etaj , c.NumarCamera, cu.NumeTipCamere
                                    FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					                                    INNER JOIN Camere c ON cu.CameraID = c.CameraID ');
        return view('camere')->with('result', $result);
    }

    public function Clienti(){
        $result = DB::select('SELECT c.Nume, c.Prenume , c.Telefon , r.DataSosire , pr.NumePachet , uc.NumeUnitate
                                    FROM Clienti c INNER JOIN Rezervari r ON c.RezervareID = r.RezervareID
			                                       INNER JOIN PachetRezervare pr ON r.PachetID = pr.PachetID
			                                       INNER JOIN UnitateCazare uc ON uc.UnitateID = pr.UnitateID ');
        $info = DB::select('SELECT DISTINCT c.Nume, c.Prenume , c.Telefon, pr.NumarPersoane, c2.NumarCamera ,c2.Etaj ,cu.NumeTipCamere
                                  FROM Clienti c  INNER JOIN Rezervari r ON c.RezervareID = r.RezervareID
                                                  INNER JOIN Camere c2 ON r.CameraID = c2.CameraID
                                                  INNER JOIN PachetRezervare pr ON pr.PachetID = r.PachetID
                                                  INNER JOIN CamereUnitate cu ON cu.CameraID = c2.CameraID');
        return view('clienti')->with('result', $result)->with('info', $info);
    }

    public function searchClienti (Request $request)
    {
        $nume = $request->input('Search');

        if ($nume=='') {
             $result = DB::select('SELECT c.Nume, c.Prenume , c.Telefon , r.DataSosire , pr.NumePachet , uc.NumeUnitate
                                        FROM Clienti c INNER JOIN Rezervari r ON c.RezervareID = r.RezervareID
			                                           INNER JOIN PachetRezervare pr ON r.PachetID = pr.PachetID
			                                           INNER JOIN UnitateCazare uc ON uc.UnitateID = pr.UnitateID ');

             $info = DB::select('SELECT DISTINCT c.Nume, c.Prenume , c.Telefon, pr.NumarPersoane, c2.NumarCamera ,c2.Etaj ,cu.NumeTipCamere
                                      FROM Clienti c  INNER JOIN Rezervari r ON c.RezervareID = r.RezervareID
                                                  INNER JOIN Camere c2 ON r.CameraID = c2.CameraID
                                                  INNER JOIN PachetRezervare pr ON pr.PachetID = r.PachetID
                                                  INNER JOIN CamereUnitate cu ON cu.CameraID = c2.CameraID');

            return view('clienti')->with('result', $result)->with('info', $info);
        } else {
                $result = DB::select('SELECT c.Nume, c.Prenume , c.Telefon , r.DataSosire , pr.NumePachet , uc.NumeUnitate
                                        FROM Clienti c INNER JOIN Rezervari r ON c.RezervareID = r.RezervareID
			                                           INNER JOIN PachetRezervare pr ON r.PachetID = pr.PachetID
			                                           INNER JOIN UnitateCazare uc ON uc.UnitateID = pr.UnitateID
			                            WHERE c.Nume= ?', [$nume]);

                $result1 = DB::select('SELECT DISTINCT c.Nume, c.Prenume , c.Telefon, pr.NumarPersoane, c2.NumarCamera ,c2.Etaj ,cu.NumeTipCamere
                                      FROM Clienti c  INNER JOIN Rezervari r ON c.RezervareID = r.RezervareID
                                                  INNER JOIN Camere c2 ON r.CameraID = c2.CameraID
                                                  INNER JOIN PachetRezervare pr ON pr.PachetID = r.PachetID
                                                  INNER JOIN CamereUnitate cu ON cu.CameraID = c2.CameraID
                                        WHERE c.Nume= ?', [$nume]);

                return view('clienti')->with('result', $result)->with('info', $result1);
        }
    }
    public function statisticiUnitatiCamere(){
         $result = DB::select('SELECT uc.NumeUnitate
                                     FROM UnitateCazare uc
                                     WHERE uc.UnitateID IN  (SELECT cu.UnitateID
                                                             FROM CamereUnitate cu
                                                             WHERE cu.NumeTipCamere = "Apartament" AND cu.CameraID IN (SELECT c.CameraID
                                                                                                                       FROM Camere c)
                                                            )
                                                        AND uc.TipUnitateID IN (SELECT tu.TipID
                                                                                FROM TipUnitate tu)');

        $result1 = DB::select('SELECT c.Nume , c.Prenume
                                     FROM Clienti c INNER JOIN Rezervari r ON r.RezervareID = c.RezervareID
                                     WHERE r.RezervareID NOT IN (SELECT r2.RezervareID
                                                             FROM Rezervari r2
                                                             WHERE r2.PachetID IN(SELECT pr.PachetID
                                                                                  FROM PachetRezervare pr
                                                                                  WHERE pr.UnitateID IN(SELECT uc.UnitateID
                                                                                                        FROM UnitateCazare uc INNER JOIN TipUnitate tu ON tu.TipID = uc.TipUnitateID
                                                                                                        WHERE tu.NumeTip = "Hotel"
                                                                                                        )
                                                                                    )
                                                            )
                                    GROUP BY c.Nume , c.Prenume ');

        $result2 = DB::select('SELECT uc.NumeUnitate, MONTH(r.DataSosire) AS Luna, SUM(r.PretTotal) AS CastigLunar
                                     FROM UnitateCazare uc  INNER JOIN PachetRezervare pr  ON uc.UnitateID = pr.UnitateID
                                                            INNER JOIN Rezervari r ON r.PachetID = pr.PachetID
                                     GROUP BY MONTH(r.DataSosire), uc.NumeUnitate
                                     ORDER BY MONTH(r.DataSosire) ASC');

        $result3 = DB::select('SELECT uc.NumeUnitate
FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					  INNER JOIN Camere c ON c.CameraID = cu.CameraID
WHERE c.Etaj = 1
GROUP BY uc.NumeUnitate
HAVING COUNT(*) >= ALL (SELECT COUNT(*)
					   FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					  					     INNER JOIN Camere c ON c.CameraID = cu.CameraID
											 WHERE c.Etaj = 1
GROUP BY uc.NumeUnitate)');
        $result4 = DB::select('SELECT DISTINCT Ad.NumeUnitate
FROM TipUnitate tu , (SELECT uc.NumeUnitate
	  FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON cu.UnitateID = uc.UnitateID
	  						INNER JOIN Camere c ON c.CameraID = cu.CameraID
	  WHERE  cu.NumeTipCamere ="Apartament"
	  GROUP BY uc.NumeUnitate
	  HAVING COUNT(*) > 2) AS Ad');
        return view('statisticiUnitati')->with('result', $result)->with('result1', $result1)->with('result2', $result2)->with('result3', $result3)->with('result4', $result4);
    }

    public function searchstatisticiUnitatiCamere(Request $request){

        $luna = $request->input('Search');
        $etaj = $request->input('Search1');
        $luna1 = $request->input('Search2');

        if($luna == ''){
            $result = DB::select('SELECT uc.NumeUnitate
FROM UnitateCazare uc
WHERE uc.UnitateID IN  (SELECT cu.UnitateID
						FROM CamereUnitate cu
						WHERE cu.NumeTipCamere = "Apartament" AND cu.CameraID IN (SELECT c.CameraID
											  FROM Camere c)
						)
					AND uc.TipUnitateID IN (SELECT tu.TipID
											FROM TipUnitate tu)');

            $result1 = DB::select('SELECT c.Nume , c.Prenume
                                         FROM Clienti c INNER JOIN Rezervari r ON r.RezervareID = c.RezervareID
                                         WHERE r.RezervareID NOT IN (SELECT r2.RezervareID
                                                                 FROM Rezervari r2
                                                                 WHERE r2.PachetID IN(SELECT pr.PachetID
                                                                                      FROM PachetRezervare pr
                                                                                      WHERE pr.UnitateID IN(SELECT uc.UnitateID
                                                                                                            FROM UnitateCazare uc INNER JOIN TipUnitate tu ON tu.TipID = uc.TipUnitateID
                                                                                                            WHERE tu.NumeTip = "Hotel"
                                                                                                )
                                                                        )
                                                   )
                                        GROUP BY c.Nume , c.Prenume ');

            $result2 = DB::select('SELECT uc.NumeUnitate, MONTH(r.DataSosire) AS Luna, SUM(r.PretTotal) AS CastigLunar
                                     FROM UnitateCazare uc  INNER JOIN PachetRezervare pr  ON uc.UnitateID = pr.UnitateID
                                                            INNER JOIN Rezervari r ON r.PachetID = pr.PachetID
                                     GROUP BY MONTH(r.DataSosire), uc.NumeUnitate
                                     ORDER BY MONTH(r.DataSosire) ASC');

            $result3 = DB::select('SELECT uc.NumeUnitate
FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					  INNER JOIN Camere c ON c.CameraID = cu.CameraID
WHERE c.Etaj = ?
GROUP BY uc.NumeUnitate
HAVING COUNT(*) >= ALL (SELECT COUNT(*)
					   FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					  					     INNER JOIN Camere c ON c.CameraID = cu.CameraID
											 WHERE c.Etaj = ?
GROUP BY uc.NumeUnitate)',[$etaj,$etaj]);
            $result4 = DB::select('SELECT DISTINCT Ad.NumeUnitate
FROM TipUnitate tu , (SELECT uc.NumeUnitate
	  FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON cu.UnitateID = uc.UnitateID
	  						INNER JOIN Camere c ON c.CameraID = cu.CameraID
	  WHERE  cu.NumeTipCamere ="Apartament"
	  GROUP BY uc.NumeUnitate
	  HAVING COUNT(*) > 2) AS Ad');

            return view('statisticiUnitati')->with('result', $result)->with('result1', $result1)->with('result2', $result2)->with('result3', $result3)->with('result4', $result4);
        } else {
            $result = DB::select('SELECT uc.NumeUnitate
FROM UnitateCazare uc
WHERE uc.UnitateID IN  (SELECT cu.UnitateID
						FROM CamereUnitate cu
						WHERE cu.NumeTipCamere = "Apartament" AND cu.CameraID IN (SELECT c.CameraID
											  FROM Camere c)
						)
					AND uc.TipUnitateID IN (SELECT tu.TipID
											FROM TipUnitate tu)');

            $result1 = DB::select('SELECT c.Nume , c.Prenume
                                         FROM Clienti c INNER JOIN Rezervari r ON r.RezervareID = c.RezervareID
                                         WHERE r.RezervareID NOT IN (SELECT r2.RezervareID
                                                                 FROM Rezervari r2
                                                                 WHERE r2.PachetID IN(SELECT pr.PachetID
                                                                                      FROM PachetRezervare pr
                                                                                      WHERE pr.UnitateID IN(SELECT uc.UnitateID
                                                                                                            FROM UnitateCazare uc INNER JOIN TipUnitate tu ON tu.TipID = uc.TipUnitateID
                                                                                                            WHERE tu.NumeTip = "Hotel"
                                                                                                )
                                                                        )
                                                   )
                                        GROUP BY c.Nume , c.Prenume ');

            $result2 = DB::select('SELECT uc.NumeUnitate, MONTH(r.DataSosire) AS Luna, SUM(r.PretTotal) AS CastigLunar
                                     FROM UnitateCazare uc  INNER JOIN PachetRezervare pr  ON uc.UnitateID = pr.UnitateID
                                                            INNER JOIN Rezervari r ON r.PachetID = pr.PachetID
                                     WHERE MONTH(r.DataSosire) = ?
                                     GROUP BY MONTH(r.DataSosire), uc.NumeUnitate
                                     ORDER BY MONTH(r.DataSosire) ASC', [$luna]);

            $result3 = DB::select('SELECT uc.NumeUnitate
FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					  INNER JOIN Camere c ON c.CameraID = cu.CameraID
WHERE c.Etaj = ?
GROUP BY uc.NumeUnitate
HAVING COUNT(*) >= ALL (SELECT COUNT(*)
					   FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON uc.UnitateID = cu.UnitateID
					  					     INNER JOIN Camere c ON c.CameraID = cu.CameraID
											 WHERE c.Etaj = ?
GROUP BY uc.NumeUnitate)',[$etaj,$etaj]);
            $result4 = DB::select('SELECT DISTINCT Ad.NumeUnitate
FROM TipUnitate tu , (SELECT uc.NumeUnitate
	  FROM UnitateCazare uc INNER JOIN CamereUnitate cu ON cu.UnitateID = uc.UnitateID
	  						INNER JOIN Camere c ON c.CameraID = cu.CameraID
	  WHERE  cu.NumeTipCamere ="Apartament"
	  GROUP BY uc.NumeUnitate
	  HAVING COUNT(*) > 2) AS Ad');

            return view('statisticiUnitati')->with('result', $result)->with('result1', $result1)->with('result2', $result2)->with('result3', $result3)->with('result4', $result4);
        }



    }
}
