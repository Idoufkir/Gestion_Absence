<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $id = Auth::user()->getId();
        $user = User::where('id', $id)->first(['id', 'name', 'email', 'intitule', 'role']);
        $role = User::where('id', $id)->value('role');

        if ($role == "admin") {
            $employe = User::all();
            return view('index', compact('employe'));
        }else if ($role == "user") {
            $employe = User::where('id', $id)->get();
            return view('index', compact('employe'));
        } else {
            return view('404', compact('not-found'));
        }
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
        //
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

        $userId = Auth::user()->getId();
        $user = User::where('id', $userId)->first(['id', 'name', 'email', 'intitule', 'role']);
        $role = User::where('id', $userId)->value('role');

        if ($role == "admin") {
            $employe = User::findOrFail($id);
            return view ('edit', compact('employe'));
        }else if ($role == "user") {
            $employe = User::findOrFail($userId);
            return view('edit', compact('employe'));
        } else {
            return view('404', compact('not-found'));
        }
        
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'intitule' => 'required|max:255',
        ]);

        User::whereId($id)->update($updateData);
        return redirect('/employes')->with('completed', 'Employe has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        $userId = Auth::user()->getId();
        $user = User::where('id', $userId)->first(['id', 'name', 'email', 'intitule', 'role']);
        $role = User::where('id', $userId)->value('role');

        if ($role == "admin") {
            $employe = User::findOrFail($id);
            $employe->delete();
                return redirect('/employes')->with('completed', 'Employe has been deleted');
        } else {
            return view('404');
        }

        
    }
}
