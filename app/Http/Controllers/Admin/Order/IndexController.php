<?php

namespace App\Http\Controllers\Admin\Order;

use App\Data\DataTableParamsData;
use App\Data\OrderData;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = OrderData::collection($this->orderRepository->table())->items();
        return view('admin.orders.index', compact('records'));
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
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => __('messages.data_not_saved')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
