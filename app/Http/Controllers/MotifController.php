<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Motif;
use App\Models\User;
use App\Models\Historique;
use Auth;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $id = Auth::user()->getId();
        $role = User::where('id', $id)->value('role');

        if ($role == "admin") {
            $motif = Motif::where('status', 1)->get();
                return view('motif-admin', ['motif' => $motif]);
        }else if ($role == "user") {
            $motif = Motif::where('user_id', $id)->get();
                return view('motif-user', ['motif' => $motif]);
        } else {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();
        $userId = $user->id;

        // $motifs = Motif::where('user_id', $userId)->orderBy('id', 'desc')->value('created_at');
        // $motif = Motif::where('user_id', $userId);
        
        // $motifsCount = Motif::where('user_id', $userId)->count();
        // if ($motifsCount  == Null) {
        //     echo 'Null';
        // } else {
        //     $DayNow = date('dmY', strtotime(now()));
        //     $Day0 = date('dmY', strtotime($motifs));
            
        //     if ($Day0 == $DayNow) {
        //         echo "You have Motif Today";
        //     } else if ($Day0 < $DayNow) {
        //         echo "You dont have Motif Today";
        //     }
        // }

        


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = Auth::user()->getId();
        $role = User::where('id', $id)->value('role');
        $user = auth()->user();
        $datetime1 = \Carbon\Carbon::createFromFormat('H:i:s', '9:00:00');
        $datetime2 = User::where('id', $id)->value('day_login_at');
        $interval = $datetime1->diff($datetime2);
        $finalData = $interval->format('%H')*60 + $interval->format('%I');
        $name = $user->name; 
        $userId = $user->id;
        $ArgumentA = 'Absent de ';
        $ArgumentB = 'Retard de ';

        $fileName = $ArgumentA.$name;

        $motifs = Motif::where('user_id', $userId)->orderBy('id', 'desc')->value('created_at');
        // $countMotif = $motif->count();
        // $lastDay = $motif[$countMotif]->value('created_at')->day;
        // $dayNow = \Carbon\Carbon::now()->day;
        //#magenta
            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime2)->day;
        //#
        $motifsCount = Motif::where('user_id', $userId)->count();
        //$motifExiste = Motif::where('user_id', $userId)->exists();
        if ($motifsCount  <= 0) {
            if ($datetime2 != Null) {
                if ($finalData > 60)
                {
                    $motif = Motif::create([
                        'Motifname' => 'Absent',
                        'duration' => '1',
                        'comment' => $fileName,
                        'user_id' => $user->id,
                        'status' => '0',
                    ]);
                    $motif->save();
                } 
                else 
                {
                    $motif = Motif::create([
                        'Motifname' => 'Retard',
                        'duration' => $finalData,
                        'comment' => $ArgumentB.$name,
                        'user_id' => $user->id,
                        'status' => '0',
                    ]);
                    $motif->save();
                }
                return redirect()->back();
            }
        } else {
            $DayNow = date('dmY', strtotime(now()));
            $Day0 = date('dmY', strtotime($motifs));
            
            if ($Day0 == $DayNow) {
                //#red
                    //echo 'You have Motif';
                    return redirect()->back();
                //#
            } else if ($Day0 < $DayNow) {
                if ($datetime2 != Null) {
                    if ($finalData > 60)
                    {
                        $motif = Motif::create([
                            'Motifname' => 'Absent',
                            'duration' => '1',
                            'comment' => $fileName,
                            'user_id' => $user->id,
                            'status' => '0',
                        ]);
                        $motif->save();

                    } 
                    else 
                    {
                        $motif = Motif::create([
                            'Motifname' => 'Retard',
                            'duration' => $finalData,
                            'comment' => $ArgumentB.$name,
                            'user_id' => $user->id,
                            'status' => '0',
                        ]);
                        $motif->save();
                    }
                    return redirect()->back();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $motif = Motif::where('id', $id);
            return view ('edit-motif', compact('motif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'Motifname' => 'required|max:255',
            'duration' => 'required|max:255',
            'comment' => 'required|max:255',
            
        ]);

        Motif::whereId($id)->update($updateData);
        return redirect('/motifs')->with('completed', 'Motif has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $motif = Motif::where('id', $id);
            $motif->delete();
                return redirect('/motifs')->with('completed', 'Motif has been deleted');
    }

    public function status()
    {
        $motif = Motif::where('status', 0)->get();
        return view('motif-validate', ['motif' => $motif]);
    }
    
    public function validat(Request $request, $id)
    {   
        // UserId && UserRole && User
        $userId = Motif::where('id', $id)->value('user_id');
        echo $userId;

        // Check If Historique User Existe
        $UserHistorique = Historique::where('user_id', $userId)->count();

        // Old Value of {Retard} + New Value
        $retardOldValue = Historique::where('user_id', $userId)->value('retard');
        $retardValue = Motif::where('id', $id)->value('duration');
        $retardNewValue = $retardOldValue + $retardValue;

        // Old Value of {Absent} + New Value
        $absentOldValue = Historique::where('user_id', $userId)->value('absent');
        $absentValue = Motif::where('id', $id)->value('duration');
        if ($absentOldValue == null ) {
            $absentNewValue = $absentValue;
        } else {
            $absentNewValue = $absentOldValue + $absentValue;
        }
        
        
        // Old Value of {Jrs Ferier} + New Value
        $jrsFevrierOldValue = Historique::where('user_id', $userId)->value('jrs_ferier');
        $jrsFevrierValue = Motif::where('id', $id)->value('duration');
        $jrsFevrierNewValue = $jrsFevrierOldValue + $jrsFevrierValue;

        // Old Value of {Congé} + New Value
        $congeOldValue = Historique::where('user_id', $userId)->value('conge');
        $congeValue = Motif::where('id', $id)->value('duration');
        $congeNewValue = $congeOldValue + $congeValue;


        $motif = Motif::findOrFail($id);
        $motif->status = 1;
        $motif->update();


        if ($UserHistorique < 1) {

            if ($motif->status == 1 && $motif->Motifname == 'Absent') {

                $historique = Historique::create([
                    'user_id' => $userId,
                    'motif_id' => $id,
                    'absent' => $absentNewValue,
                ]);
                $historique->save();

            } else if ($motif->status == 1 && $motif->Motifname == 'Retard') {

                $historique = Historique::create([
                    'user_id' => $userId,
                    'motif_id' => $id,
                    'retard' => $retardNewValue,
                ]);
                $historique->save();

            } else if ($motif->status == 1 && $motif->Motifname == 'congé') {

                $historique = Historique::create([
                    'user_id' => $userId,
                    'motif_id' => $id,
                    'conge' => $congeNewValue,
                ]);
                $historique->save();

            } else if ($motif->status == 1 && $motif->Motifname == 'Jour férié') {

                $historique = Historique::create([
                    'user_id' => $userId,
                    'motif_id' => $id,
                    'jrs_ferier' => $jrsFevrierNewValue,
                ]);
                $historique->save();

            }
            
        } else {

            $historique = Historique::where('user_id', $userId)->first();
            
            if ($motif->status == 1 && $motif->Motifname == 'Absent') {

                $historique = $historique->update([
                    'absent' => $absentNewValue,
                ]);

            } else if ($motif->status == 1 && $motif->Motifname == 'Retard') {

                $historique = $historique->update([
                    'retard' => $retardNewValue,
                ]);

            } else if ($motif->status == 1 && $motif->Motifname == 'congé') {

                $historique = $historique->update([
                    'conge' => $congeNewValue,
                ]);

            } else if ($motif->status == 1 && $motif->Motifname == 'Jour férié') {

                $historique = $historique->update([
                    'jrs_ferier' => $jrsFevrierNewValue,
                ]);

            }

        }
        
        return redirect('/motifs/status')->with('completed', 'Motif has been Validate');
    }
}