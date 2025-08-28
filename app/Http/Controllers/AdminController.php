<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        $totalSales = 0;

        if ($request->has('daterange') && $request->daterange != '') {
            $dates     = explode(' - ', $request->daterange);
            $startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay();
            $endDate   = Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay();

            $query->whereBetween('islem_tarih', [$startDate, $endDate]);
        }

        $totalSales  = $query->sum('teklif_tl_tutar');
        $totalOrders = $query->count();

        $orders      = $query->orderBy('islem_tarih', 'desc')->take(10)->get();
        $orderdetail = OrderDetail::take(10)->get();

        return view('home', compact('orders', 'orderdetail', 'totalSales','totalOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
