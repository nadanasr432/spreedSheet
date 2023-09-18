<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Spreadsheet;
use Illuminate\Http\Request;

class SpreadsheetController extends Controller
{
    public function index (){
        $spreadsheets = Spreadsheet::all();
        return view('spreadsheet', ['spreadsheets' => $spreadsheets]);
    }
    public function store (Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        Spreadsheet::Create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address

        ]);
       
    return redirect()->route('spreadsheet.index');


    }
}
