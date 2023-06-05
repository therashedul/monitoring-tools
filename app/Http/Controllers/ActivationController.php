<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Service;
use DB;

class ActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activation =  DB::table('services')
        ->select('*')
        ->join('activations', 'activations.service_id', '=', 'services.id')
        ->orderBy('activations.id', 'DESC')
        ->paginate(8);
        return view('activation.index', compact( 'activation'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $activations = Service::orderBy('id', 'DESC')->get();
      return view('activation.create', compact('activations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $revenw = new Activation;
        $revenw->operator = $request->input('operator');
        $revenw->service_id = $request->input('service_id');  
        $revenw->activation = $request->input('activation');  
        $revenw->deactivation = $request->input('deactivation');  
        $revenw->create_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('create_date'))->format('Y-m-d');  
        $revenw->save();
         return redirect('activation')
            ->with('success','Service add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function show(Activation $activation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $activation = Activation::find($id);
          $services = DB::table('services')
            ->select('*')
            ->get();
            
        $selectrvn = DB::table('operators')
                ->get();
                // $oprt = ['Bangla_link','GP','ROBI','TELETALK'];
                // print_r($selectrvn);
                // exit;

            return view('activation.edit',compact('services','activation','selectrvn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateId = Activation::find($request->id);
        $input['operator'] = $request->operator;
        $input['service_id'] =$request->service_id;
        $input['create_date'] = $request->create_date; 
        $input['activation'] =  $request->activation;  
        $input['deactivation'] =  $request->deactivation;  
        $updateId->update($input);
        return redirect('activation')
            ->with('success','Service Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Activation::where('id', $id)->delete();
        return redirect('activation')
            ->with('success','Delete  successfully.');
    }
    public static function activation_data($opr,$service_id,$startdate,$enddate){
        $data = Activation::where('operator',$opr)->where('service_id',$service_id)->whereDate('create_date','>=',$startdate)->whereDate('create_date','<=',$enddate)->select(DB::raw("SUM(activation) as total_active, SUM(deactivation) as total_deactive"))->get()->first();
        return $data;
    }    
    public static function activation_data_total($opr,$startdate,$enddate){
        $data = Activation::where('operator',$opr)->whereDate('create_date','>=',$startdate)->whereDate('create_date','<=',$enddate)->select(DB::raw("SUM(activation) as total_active, SUM(deactivation) as total_deactive"))->get()->first();
        return $data;
    }
    public function activationreport(Request $request)
    {
        if($request->startdate){
            $startdate = $request->startdate;
        }
        else{
             $startdate = date('Y-m-d');
        }

        if($request->enddate){
            $enddate = $request->enddate;
        }
        else{
             $enddate = date('Y-m-d');
        }
        $data['startdate'] = $startdate;
        $data['enddate'] = $enddate;
        return \view('report.activation',$data);
    }
    public function activationsearch(Request $request){
     
       $startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->format('Y-m-d');  
        $enddate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('to_date'))->format('Y-m-d');  
        $operator = $request->operator;
        $serviceId = $request->service_id;
        
        $avns = DB::table('activations')
                ->selectRaw('operator,service_id, sum(activation) as activation, sum(deactivation) as deactivation')
                ->where('create_date','>=',  $startdate)
                ->where('create_date','<=',  $enddate)
                ->where('operator','=',  $operator)
                ->where('service_id','=',  $serviceId)
                //  ->groupBy('operator', 'service_id')
                ->groupBy('operator')
                ->get();
         
            return view('report.activation',compact('avns','startdate','enddate'));
    }
    public function csvupload(){
        return view('activation.csv');
    }
     public function export() 
    {
        $filename = 'activation.csv';
        $delimiter = ',';
        $data = Service::all();
        $f = fopen("tmp.csv", "w");
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');
        // Export field name
        $line = ['service_id','service_name','robi_activation','robi_deactivation','gp_activation','gp_deactivation' , 'blink_activation', 'blink_deactivation','teletalk_activation','teletalk_deactivation','date'];
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
        foreach ($this->rows as $data) {  
            // print_r($data);
        //check operator value
        if(!empty($data['gp_activation']) || !empty($data['gp_deactivation'])){
                        //   check operator,service_id and date
                            $check = Activation::where(['operator'=>'gp','service_id'=>$data['service_id'],'create_date'=>$data['date']])->get()->first();
                            if($check == null){
                                Activation::create([
                                'operator' => 'GP',
                                'service_id' => $data['service_id'],
                                'activation' => $data['gp_activation'],
                                'deactivation' => $data['gp_deactivation'],
                                'create_date' => $data['date'],
                                ]);
                            }
                            
                        }      
                        if(!empty($data['robi_activation']) || !empty($data['robi_deactivation'])){
                             $check = Activation::where(['operator'=>'robi','service_id'=>$data['service_id'],'create_date'=>$data['date']])->get()->first();
                            if($check == null){
                               Activation::create([
                                'operator' => 'Robi',
                                'service_id' => $data['service_id'],
                                'activation' => $data['robi_activation'],
                                'deactivation' => $data['robi_deactivation'],
                                'create_date' => $data['date'],
                                ]);
                            }
                        } 
                        if(!empty($data['blink_activation']) || !empty($data['blink_deactivation'])){
                              $check = Activation::where(['operator'=>'blink','service_id'=>$data['service_id'],'create_date'=>$data['date']])->get()->first();
                            if($check == null){
                                Activation::create([
                                    'operator' => 'Bangla_link',
                                    'service_id' => $data['service_id'],
                                    'activation' => $data['blink_activation'],
                                    'deactivation' => $data['blink_deactivation'],
                                    'create_date' => $data['date'],
                                    ]);
                            }
                        }           
                        if(!empty($data['teletalk_activation']) || !empty($data['teletalk_deactivation'])){
                             $check = Activation::where(['operator'=>'teletalk','service_id'=>$data['service_id'],'create_date'=>$data['date']])->get()->first();
                            if($check == null){
                               Activation::create([
                                'operator' => 'Teletalk',
                                'service_id' => $data['service_id'],
                                'activation' => $data['teletalk_activation'],
                                'deactivation' => $data['teletalk_deactivation'],
                                'create_date' => $data['date'],
                                ]);
                            }
                         
                        }
        }
        return redirect('activation')
           ->with('success','Activation add successfully.');
        
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
}
