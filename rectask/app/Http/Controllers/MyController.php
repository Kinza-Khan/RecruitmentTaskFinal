<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function insertStudent(Request $req){
       $file = $req->file('image');
       $req->validate([
        "name"=>"required",
        "email"=>"required",
        "password"=>"required",
        "image"=>"required|image:jpg,png,jpeg|max:3000"
       ]);
       $fileName = time()."_".$file->getClientOriginalName();
       $path = $req->file('image')->storeAs('image',$fileName,'public');
       $student = DB::table('students')->insert([
        'name'=>$req->name,
        'email'=>$req->email,
        'password'=>$req->password,
        'image'=>$fileName
       ]);
       if($student){
        echo  "<script>alert('student added successfully')</script>";  
        return redirect('select');
    }
    else{
        echo  "<h1>student not added</h1>";  
    }
    }

        public function selectAllStudents(){
            $student = DB::table('students')->get();
            return view('select',compact('student'));
        }

        public function editStudent($id){
                $std = DB::table('students')->find($id);
                return view('edit',compact('std'));
    
        }

        public function updateStudent(Request $req, $id){
            $req->validate([
                "name"=>"required",
                "email"=>"required",
                "password"=>"required",
            ]);
        
            $student = DB::table('students')->where('id', $id)->first();
        
            if (!$student) {
                echo "<h1>Student not found</h1>";
                return;
            }
        
            $fileName = $student->image;
        
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $req->validate([
                    "image"=>"image:jpg,png,jpeg|max:3000"
                ]);
        
                if ($file->isValid()) {
                    $fileName = time()."_".$file->getClientOriginalName();
                    $path = $req->file('image')->storeAs('image', $fileName, 'public');
                } else {
                    echo "<h1>Invalid image</h1>";
                    return;
                }
            }
        
            $update = DB::table('students')->where('id', $id)->update([
                'name' => $req->name,
                'email' => $req->email,
                'password' => $req->password,
                'image' => $fileName
            ]);
        
            if($update){
                echo "<script>alert('Student updated successfully')</script>";
                return redirect('select');
            } else {
                echo "<h1>Student not updated</h1>";
            }
        }


        function delete($id){
            $std = DB::table('students')->where('id',$id)->delete();
            if( $std){
                return redirect('select');
        }
        else{
            echo  "<h1>not deleted successfully</h1>";
        }
        }   

           
}
