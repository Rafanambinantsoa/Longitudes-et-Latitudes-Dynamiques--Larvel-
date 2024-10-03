<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    //recuperation des coordonnees de l'utilisateur
    public function getCoordonnees(Request $request)
    {
        return response($request->all());
    }
}
