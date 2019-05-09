<?php


class Fighter
{
    public function __construct($s)
    {
        $this->_type = $s;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }
    private $_type = "";
}