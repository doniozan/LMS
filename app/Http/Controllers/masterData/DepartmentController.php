<?php

namespace App\Http\Controllers\masterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use DB;

class DepartmentController extends Controller
{
    public function index(){
    	return view('masterData.Department.index')
    	->with('Department',Department::all());
    }

    public function add(Request $request){
    	$department = new Department;

    		$department->nama  = $request->nama;
    		$department->kota  = $request->kota;

    	$department->save();
        ?>
        <script type='text/javascript'>
            location.href= "/setupdepartment";
            alert('Save Success');
        </script>
        <?php
    }

    public function search($id_department){
        $data = Department::where('id_department',$id_department)->get();
        return json_encode($data);
    }

    public function edit(Request $request){
        $department = DB::table('tb_department')
            ->where('id_department', $request->id_department)
            ->update(['nama' => $request->nama,'kota' => $request->kota]);
        ?>
        <script type='text/javascript'>
            location.href= "/setupdepartment";
            alert('Edit Success');
        </script>
        <?php
    }

    public function delete($id_department){
        DB::table('tb_department')->where('id_department', '=', $id_department)->delete();
    }
}
