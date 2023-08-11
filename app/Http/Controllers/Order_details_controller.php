<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order_details_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Order_details_controller extends Controller
{
    //

    public function addOrder(Request $request)
    {
        try {
            // Execute the SQL statement using the DB facade
            $result = DB::statement("CALL order_details(?,?, ?, ?, ?, ?, ?, ?, ?, @order_num)", [
                $request->input('unique_id'),
                $request->input('today'),
                $request->input('order_type'),
                $request->input('contactNo'),
                $request->input('sub_total'),
                $request->input('discount'),
                $request->input('grand_total'),
                $request->input('payment_mode'),
                $request->input('order_status'),
            ]);

            if ($result) {
                return response()->json(["Message" => "Order Added"]);
            } else {
                return response()->json(["Message" => "Order Not Added"]);
            }
        } catch (\Exception $e) {
            return response()->json(["Message" => "Error: " . $e->getMessage()]);
        }
    }


    public function updateOrder(Request $request, $unique_id)
    {
        $order = Order_details_model::where('unique_id', $unique_id)->first();

        if (!$order) {
            return response()->json(['Message' => 'Order not found']);
        }


        $order->order_date = $request->input('order_date');

        $order->order_type = $request->input('order_type');
        $order->contact_no = $request->input('contactNo');
        $order->sub_total = $request->input('sub_total');
        $order->discount = $request->input('discount');
        $order->grand_total = $request->input('grand_total');
        $order->payment_mode = $request->input('payment_mode');
        $order->order_status = $request->input('order_status');

        $order->save();

        return response()->json(['Message' => 'Order updated successfully']);
    }


    //Fetch data from database
    public function fetchOrderDetailsData()
    {
        $orders = Order_details_model::all();

        return response()->json([
            'data' => $orders,
        ]);
    }

    public function getOrderStatusLength($order_status)
    {
        $statusCount = Order_details_model::where('order_status', $order_status)->count();

        return response()->json([
            'status' => $order_status,
            'status_count' => $statusCount,
        ]);
    }

    public function fetchOrderDetailsData1()
    {
        $totalOrderCount = Order_details_model::count();
        $cancelOrderCount = $this->getOrderStatusLength('Cancelled');
        $deliveredOrderCount = $this->getOrderStatusLength('Delivered');
        $fulfilledOrderCount = $this->getOrderStatusLength('Fulfilled');
        $returnOrderCount = $this->getOrderStatusLength('Returned');


        return response()->json([
            'cancel_orders_count' => $cancelOrderCount,
            'return_orders_count' => $returnOrderCount,
            'delivered_orders_count' => $deliveredOrderCount,
            'fulfilled_orders_count' => $fulfilledOrderCount,
            'total_orders_count' => $totalOrderCount,


        ]);
    }





    // Update order status and add cancel reason 

    public function addReason(Request $request, $unique_id)
    {
        $order = Order_details_model::where('unique_id', $unique_id)->first();

        if (!$order) {
            return response()->json(['Message' => 'Order not found']);
        }

        $order->order_status = "Cancelled";
        $order->cancel_reason = $request->input('cancel_reason');

        $order->save();

        return response()->json([
            'message' => 'Order Cancelled Successfully',
        ]);

    }



    // Ship Order 
    public function shipOrder($unique_id)
    {
        $order = Order_details_model::where('unique_id', $unique_id)->first();

        if (!$order) {
            return response()->json(['Message' => 'Order not found']);
        }

        $order->order_status = "In transit";
        $order->save();

        return response()->json([
            'message' => 'Order Shipped Successfully',
        ]);

    }


    // Deleverd Successfully
    public function deliverOrder($unique_id)
    {
        $order = Order_details_model::where('unique_id', $unique_id)->first();

        if (!$order) {
            return response()->json(['Message' => 'Order not found']);
        }

        $order->order_status = "Delivered";
        $order->save();

        return response()->json([
            'message' => 'Order Delivered Successfully',
        ]);

    }



    public function IntransitOrders($date1, $date2)
    {
        $post = DB::select("
        SELECT * from tbl_add_customer
        join tbl_order_details ON tbl_add_customer.c_mobile_no in (select tbl_order_details.contact_no from tbl_order_details WHERE order_status ='In transit' AND order_type ='Postal Order' AND (order_date BETWEEN '".$date1."' AND '".$date2."'))
         join tbl_order_barcode on tbl_order_details.order_no = tbl_order_barcode.order_no
         join tbl_order_weight on tbl_order_details.order_no = tbl_order_weight.order_no;
        ");

        return response()->json([
            "data" => $post
        ]);
    }
}