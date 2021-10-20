<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Motif;
use App\Models\User;
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
        $motif = Motif::all();
        return view('motif', ['motif' => $motif]);

        // $id = Auth::user()->getId();
        // $datetime1 = \Carbon\Carbon::createFromFormat('H:s:i', '9:00:00');
        // $datetime2 = User::where('id', $id)->value('day_login_at');
        // $datetime2 = \Carbon\Carbon::createFromFormat('H:s:i', '9:00:10');

        
        // $interval = $datetime1->diff($datetime2);
        // $finalData = $interval->format('%H')*60 + $interval->format('%I');

        

        // echo "Datetime1 <br/>";
        // echo $datetime1;
        // echo "<br/><br/>";
        // echo "Datetime 2 <br/>";
        // echo $datetime2;
        // echo "<br/><br/>";
        // echo "Result : <br/>";
        
        // echo "$finalData Minutes";
        // echo "<br/><br/>";
        // $mytime = date('Y-m-d H:i:s');
        // echo $mytime;
        // echo "<br/><br/>";
        // $user =  auth()->user();
        // echo $user->id;
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
        $user = auth()->user();
        $datetime1 = \Carbon\Carbon::createFromFormat('H:s:i', '9:00:00');
        $datetime2 = User::where('id', $id)->value('day_login_at');


        
        $interval = $datetime1->diff($datetime2);
        $finalData = $interval->format('%H')*60 + $interval->format('%I');
        $name = $user->name; 
        $ArgumentA = 'Absent de ';

        $fileName = $ArgumentA.$name;
        
        
        if ($datetime2 != Null) {
            if ($finalData > 60) 
            {
                $motif = Motif::create([
                    'Motifname' => 'Absent',
                    'duration' => '1',
                    'comment' => $fileName,
                    'user_id' => $user->id,
                ]);
                $motif->save();
            } 
            else 
            {
                $motif = Motif::create([
                    'Motifname' => 'Retard',
                    'duration' => $finalData,
                    'comment' => `Retard de $user->name`,
                    'user_id' => $user->id,
                ]);
                $motif->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
