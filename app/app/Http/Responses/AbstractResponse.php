<?php

namespace App\Http\Responses;

abstract class AbstractResponse
{
    public $status;
    public $data;
    public $message;

    public function __construct(int $status, array $data = [], string $message)
    {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }
}
