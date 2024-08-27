<?php

namespace App\Models;

/**
 * Base Model
 * ---
 * The base model provides a space to set atrributes
 * that are common to all models
 */
class Model extends \Leaf\Model
{
    protected $retVal = [];

    public function setRetval($name, $val) {
        $this->retVal[$name] = $val;
        return $this;
    }

    public function getRetval($name = null) {
        return is_null($name) ? $this->retVal : $this->retVal[$name] ?? '';
    }
}
