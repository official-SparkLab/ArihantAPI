<?php
namespace App\Http\Controllers;

use App\Models\ExcelRecord;
use Illuminate\Http\Request;

class ExcelDataController extends Controller
{
    public function saveData(Request $request)
    {
        $data = $request->input('data');

        if (!empty($data)) {
            foreach ($data as $record) {
                // Assuming the data has 'name', 'email', and 'phone' fields
                ExcelRecord::create([
                    'assignment' => $record['assignment'],
                    'doc_type' => $record['doc_type'],
                    'doc_date' => $record['doc_date'],
                    'amount' => $record['amount'],
                    'profit_center' => $record['profit_center'],
                    'doc_no' => $record['doc_no'],

                ]);
            }

            return response()->json(['message' => 'Data inserted successfully']);
        } else {
            return response()->json(['message' => 'No data to add to the database.'], 400);
        }
    }
}
