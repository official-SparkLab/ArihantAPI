<?php

namespace App\Http\Controllers;

use App\Models\Barcode_Model;
use App\Models\Order_details_model;
use App\Models\Sale_Payble_Model;
use Illuminate\Http\Request;

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


    public function fetchCombinedDataBetweenDates($contact_no, $fromDate, $toDate)
    {
        $sales = Sale_Payble_Model::where('sale_payable.contact_no', $contact_no)
            ->join('tbl_order_details', 'sale_payable.contact_no', '=', 'tbl_order_details.contact_no')
            ->whereIn('tbl_order_details.order_status', ['Delivered', 'Fulfilled'])
            ->whereBetween('sale_payable.date', [$fromDate, $toDate])
            ->whereBetween('tbl_order_details.order_date', [$fromDate, $toDate])
            ->select('sale_payable.date', 'sale_payable.cust_name', 'sale_payable.paid_amount', 'sale_payable.created_at', 'tbl_order_details.order_date', 'tbl_order_details.order_no', 'tbl_order_details.grand_total', 'tbl_order_details.created_at')
            ->get();
    
        $orderDetails = [];
        $saleDetails = [];
    
        foreach ($sales as $sale) {
            $orderDetails[] = [
                'order_date' => $sale->order_date,
                'order_no' => $sale->order_no,
                'grand_total' => $sale->grand_total,
                'created_at' => $sale->created_at,
            ];
    
            $saleDetails[] = [
                'date' => $sale->date,
                'cust_name' => $sale->cust_name,
                'paid_amount' => $sale->paid_amount,
                'created_at' => $sale->created_at,
            ];
        }
    
        return response()->json([
            "order_details" => $orderDetails,
            "sale_details" => $saleDetails,
        ], 200);
    }
    



}