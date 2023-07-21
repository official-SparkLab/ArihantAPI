<?php
namespace App\Http\Controllers;

use App\Models\ExcelRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ExcelDataController extends Controller
{
 
    public function saveData(Request $request)
    {
        // Validate the file upload
        $validator = validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls|max:2048' // Adjust the max file size as needed
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid file or file format'], 400);
        }
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('temp'); // This will store the file in the "temp" folder within the storage/app directory
    
            // Now, you can use a library like Laravel Excel or PhpSpreadsheet to read the data from the Excel file.
            // I'll assume you are using Laravel Excel for this example:
    
            $data = \Maatwebsite\Excel\Facades\Excel::toArray([], $path);
    
            if (empty($data)) {
                return response()->json(['message' => 'No data found in the Excel file'], 400);
            }
    
            foreach ($data as $sheet) {
                foreach ($sheet as $record) {
                    // Assuming the data has 'assignment', 'doc_type', 'doc_date', 'amount', 'profit_center', and 'doc_no' fields
                    ExcelRecord::create([
                        'assignment' => $record['assignment'],
                        'doc_type' => $record['doc_type'],
                        'doc_date' => $record['doc_date'],
                        'amount' => $record['amount'],
                        'profit_center' => $record['profit_center'],
                        'doc_no' => $record['doc_no'],
                    ]);
                }
            }
    
            return response()->json(['message' => 'Data inserted successfully']);
        }
    
        return response()->json(['message' => 'No file uploaded.'], 400);
    }
    
}
