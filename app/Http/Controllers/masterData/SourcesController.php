<?php

namespace App\Http\Controllers\masterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sources;
use DB;

class SourcesController extends Controller
{
    public function index(){
    	return view('masterData.Sources.index')
    	->with('Sources',Sources::all());
    }

    public function add(Request $request){
    	$sources = new Sources;

    		$sources->nama_sources  = $request->nama_sources;

    	$sources->save();
        ?>
        <script type='text/javascript'>
            location.href= "/setupsources";
            alert('Save Success');
        </script>
        <?php
    }

    public function search($id_sources){
        $data = Sources::where('id_sources',$id_sources)->get();
        return json_encode($data);
    }

    public function edit(Request $request){
        $sources = DB::table('tb_sources')
            ->where('id_sources', $request->id_sources)
            ->update(['nama_sources' => $request->nama_sources]);
        ?>
        <script type='text/javascript'>
            location.href= "/setupsources";
            alert('Edit Success');
        </script>
        <?php
    }

    public function delete($id_sources){
        DB::table('tb_sources')->where('id_sources', '=', $id_sources)->delete();
    }
}
