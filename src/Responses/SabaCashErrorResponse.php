<?php

namespace Alsharie\SabaCashPayment\Responses;


class SabaCashErrorResponse extends SabaCashResponse
{
    protected $success = false;

    public function __construct($response, $status)
    {
        $this->data = (array) json_decode($response);
        $this->data['status_code'] = $status;
    }


}