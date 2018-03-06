<?php

namespace App\Http\Controllers\masterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Roles;
use App\Department;
use DB;
use File;

class StaffController extends Controller
{
    public function index(){
    	$staff = DB::table('tb_staff as a')
            ->select('a.nama as nama','a.foto as foto','a.email as email','b.nama as roles','a.id_staff as id_staff','c.nama as nama_department','c.kota as kota','a.status as status')
            ->join('tb_roles as b', 'a.roles', '=', 'b.id_roles')
            ->join('tb_department as c', 'a.id_department', '=', 'c.id_department')
            ->get();
    	return view('masterData.Staff.index')
    	->with('Staff',$staff)
    	->with('Roles',Roles::all())
    	->with('Department',Department::all());
    }

    public function add(Request $request){
    	$file = $request->file('foto');
    	if($file){
    		$fileName   = date('FYhisA').'.jpg';
    		$request->file('foto')->move("img/staff/", $fileName);
    	} else {
    		$fileName   = 'images.jpg';
    	}
    	$hashed_password = password_hash($request->password, PASSWORD_DEFAULT);
    	$staff = new Staff;

    		$staff->nama  = $request->nama;
    		$staff->roles  = $request->roles;
    		$staff->id_department  = $request->id_department;
    		$staff->no_telp  = $request->no_telp;
    		$staff->alamat  = $request->alamat;
    		$staff->email  = $request->email;
    		$staff->foto  = $fileName;
    		$staff->password = $hashed_password;
    		$staff->status  = '';

    	$staff->save();
        ?>
        <script type='text/javascript'>
            location.href= "/setupstaff";
            alert('Save Success');
        </script>
        <?php
    }

    public function search($id_staff){
        $data = Staff::where('id_staff',$id_staff)->get();
        return json_encode($data);
    }

    public function edit(Request $request){
    	$file = $request->file('foto');
    	if($file){
    		$fileName   = date('FYhisA').'.jpg';
    		$request->file('foto')->move("img/staff/", $fileName);
    		if($request->foto_lama != 'images.jpg'){
    			File::delete('img/staff/'.$request->foto_lama);
    		}
    		DB::table('tb_staff')
            ->where('id_staff', $request->id_staff)
            ->update(['nama' => $request->nama,'email' => $request->email,'no_telp' => $request->no_telp,'alamat' => $request->alamat,'roles' => $request->roles,'id_department' => $request->id_department,'foto' => $fileName]);
    	} else {
    		DB::table('tb_staff')
            ->where('id_staff', $request->id_staff)
            ->update(['nama' => $request->nama,'email' => $request->email,'no_telp' => $request->no_telp,'alamat' => $request->alamat,'roles' => $request->roles,'id_department' => $request->id_department]);
    	}
        ?>
        <script type='text/javascript'>
            location.href= "/setupstaff";
            alert('Edit Success');
        </script>
        <?php
    }

    public function delete($id_staff){
    	$data = DB::table('tb_staff')->where('id_staff', '=', $id_staff)->get();
    	if($data[0]->foto != 'images.jpg'){
    		File::delete('img/staff/'.$data[0]->foto);
    	}
        DB::table('tb_staff')->where('id_staff', '=', $id_staff)->delete();
    }
}
