<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Http\Controllers\Controller;
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
}
