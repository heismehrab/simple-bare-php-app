<?php

namespace App\Kernel\Controller;

/**
 * Designed to bring utilities for
 * Application's controllers.
 */
class BaseController implements ControllerInterface
{
    /**
     * Provides a general response schema
     * for Http responses.
     *
     * @param bool $success
     * @param int $statusCode
     * @param array $data
     * @param string|array $messages
     * @param string|array $developerMessages
     *
     * @return string
     */
    public function response(
        bool $success = true,
        int $statusCode = 200,
        array $data = [],
        string|array $messages = [],
        string|array $developerMessages = []
    ): string {
        header('Content-Type: application/json; charset=utf-8');

        return json_encode([
            'success' => $success,
            'statusCode' => $statusCode,
            'data' => $data,
            'message' => $messages,
            'developerMessage' => $developerMessages
        ]);
    }
}