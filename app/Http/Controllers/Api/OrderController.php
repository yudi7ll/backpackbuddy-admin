<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MakeOrderRequest;
use App\Http\Resources\OrderResource;
use App\Itinerary;
use App\Order;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Storage;

class OrderController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get all the customer orders
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Auth::user()->orders()->latest()->get();
        return OrderResource::collection($data);
    }

    /**
     * Get the receipt image
     *
     * @param string $filename
     * @return Binary
     */
    public function getReceiptImage($filename)
    {
        $storage = Storage::disk('public');
        $path = "receipt/$filename";

        if (!$storage->exists($path)) {
            abort(404);
        }

        $file = $storage->get($path);
        $type = $storage->mimeType($path);

        return response()->make($file)->header('Content-Type', $type);
    }

    /**
     * Make a new order by given data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MakeOrderRequest $request)
    {
        $data = $request->all();
        $itinerary = Itinerary::find($request->itinerary_id);
        $data['code'] = uniqid();
        $data['price'] = $itinerary->sale ?: $itinerary->price;

        if (Auth::user()->orders()->where('itinerary_id', $data['itinerary_id'])->exists()) {
            return response()->json(['message' => 'This itinerary already in orders'], 402);
        }

        return Auth::user()->orders()->create($data);
    }

    /**
     * Upload the payment proof screenshot
     *
     * @param App\Order $order
     */
    public function uploadReceipt(Request $request, Order $order)
    {
        $request->validate([
            'receipt' => 'required|image|mimes:jpeg,png,gif,webp|max:9000'
        ]);

        try {
            $file = $request->file('receipt');
            $filename = "order-{$order->id}.{$file->extension()}";

            $file->storeAs("public/receipt", $filename);

            $order->receipt = $filename;
            $order->receipt_uploaded_at = now();
            $order->status = 4;
            $order->save();

            return new OrderResource($order);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ])->status(500);
        }
    }

    public function isExist($itineraryId)
    {
        return response()->json([
            'exist' => Auth::user()->orders()->where('itinerary_id', $itineraryId)->exists()
        ]);
    }
}
