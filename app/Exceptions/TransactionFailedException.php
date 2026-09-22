<?php

namespace App\Exceptions;

use Exception;

class TransactionFailedException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage()
        ], 422);
    }
}
