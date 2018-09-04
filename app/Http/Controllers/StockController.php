<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class StockController extends Controller
{	
	public function index(){
		return view('index');
	}

    public function create(){
    	return view('stock');
    }

    public function store(Request $request){
    	$stock = new Stock([
          'stockName' => $request->get('stockName'),
          'stockPrice' => $request->get('stockPrice'),
          'stockYear' => $request->get('stockYear'),
        ]);
        $stock->save();

        return redirect('stocks');
    }

    public function chart()
      {
        $result = \DB::table('stocks')
                  
                    ->orderBy('stockYear', 'ASC')
                    ->get();
        return response()->json($result);
      }
}
