<?php

namespace App\Http\Controllers\Admin\Order;

use App\Data\OrderData;
use App\Filters\OrdersSearchFilter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\ExportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrdersSearchFilter $filter,
        private readonly ExportService $exportService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('action') && request()->get('action') == 'export') {
            return $this->exportService->execute($this->filter, $this->orderRepository);
        }
        $records = OrderData::collection($this->orderRepository->table($this->filter)->paginate()->appends(request()->query()))->items();
        return view('admin.orders.index', compact('records'), ['filter' => $this->filter]);
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
