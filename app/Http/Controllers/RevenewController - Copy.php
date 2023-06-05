<?php

namespace App\Http\Controllers;

use App\Models\Revenew;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Service;
use DB;

use App\Exports\RevenuesExport;
use App\Imports\RevenuesImport;

use Maatwebsite\Excel\Facades\Excel;

class RevenewController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenew =  DB::table('services')
        ->select('*')
        ->join('revenews', 'revenews.service_id', '=', 'services.id')
        ->orderBy('revenews.id', 'DESC')
        ->paginate(8);
        return view('revenew.index', compact( 'revenew'));
    }
    public function csvupload(){
        return view('revenew.csv');
    }
    public function export() 
    {
        $filename = 'revenue.csv';
        $delimiter = ',';
        $data = Service::all();
        $f = fopen("tmp.csv", "w");
        mkdir($f, 0777);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');
        $line = ['service id','service name','date','robi','gp', 'blink','teletalk'];
        fputcsv($f, $line, $delimiter);
        foreach ($data as $row) {
            $line = [$row->id,$row->service_name];
            fputcsv($f, $line, $delimiter);
        }
        //return Excel::download(new RevenuesExport, 'revenue.csv');
    }
    private $rows = [];
    
    public function import(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $records = array_map('str_getcsv', file($path));
        if (! count($records) > 0) {
            return 'Error...';
        }
        // Get field names from header column
        $fields = array_map('strtolower', $records[0]);
        // Remove the header column
        array_shift($records);

        foreach ($records as $record) {
            if (count($fields) != count($record)) {
                return 'csv_upload_invalid_data';
            }
            // Decode unwanted html entities
            $record =  array_map("html_entity_decode", $record);

            // Set the field name as key
            $record = array_combine($fields, $record);

            // Get the clean data
            $this->rows[] = $this->clear_encoding_str($record);
        }
        
        $rvns = DB::table('revenews')->get();    
        foreach($this->rows as $data) {  
                foreach($rvns as $rvn) { 
                    if(($rvn->entry_date == $data['date'])){
                        return redirect('revenew');
                    }else{
                         


                        if(!empty($data['gp'])){
                            $check = Revenew::where(['operator'=>'gp','service_id'=>$data['service id'],'entry_date'=>$data['date']])->get()->first();
                            if($check == null){
                                Revenew::create([
                                'operator' => 'gp',
                                'service_id' => $data['service id'],
                                'revenew' => $data['gp'],
                                'entry_date' => $data['date'],
                                ]);
                            }
                            
                        }      
                        if(!empty($data['robi'])){
                            $check = Revenew::where(['operator'=>'robi','service_id'=>$data['service id'],'entry_date'=>$data['date']])->get()->first();
                            if($check == null){
                               Revenew::create([
                                    'operator' => 'robi',
                                    'service_id' => $data['service id'],
                                    'revenew' => $data['robi'],
                                    'entry_date' => $data['date'],
                                ]);
                            }
                        } 
                        if(!empty($data['blink'])){
                             $check = Revenew::where(['operator'=>'blink','service_id'=>$data['service id'],'entry_date'=>$data['date']])->get()->first();
                            if($check == null){
                                Revenew::create([
                                    'operator' => 'blink',
                                    'service_id' => $data['service id'],
                                    'revenew' => $data['blink'],
                                    'entry_date' => $data['date'],
                                    ]);
                            }

                          
                        }           
                        if(!empty($data['teletalk'])){
                            $check = Revenew::where(['operator'=>'blink','service_id'=>$data['service id'],'entry_date'=>$data['date']])->get()->first();
                            if($check == null){
                               Revenew::create([
                                'operator' => 'teletalk',
                                'service_id' => $data['service id'],
                                'revenew' => $data['teletalk'],
                                'entry_date' => $data['date'],
                                ]);
                            }
                         
                        }
                        
                    }
                    
                }
            }
        return redirect('revenew')
           ->with('success','Service add successfully.');
        
    }
    
    private function clear_encoding_str($value)
    {
        if (is_array($value)) {
            $clean = [];
            foreach ($value as $key => $val) {
                $clean[$key] = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
            return $clean;
        }
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }
 



    //    Excel::import(new RevenuesImport, request()->file('file'));  
    //    return back();
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $revenews = Service::orderBy('id', 'DESC')->get();
      return view('revenew.create', compact('revenews'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $revenw = new Revenew;
        $revenw->operator = $request->input('operator');
        $revenw->service_id = $request->input('service_id');  
        $revenw->revenew = $request->input('revenew');  
        $revenw->entry_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('entry_date'))->format('Y-m-d');  
        $revenw->save();
         return redirect('revenew')
            ->with('success','Service add successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Revenew  $revenew
     * @return \Illuminate\Http\Response
     */
    public function show(Revenew $revenew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Revenew  $revenew
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $revenew = revenew::find($id);
            $services = DB::table('services')
            ->select('*')
            ->get();
            
        $selectrvn = DB::table('revenews')
                ->selectRaw('operator, count(*) as total')
                ->groupBy('operator')
                ->get();
                // print_r($selectrvn);
                // exit;

            return view('revenew.edit',compact('services','revenew','selectrvn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Revenew  $revenew
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateId = Revenew::find($request->id);
        $input['operator'] = $request->operator;
        $input['service_id'] =$request->service_id;
        $input['entry_date'] = $request->entry_date; 
        $input['revenew'] =  $request->revenew;  
        $updateId->update($input);
        return redirect('revenew')
            ->with('success','Service Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Revenew  $revenew
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Revenew::where('id', $id)->delete();
        return redirect('revenew')
            ->with('success','Delete  successfully.');
    }  
    
    public function revenuereport()
    {
  
     return \view('report.revenue');
    }
    public function revenewsearch(Request $request){
        // $rvns = DB::select("select operator,sum(revenew) as revenew from revenews where entry_date>='$startdate' and entry_date<='$totdate' group by operator");
       
        // print_r($request->all());
             $startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->format('Y-m-d');  
        $totdate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('to_date'))->format('Y-m-d');  
        $rvns = DB::table('revenews')
        ->selectRaw('operator,service_id, sum(revenew) as revenew')
        ->where('entry_date','>=',  $startdate)
                ->where('entry_date','<=',  $totdate)
                ->groupBy('operator')
                ->groupBy('service_id')
                ->get();

                // print_r($rvns);
                // die();
            return view('report.revenue',compact('rvns'));
    }

}
