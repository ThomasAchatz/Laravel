<?php
namespace App\Http\Controllers;
use App\Book;
use App\Order;
use App\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class OrderController extends Controller {
    public function index(){
        $order = Order::with(['books', 'stati', 'user'])->orderBy('user_id')->orderBy('created_at', 'DESC')->get();
        return $order;
    }

    public function getOrder(int $id){
        $order = Order::where('id', $id)->with(['books', 'stati', 'user'])->first();
        return $order;
    }
    public function getAllOrdersByUser($user_id){
        $order = Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->with(['books', 'stati', 'user'])->get();
        return $order;
    }

    public function saveOrder(Request $request) : JsonResponse  {
        $request = $this->parseRequest($request);
        DB::beginTransaction();
        try {
            $order = Order::create($request->all());
            if (isset($request['items']) && is_array($request['items'])) {
                foreach ($request['items'] as $items) {
                    $quantity = $items['quantity'];
                    $book = Book::firstOrNew(['isbn'=>$items['book']['isbn']]);
                    $order->books()->attach([$book['id'] => ['quantity' => $quantity]]);
                }
            }
            DB::commit();
            return response()->json($order, 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("order  failed: " . $e->getMessage(), 420);
        }
    }
    public function saveNewStatus(Request $request): JsonResponse{
        $request = $this->parseRequest($request);
        DB::beginTransaction();
        try {
            $status = Status::create($request->all());
            DB::commit();
            return response()->json($status, 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating status failed: " . $e->getMessage(), 420);
        }
    }
    private function parseRequest(Request $request) : Request {
        $date = new \DateTime($request->date);
        $request['date'] = $date;
        return $request;
    }
}