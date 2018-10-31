<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\ActivityExport;
use Maatwebsite\Excel\Facades\Excel;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();

        return view('activity.index', compact('activities'));
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

    public function activityChart(){
        return view('activity.chart');
    }

    public function activityChartData(Request $request){
        // dd($request->all());

         $result = DB::table('activities')
                    ->select(DB::raw('SUM(cost) as cost'),$request['filter'].' as label')
                    ->groupBy('label')
                    ->where('created_at','LIKE','%'.$request['year'].'%')
                    ->get();
        // dd(Carbon::createFromFormat('Y-m-d H:i:s', $result->created_at)->year);
                    // dd($result->toArray());

        if (!empty($result)) {
               foreach ($result as $key => $value) {
                if ($request['filter']=='type') {
                    $value->label = Activity::forChartTypeAttribute($value->label);
                }elseif($request['filter']=='scope'){
                    $value->label = Activity::forChartScopeAttribute($value->label);
                }elseif($request['filter']=='category'){
                    $value->label = Activity::forChartCategoryAttribute($value->label);
                }
            }
            
        }
        

        return response()->json($result);
    }

     public function export() 
    {
        return Excel::download(new ActivityExport, 'act.xlsx');
    }
}
