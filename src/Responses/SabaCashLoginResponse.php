<?php

namespace Alsharie\SabaCashPayment\Responses;


class SabaCashLoginResponse extends SabaCashResponse
{

    /**
     * @return mixed|void
     */
    public function getToken()
    {
        if (!empty($this->data['token'])) {
            return $this->data['token'];
        }

    }




}