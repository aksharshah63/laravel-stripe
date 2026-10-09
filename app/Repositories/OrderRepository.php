<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    use OrderItemRepository;

    public function store(Request $request): Order
    {
        return DB::transaction(function () use ($request) {
            $order = new Order;
            $order->user_id = $request->user_id ?? 1;
            $order->reference_id = 'WT-'.uniqid().time().$order->user_id;
            $order->save();
            $this->storeItems($order, $request);
            $this->recalculateOrderTotal($order);

            return $order;
        });

    }

    private function recalculateOrderTotal(Order $order): void
    {
        $order->load('items');

        $order->tax = $order->items->sum('tax');

        $order->discount = $order->items->sum('discount');

        $order->sub_total = $order->items->sum('sub_total');

        $order->total = $order->items->sum('total');

        $order->save();
    }

    public function updateStatus(Order $order, string $status): Order
    {
        if (! in_array($status, [Order::STATUS_PENDING_PAYMENT, Order::STATUS_CONFIRMED, Order::STATUS_PARTIALLY_DELIVERED, Order::STATUS_CANCELLED, Order::STATUS_DELIVERED, Order::STATUS_READY_TO_SHIP, Order::STATUS_RTO, Order::STATUS_SHIPPED])) {
            throw new \InvalidArgumentException("Invalid status {$status}", 500);
        }

        if ($status == $order->status) {
            return $order;
        }
        $order->status = $status;
        $order->save();

        return $order;
    }
}
