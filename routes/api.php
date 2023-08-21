<?php

use App\Http\Controllers\Barcode_Controller;
use App\Http\Controllers\Company_Controller;
use App\Http\Controllers\Customer_Controller;
use App\Http\Controllers\Enquiry_Controller;
use App\Http\Controllers\ExcelDataController;
use App\Http\Controllers\JoinTableController;
use App\Http\Controllers\Ordered_Product_Controller;
use App\Http\Controllers\Order_details_controller;
use App\Http\Controllers\Post_Data_Controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\PurchasedProductController;
use App\Http\Controllers\Purchase_Payble_Controller;
use App\Http\Controllers\Purchase_Payment_Controller;
use App\Http\Controllers\RohitController;
use App\Http\Controllers\Sale_Payble_Controller;
use App\Http\Controllers\Sale_Payment_Controller;
use App\Http\Controllers\Staff_Advance_Payment_Controller;
use App\Http\Controllers\Staff_Details_Controller;
use App\Http\Controllers\Staff_Payment_Controller;
use App\Http\Controllers\Supplier_Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Weight_Controller;
use App\Models\Barcode_Model;
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

Route::get('/fetchExpensesData/{exp_id}', [Expense_Controller::class, 'fetchDataById']);

Route::get('/fetchExpensesDataByDate/{startDate}/{endDate}', [Expense_Controller::class, 'fetchExpenseDatabyDate']);


Route::delete('/deleteExpenseData/{exp_id}', [Expense_Controller::class, 'deleteExpenses']);

Route::put('/expenses/{exp_id}',[Expense_Controller::class, 'updateExpense']);


// Products Routings___________________________________________
Route::post('/addProduct', [Product_Controller::class, 'addProduct']);

Route::get('/fetchProducData', [Product_Controller::class, 'fetchProducData']);

Route::get('/fetchProducData/{p_id}', [Product_Controller::class, 'fetchDataById']);

Route::put('/addProduct/{p_id}', [Product_Controller::class, 'updateProductData']);

Route::delete('/deleteProductData/{p_id}', [Product_Controller::class, 'deleteProductData']);


// Supplier Routings_____________________________________________

Route::post('/addSupplier', [Supplier_Controller::class, 'addSupplier']);

Route::get('/fetchSuppliersData', [Supplier_Controller::class, 'fetchSuppliersData']);

Route::get('/fetchSuppliersData/{s_name}', [Supplier_Controller::class, 'fetchDataById']);

Route :: get('/fetchSupplierByContact/{s_mobile_no}', [Supplier_Controller::class,'fetchsupplier']);

Route::put('/addSupplier/{s_id}',[Supplier_Controller::class, 'updateSupplier']);

Route::delete('/deleteSupplierData/{s_id}', [Supplier_Controller::class, 'deleteSupplierData']);


//Customer Routings__________________________________________________

Route::post('/addCustomer', [Customer_Controller::class, 'addCustomer']);

Route::get('/fetchCustomersData', [Customer_Controller::class, 'fetchCustomersData']);

Route::get('/fetchCustomersData/{c_id}', [Customer_Controller::class, 'fetchDataById']);

Route::delete('/deleteCustomerData/{c_id}', [Customer_Controller::class, 'deleteCustomerData']);

Route :: put('/addCustomer/{c_id}', [Customer_Controller::class,'updateCustomer']);

Route :: get('/fetchCustomersByContact/{c_mobile_no}', [Customer_Controller::class,'fetchCustomers']);



//Company Details Routings_______________________________________________

Route::post('/addCompany', [Company_Controller::class, 'addCompany']);

Route::get('/fetchCompanyData', [Company_Controller::class, 'fetchCompanyData']);

Route::get('/fetchCompanyData/{c_id}', [Company_Controller::class, 'fetchDataById']);

Route :: put('/addCompany/{c_id}', [Company_Controller::class,'updateCompany']);

Route::delete('/deleteCompanyData/{c_id}', [Company_Controller::class, 'deleteCompanyData']);


// Staff Details Routings__________________________________________________

Route::post('/addStaff', [Staff_Details_Controller::class, 'addStaff']);

Route::get('/fetchStaffData', [Staff_Details_Controller::class, 'fetchStaffData']);

Route::get('/fetchStaffData/{s_id}', [Staff_Details_Controller::class, 'fetchDataById']);

Route :: put('/addStaff/{s_id}', [Staff_Details_Controller::class,'updateStaff']);


Route::delete('/deleteStaffData/{s_id}', [Staff_Details_Controller::class, 'deleteStaffData']);

// Staff Payment Routing___________________________________________________

Route::post('/addStaffPayment', [Staff_Payment_Controller::class, 'addStaffPayment']);

Route::get('/fetchStaffPaymentData', [Staff_Payment_Controller::class, 'fetchStaffPaymentData']);

Route::get('/fetchStaffPaymentData/{p_id}', [Staff_Payment_Controller::class, 'fetchDataById']);

Route :: put('/addStaffPayment/{p_id}', [Staff_Payment_Controller::class,'updateData']);


Route::delete('/deleteStaffPaymentData/{p_id}', [Staff_Payment_Controller::class, 'deleteStaffPaymentData']);


// Staff Advanced Payment Routings__________________________________________

Route::post('/addStaffAdvancedPayment', [Staff_Advance_Payment_Controller::class, 'addStaffAdvancedPayment']);

Route::get('/fetchStaffAdvancedPaymentData', [Staff_Advance_Payment_Controller::class, 'fetchStaffAdvancedPaymentData']);

Route::get('/fetchStaffAdvancedPaymentData/{p_id}', [Staff_Advance_Payment_Controller::class, 'fetchDataById']);

Route :: put('/addStaffAdvancedPayment/{p_id}', [Staff_Advance_Payment_Controller::class,'updateData']);

Route::delete('/deleteStaffAdvancedPaymentData/{p_id}', [Staff_Advance_Payment_Controller::class, 'deleteStaffAdvancedPaymentData']);

// Enquiry Routings______________________________________________________________

Route::post('/addEnquiry', [Enquiry_Controller::class, 'addEnquiry']);

Route::get('/fetchEnquiryData', [Enquiry_Controller::class, 'fetchEnquiryData']);

Route::get('/fetchEnquiryData/{e_id}', [Enquiry_Controller::class, 'fetchDataById']);

Route :: put('/addEnquiry/{e_id}', [Enquiry_Controller::class,'updateEnquiry']);

Route::delete('/deleteEnquiryData/{e_id}', [Enquiry_Controller::class, 'deleteEnquiryData']);

Route :: put('/addReason/{e_id}', [Enquiry_Controller::class,'addReason']);





// Product order Routings

Route::post('/productOrder',[Ordered_Product_Controller::class,'addOrder']);

Route::put('/updateProductOrder/{unique_id}',[Ordered_Product_Controller::class,'updateOrder']);

Route::post('/addOrder',[Order_details_controller::class,'addOrder']);

Route::put('/updateOrderDetails/{unique_id}',[Order_details_controller::class,'updateOrder']);

Route::put('/cancleOrder/{unique_id}',[Order_details_controller::class,'addReason']);

Route::get('/outbond/{date1}/{date2}',[Order_details_controller::class,'IntransitOrders']);




Route::get('/fetchOrder',[Order_details_controller::class,'fetchOrderDetailsData']);

Route::delete('/deleteOrderdProduct/{unique_id}/{p_id}',[Ordered_Product_Controller::class,'deleteOrderdProduct']);

Route::get('/fetchOrderedProduct/{unique_id}',[Ordered_Product_Controller::class,'fetchOrderedProduct']);


Route::get('/fetchOrderCount',[Order_details_controller::class,'fetchOrderDetailsData1']);


// Purchased Routing

Route::post('/addPurchasedProduct',[PurchasedProductController::class,'store']);

Route::get('/fetch_all_purchased_Products',[PurchasedProductController::class,'fetchall']);

Route::get('/fetch_purchased_product/{invoice_no}',[PurchasedProductController::class,'show']);

Route::put('/updatePurchasedproduct/{invoice_no}',[PurchasedProductController::class,'updatePurchaseProduct']);

Route::delete('/deletePurchasedProduct/{invoice_no}/{p_id}',[PurchasedProductController::class,'deletePurchasedProduct']);


//PurchDetails Routing

Route::post('/addPurchasedDetails',[PurchaseDetailController::class,'store']);

Route::get('/fetch_all_purchased_details',[PurchaseDetailController::class,'index']);

Route::get('/fetch_purchased_details/{invoice_no}',[PurchaseDetailController::class,'show']);

Route::put('/updatePurchaseDetails/{invoice_no}',[PurchaseDetailController::class,'updatePurchase']);




// Barcode and Weight Routing

Route::post('/addWeight',[Weight_Controller::class,'addWeight']);

Route::post('/addBarcode',[Barcode_Controller::class,'addBarcode']);

Route::get('/orderWithBarcode',[JoinTableController::class,'showOrdersWithBarcode']);


// Shiped and Delivered Order Routing

Route::put('/shippeOrder/{unique_id}',[Order_details_controller::class,'shipOrder']);

Route::put('/deliverOrder{unique_id}',[Order_details_controller::class,'deliverOrder']);


// Joining order details and customer details

Route::get('/fetchOrderDetails',[JoinTableController::class,'showOrdersWithCustomerData']);

Route::get('/fetchOrderDetailsBy/{contact_no}',[JoinTableController::class,'showOrdersWithCustomerContact']);

Route::get('/fetchOrderDetails/{contact_no}/{unique_id}',[JoinTableController::class,'showOrdersWithCustomerContactandUniqueId']);


Route::get('/fetchBarcodeandWeight',[JoinTableController::class,'showBarcodandWeight']);

Route::get('/fetchBarcode/{unique_id}',[Barcode_Controller::class,'fetchBarcode']);

Route::get('/fetchWeight/{unique_id}',[Weight_Controller::class,'fetchWeight']);

Route::get('/generalLedger/{date1}/{date2}',[JoinTableController::class,'GeneralLedger']);

Route::get('/customerLedger/{contact_no}/{date1}/{date2}',[JoinTableController::class,'CustomerLedger']);

Route::get('/supplierLedger/{contact_no}/{date1}/{date2}',[JoinTableController::class,'SupplierLedger']);






//User Routing 

Route::post('/addUser',[UserController::class,'createUser']);

Route::get('/fetchUser',[UserController::class,'fetchUsers']);

Route::put('/updateUser/{user_id}',[UserController::class,'updateUser']);

Route::delete('/deleteuser/{user_id}',[UserController::class,'deleteUserData']); 

Route::get('/userById/{user_id}',[UserController::class,'fetchDataById']);

Route::post('/userLogin',[UserController::class,'login']);


// Sale Payble and Purchase Payble routing

Route::post('/addPurchase',[Purchase_Payble_Controller::class,'addPurchaseData']);

Route::get('/getPurchase',[Purchase_Payble_Controller::class,'getPurchaseDetails']);

Route::get('/getPurchase/{contact_no}',[Purchase_Payble_Controller::class,'fetchByContact']);


Route::post('/addSale',[Sale_Payble_Controller::class,'addSaleData']);

Route::get('/getSale',[Sale_Payble_Controller::class,'getsaleDetails']);

Route::get('/getSale/{contact_no}',[Sale_Payble_Controller::class,'fetchByContact']);


// Purchase and Sale Payment Routings

Route::get('/getPurchasePayment/{invoice_no}',[Purchase_Payment_Controller::class,'fetchPayment']);

Route::get('/getSalePayment/{order_no}',[Sale_Payment_Controller::class,'fetchPayment']);

Route::post('/addPurchasePayment',[Purchase_Payment_Controller::class,'addPayment']);

Route::post('/addSalePayment',[Sale_Payment_Controller::class,'addPayment']);

Route::post('/addPostData',[Post_Data_Controller::class,'addPostData']);
