<?php

namespace App\Http\Controllers;

use App\Models\Barcode_Model;
use App\Models\Order_details_model;
use App\Models\Sale_Payble_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinTableController extends Controller
{
    public function showOrdersWithCustomerData()
    {
        $ordersWithCustomerData = Order_details_model::join('tbl_add_customer', 'tbl_order_details.contact_no', '=', 'tbl_add_customer.c_mobile_no')
            ->select('tbl_order_details.*', 'tbl_add_customer.*')
            ->get();

        // Return the data as a JSON response
        return response()->json([
            'data' => $ordersWithCustomerData,
        ]);
    }

    public function showOrdersWithCustomerContactandUniqueId($contact_no, $unique_id)
    {
        $ordersWithCustomerData = Order_details_model::join('tbl_add_customer', 'tbl_order_details.contact_no', '=', 'tbl_add_customer.c_mobile_no')
            ->where('tbl_order_details.contact_no', $contact_no)
            ->where('tbl_order_details.unique_id', $unique_id)
            ->select('tbl_order_details.*', 'tbl_add_customer.*')
            ->get();

        // Return the data as a JSON response
        return response()->json([
            'data' => $ordersWithCustomerData,
        ]);
    }

    public function showOrdersWithCustomerContact($contact_no)
    {
        $ordersWithCustomerData = Order_details_model::join('tbl_add_customer', 'tbl_order_details.contact_no', '=', 'tbl_add_customer.c_mobile_no')
            ->where('tbl_order_details.contact_no', $contact_no)
            ->select('tbl_order_details.*', 'tbl_add_customer.*')
            ->get();

        // Return the data as a JSON response
        return response()->json([
            'data' => $ordersWithCustomerData,
        ]);
    }

    public function showBarcodandWeight()
    {
        // Retrieve the combined data based on the order_no
        $combinedData = Barcode_Model::join('tbl_order_weight', 'tbl_order_barcode.order_no', '=', 'tbl_order_weight.order_no')
            ->select('tbl_order_barcode.*', 'tbl_order_weight.weight')
            ->get();
        // Return the data as a JSON response
        return response()->json([
            'data' => $combinedData,
        ]);
    }


    public function GeneralLedger($date1,$date2)
    {
                $post=DB::select("
                SELECT exp_date, exp_name, 0 AS exp_amt, exp_total_amt
        FROM tbl_expenses_details 
        where exp_date between '".$date1."' and '".$date2."'

        UNION ALL

        SELECT order_date, concat('Order No:',order_no), '0', grand_total
        FROM tbl_order_details 
        where order_date between '".$date1."' and '".$date2."'

        UNION ALL

        SELECT date, concat('Customer Name:' ,cust_name) , paid_amount, '0'
        FROM sale_payable
        where date between '".$date1."' and '".$date2."'

        UNION ALL

        SELECT date, concat('Purchase Invoice:',invoice_no), '0', grand_total
        FROM tbl_purchase_details
        where date between '".$date1."' and '".$date2."'

        UNION ALL

        SELECT date, concat('Supplier Name:',sup_name),  paid_amount, '0'
        FROM purchase_payable
        where date between '".$date1."' and '".$date2."'


        ORDER BY exp_date;
                ");

                return response()->json([
                    "message" => "Data Fetched successfully",
                    "status" => "Success",
                    "data" => $post
            
                    ]);
    }
    
    public function CustomerLedger($contact_no, $date1, $date2)
    {
        $post = DB::select("
            SELECT order_date, order_no, 0 AS sub_total, grand_total
            FROM tbl_order_details 
            WHERE order_date BETWEEN '".$date1."' AND '".$date2."'
            AND order_status IN ('Fulfilled', 'Delivered')
            AND contact_no = '".$contact_no."'
    
            UNION ALL
    
            SELECT date, CONCAT('Customer Name:', cust_name), 'paid_amount', '0'
            FROM sale_payable 
            WHERE date BETWEEN '".$date1."' AND '".$date2."'
            AND contact_no = '".$contact_no."'
    
            ORDER BY order_date;
        ");
    
        return response()->json([
            "message" => "Data Fetched successfully",
            "status" => "Success",
            "data" => $post
        ]);
    }

    public function SupplierLedger($contact_no, $date1, $date2)
    {
        $post = DB::select("
            SELECT date, invoice_no, grand_total,0 AS sub_total
            FROM tbl_purchase_details 
            WHERE date BETWEEN '".$date1."' AND '".$date2."'
            AND contact_no = '".$contact_no."'
    
            UNION ALL
    
            SELECT date, CONCAT('Supplier Name:', sup_name), '0', paid_amount
            FROM purchase_payable 
            WHERE date BETWEEN '".$date1."' AND '".$date2."'
            AND contact_no = '".$contact_no."'
    
            ORDER BY date;
        ");
    
        return response()->json([
            "message" => "Data Fetched successfully",
            "status" => "Success",
            "data" => $post
        ]);
    }
    



}