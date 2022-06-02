<?php

namespace App\Http\Response;

class ResponseJson
{

    public function success($request)
    {
        return response()->json([
            'success' => true,
            'message' => "Request successfully proceed",
            'data' => $request
        ], 200);
    }
    public function unauthorized($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
        ], 401);
    }
    public function not_found($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
        ], 404);
    }
}
