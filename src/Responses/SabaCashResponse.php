<?php

namespace Alsharie\SabaCashPayment\Responses;


class SabaCashResponse
{
    protected $success = true;
    /**
     * Store the response data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Response constructor.
     */
    public function __construct($response)
    {
        $this->data = (array)json_decode($response, true);
    }


    /**
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @return array
     */
    public function body()
    {
        return $this->data;
    }

    public function isSuccess()
    {
        if (isset($this->data['source'])) {
            if (isset($this->data['source']['viral']) && isset($this->data['source']['isRegistered'])) {
                if ($this->data['source']['viral'] || !$this->data['source']['isRegistered'])
                    return false;
            }
        }
        if (isset($this->data['destination'])) {
            if (isset($this->data['destination']['viral']) && isset($this->data['destination']['isRegistered'])) {
                if ($this->data['destination']['viral'] || !$this->data['destination']['isRegistered'])
                    return false;
            }
        }

        if (isset($this->data['errors'])) {
            return false;
        }

        return $this->success;

    }


}