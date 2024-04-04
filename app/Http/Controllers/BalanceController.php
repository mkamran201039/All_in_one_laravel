<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{


    /**
 * @OA\Post(
 *     path="/api/transfer-balance",
 *     tags={"Balance"},
 *     summary="Transfer balance from one user to another",
 *     operationId="transferBalance",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Data for transferring balance",
 *         @OA\JsonContent(
 *             required={"sender_username", "receiver_username", "amount"},
 *             @OA\Property(property="sender_username", type="string", example="sender_username"),
 *             @OA\Property(property="receiver_username", type="string", example="receiver_username"),
 *             @OA\Property(property="amount", type="number", format="float", example=100.00),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success response",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Balance transferred successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error response",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Balance transfer failed: Insufficient balance")
 *         )
 *     )
 * )
 */


    public function transfer(Request $request)
    {   
        $senderUsername = $request->sender_username;
        $receiverUsername = $request->receiver_username;
        $amount = $request->amount;

       
        DB::beginTransaction();

        try {
           
            $senderBalance = Balance::where('username', $senderUsername)->lockForUpdate()->first();
            $receiverBalance = Balance::where('username', $receiverUsername)->lockForUpdate()->first();

          
            if ($senderBalance->balance < $amount) {
                throw new \Exception('Insufficient balance');
            }

            
            $senderBalance->balance -= $amount;
            $receiverBalance->balance += $amount;

            
            $senderBalance->save();
            $receiverBalance->save();

         
            DB::commit();

            return response()->json(['message' => 'Balance transferred successfully']);
        } catch (\Exception $e) {
            
            DB::rollBack();
            
            return response()->json(['message' => 'Balance transfer failed: ' . $e->getMessage()], 500);
        }
    }
}

