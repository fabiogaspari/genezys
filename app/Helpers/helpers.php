<?php
  
/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('apiResponse')) {
    function apiResponse(string $data, $status = 200)
    {
        return response()->json($data, $status);
    }
}