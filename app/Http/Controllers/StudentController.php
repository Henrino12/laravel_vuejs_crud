<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;
use Hash;


class StudentController extends Controller
{
    protected $student;
    public function __construct(){
        $this->student = new StudentModel();

    }
    public function index()
    {
       try {

        $students=$this->student->all();

        return response()->json([
            "status"=> 200,
            "message"=>"Liste des étudiants",
            "students"=>$students
        ]);

       } catch (\Exception $e) {

        return response()->json([
            "status"=> $e->getCode(),
                "message"=> $e->getMessage()
        ]);


       }
    }


    public function store(Request $request)
    {
        try {

            request()->validate([
                'name'=> 'required',
                'last_name'=> 'required',
                'address'=> 'required',
                'phone'=> 'required'
            ]);

            $student= StudentModel::create([
                'name' =>  trim($request->name),
                'last_name' => trim($request->last_name),
                'address' => trim($request->email),
                'phone' => trim($request->phone)

            ]);

            return response()->json([
                "status"=> 200,
                "message"=>"etudiant créer avec succès! ",
                "student"=>$student
            ]);

        }  catch (\Exception $e) {

            return response()->json([

                "status"=> $e->getCode(),
                "message"=> $e->getMessage()
            ]);
    }
}


    public function show(string $id)
    {
       try {
           $student = $this->student->find($id);
           return response()->json([
            "status"=> 200,
                "message"=>"les details de l'etudiant ",
                "student"=>$student

           ]);

       }  catch (\Exception $e) {

        return response()->json([

            "status"=> $e->getCode(),
                "message"=> $e->getMessage()
            ]);
}
    }


    public function update(Request $request, string $id)
    {
        try {

            request()->validate([
                'name'=> 'required',
                'last_name'=> 'required',
                'address'=> 'required',
                'phone'=> 'required'
            ]);

            $student= StudentModel::find($id);

            $student_updated= $student->update([
                'name' =>  trim($request->name),
                'last_name' => trim($request->last_name),
                'address' => trim($request->address),
                'phone' => trim($request->phone)

            ]);

            return response()->json([
                "status"=> 200,
                "message"=>"etudiant mis à jour  avec succès! ",
                "student"=>$student_updated
            ]);

        }  catch (\Exception $e) {

            return response()->json([

                "status"=> $e->getCode(),
                "message"=> $e->getMessage()
            ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     * la fonction de suppression d'un etudiant
     */
    public function destroy(string $id)
    {
       try {
        $student = $this->student->find($id);
        return response()->json([
            "status"=> 200,
            "message"=>"etudiant supprimé avec succès! ",
            "student"=>$student->delete()
        ]);
       } catch (\Exception $e) {

        return response()->json([

            "status"=> $e->getCode(),
            "message"=> $e->getMessage()
        ]);
}
    }
}