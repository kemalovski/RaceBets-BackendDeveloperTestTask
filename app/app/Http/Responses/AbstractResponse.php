<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResponse extends Response
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
