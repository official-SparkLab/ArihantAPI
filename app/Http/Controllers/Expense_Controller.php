<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses_Model;

class Expense_Controller extends Controller
{
    public function Expense(Request $request)
    {
        $expense = new Expenses_Model;
        $expense->exp_name = $request->input('exp_name');
        $expense->exp_details = $request->input('exp_details');
        $expense->exp_date = $request->input('exp_date');
        $expense->exp_amt = $request->input('exp_amt');
        $expense->exp_total_amt = $request->input('exp_total_amt');
        $expense->exp_paid_status = $request->input('exp_paid_status');
        $expense->exp_note = $request->input('exp_note');
        $expense->save();


        if ($expense) {
            return response()->json(['message' => 'Data Added Succesfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to store data'], 500);
        }

    }
    //Fetch data from database
    public function fetchExpenseData()
    {
        $expenses = Expenses_Model::all();

        return response()->json([
            'data' => $expenses,
        ]);
    }

    // Delete Expense data 
    public function deleteExpenses($exp_id)
    {
        $expense = Expenses_Model::findOrFail($exp_id);
    
        $expense->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $expense->save();
    
        return response()->json([
            'message' => 'Expense  deleted',
        ]);
    }
    
  //Fetch Particular  data through id
  public function fetchDataById($exp_id)
  {
      $product = Expenses_Model::find($exp_id);
   
      if (!$product) {
          return response()->json([
              'message' => 'Product not found',
          ], 404);
      }
   
      return response()->json([
          'data' => $product,
      ]);
  }




    // update Expenses 
 public function updateExpense(Request $request, $exp_id)
{
    $expense = Expenses_Model::find($exp_id);

    if (!$expense) {
        return response()->json(['message' => 'Expense not found'], 404);
    }

    $expense->exp_name = $request->input('exp_name');
    $expense->exp_details = $request->input('exp_details');
    $expense->exp_date = $request->input('exp_date');
    $expense->exp_amt = $request->input('exp_amt');
    $expense->exp_total_amt = $request->input('exp_total_amt');
    $expense->exp_paid_status = $request->input('exp_paid_status');
    $expense->exp_note = $request->input('exp_note');
    $expense->save();

    return response()->json(['message' => 'Data Updated Successfully'], 200);
}




}