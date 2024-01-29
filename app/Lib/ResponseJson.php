<?php

namespace App\Lib;

use Illuminate\View\View;

/**
 * Description of ResponseJson
 *
 */
class ResponseJson
{

    public function __construct(
        protected bool $type,
        protected string $message,
        protected int $code,
        protected array $result = [],
        protected string $view = ''
    ) {
    }

    public function getResponse()
    {
        $data = [
            'type' => $this->type,
            'message' => $this->message,
            'data' => $this->result,
            'html' => $this->view
        ];
        return response()->json($data, $this->code);
    }
}
