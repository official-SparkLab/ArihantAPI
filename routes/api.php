<?php

use App\Http\Controllers\Company_Controller;
use App\Http\Controllers\Customer_Controller;
use App\Http\Controllers\Enquiry_Controller;
use App\Http\Controllers\Ordered_Product_Controller;
use App\Http\Controllers\Order_Details_Controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\Staff_Advance_Payment_Controller;
use App\Http\Controllers\Staff_Details_Controller;
use App\Http\Controllers\Staff_Payment_Controller;
use App\Http\Controllers\Supplier_Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Expense_Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Expenses Routings ________________________________________
Route::post('/expenses', [Expense_Controller::class, 'Expense']);

Route::get('/fetchExpensesData', [Expense_Controller::class, 'fetchExpenseData']);

Route::delete('/deleteExpenseData/{exp_id}', [Expense_Controller::class, 'deleteExpenses']);

Route::put('/expenses/{exp_id}',[Expense_Controller::class, 'updateExpense']);


// Products Routings___________________________________________
Route::post('/addProduct', [Product_Controller::class, 'addProduct']);

Route::get('/fetchProducData', [Product_Controller::class, 'fetchProducData']);

Route::delete('/deleteProductData/{p_id}', [Product_Controller::class, 'deleteProductData']);


// Supplier Routings_____________________________________________

Route::post('/addSupplier', [Supplier_Controller::class, 'addSupplier']);

Route::get('/fetchSuppliersData', [Supplier_Controller::class, 'fetchSuppliersData']);

Route::delete('/deleteSupplierData/{s_id}', [Supplier_Controller::class, 'deleteSupplierData']);


//Customer Routings__________________________________________________

Route::post('/addCustomer', [Customer_Controller::class, 'addCustomer']);

Route::get('/fetchCustomersData', [Customer_Controller::class, 'fetchCustomersData']);

Route::delete('/deleteCustomerData/{c_id}', [Customer_Controller::class, 'deleteCustomerData']);

Route :: put('/updateCustomer/{c_id}', [Customer_Controller::class,'updateCustomer']);

Route :: get('/fetchCustomersData/{c_mobile_no}', [Customer_Controller::class,'fetchCustomers']);



//Company Details Routings_______________________________________________

Route::post('/addCompany', [Company_Controller::class, 'addCompany']);

Route::get('/fetchCompanyData', [Company_Controller::class, 'fetchCompanyData']);

Route::delete('/deleteCompanyData/{c_id}', [Company_Controller::class, 'deleteCompanyData']);


// Staff Details Routings__________________________________________________

Route::post('/addStaff', [Staff_Details_Controller::class, 'addStaff']);

Route::get('/fetchStaffData', [Staff_Details_Controller::class, 'fetchStaffData']);

Route::delete('/deleteStaffData/{s_id}', [Staff_Details_Controller::class, 'deleteStaffData']);

// Staff Payment Routing___________________________________________________

Route::post('/addStaffPayment', [Staff_Payment_Controller::class, 'addStaffPayment']);

Route::get('/fetchStaffPaymentData', [Staff_Payment_Controller::class, 'fetchStaffPaymentData']);

Route::delete('/deleteStaffPaymentData/{p_id}', [Staff_Payment_Controller::class, 'deleteStaffPaymentData']);


// Staff Advanced Payment Routings__________________________________________

Route::post('/addStaffAdvancedPayment', [Staff_Advance_Payment_Controller::class, 'addStaffAdvancedPayment']);

Route::get('/fetchStaffAdvancedPaymentData', [Staff_Advance_Payment_Controller::class, 'fetchStaffAdvancedPaymentData']);

Route::delete('/deleteStaffAdvancedPaymentData/{p_id}', [Staff_Advance_Payment_Controller::class, 'deleteStaffAdvancedPaymentData']);

// Enquiry Routings______________________________________________________________

Route::post('/addEnquiry', [Enquiry_Controller::class, 'addEnquiry']);

Route::get('/fetchEnquiryData', [Enquiry_Controller::class, 'fetchEnquiryData']);

Route::delete('/deleteEnquiryData/{e_id}', [Enquiry_Controller::class, 'deleteEnquiryData']);

Route :: put('/addReason/{e_id}', [Enquiry_Controller::class,'addReason']);





// Product order Routings

Route::post('/productOrder',[Ordered_Product_Controller::class,'addOrder']);

Route::post('/addOrder',[Order_details_controller::class,'addOrder']);

Route::get('/fetchOrder',[Order_details_controller::class,'fetchOrderDetailsData']);