<?php

function apiError(
    $message,
    $error,
    $code,
) {
    $response = [
        'success' => false,
        'message' => $message,
        'error' => $error,
    ];

    return response()->json($response, $code);
}
