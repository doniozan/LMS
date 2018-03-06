<?php

namespace App\Http\Controllers\masterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Statuses;
use DB;

class StatusesController extends Controller
{
    public function index(){
    	return view('masterData.Statuses.index')
    	->with('Statuses',Statuses::all());
    }

    public function add(Request $request){
    	$statuses = new Statuses;

    		$statuses->nama_status  = $request->nama_status;
    		$statuses->color  = $request->color;
    		$statuses->order_status  = $request->order_status;

    	$statuses->save();
        ?>
        <script type='text/javascript'>
            location.href= "/setupstatuses";
            alert('Save Success');
        </script>
        <?php
    }

    public function search($id_statuses){
        $data = Statuses::where('id_statuses',$id_statuses)->get();
        return json_encode($data);
    }

    public function edit(Request $request){
        $statuses = DB::table('tb_statuses')
            ->where('id_statuses', $request->id_statuses)
            ->update(['nama_status' => $request->nama_status,
                        'color' => $request->color,
                        'order_status' => $request->order_status
                    ]);
        ?>
        <script type='text/javascript'>
            location.href= "/setupstatuses";
            alert('Edit Success');
        </script>
        <?php
    }

    public function delete($id_statuses){
        DB::table('tb_statuses')->where('id_statuses', '=', $id_statuses)->delete();
    }
}
