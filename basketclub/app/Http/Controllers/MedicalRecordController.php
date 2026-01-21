<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
       /**
     * Show all medical records from table medical_records.
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::all();
        return response()->json($medicalRecords, 200);
    }

    /**
     * Show a medical record by id.
     */
    public function show(int $id) 
    {
        $medicalRecord = MedicalRecord::find($id);
        if($medicalRecord) {
            return response()->json($medicalRecord, 200);
        } else {
            return response()->json(['message' => 'Medical record not found'], 404);
        }
    }

    /**
     * Show a player medical record by id.
     */
    public function show_player(int $id) 
    {
        $medicalRecord = MedicalRecord::find($id);
        if($medicalRecord) {
            return response()->json($medicalRecord->player, 200);
        } else {
            return response()->json(['message' => 'Medical record not found'], 404);
        }
    }

        /**
     * Show user medical record by user id.
     */
    public function show_user_medical_record(int $id) 
    {
        $user = User::with(['medicalRecord', 'player'])->find($id); // incluimos ambos modelos para la respuesta
        if($user && $user->medicalRecord) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'Medical record not found'], 404);
        }
    }
}
