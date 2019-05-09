<?php

require_once 'Color.class.php';


class Vertex
{
    public function __construct(array $construct)
    {
        if (array_key_exists("x", $construct)) {
            $this->_x = (double)$construct["x"];
        }
        if (array_key_exists("y", $construct)) {
            $this->_y = (double)$construct["y"];
        }
        if (array_key_exists("z", $construct)) {
            $this->_z = (double)$construct["z"];
        }
        if (array_key_exists("w", $construct)) {
            $this->_w = (double)$construct["w"];
        }
        if (array_key_exists("color", $construct)) {
            $this->_color = $construct["color"];
        }
        else {
            $this->_color = new Color(array("rgb" => 0x00ffffff));
        }
        if (Vertex::$verbose)
            print ($this." constructed\n");
    }
    public function __toString()
    {
        if (Vertex::$verbose) {
            return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
        }
        else {
            return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
        }
    }
    static public function doc() {
        return (file_get_contents("Vertex.doc.txt"));
    }
    public function __destruct()
    {
        if (Vertex::$verbose)
            print ($this." destructed\n");
    }
    private $_x = 0;
    private $_y = 0;
    private $_z = 0;
    private $_w = 1.0;
    private $_color;
    static public $verbose = False;

    /**
     * @return float|int
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @return float|int
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @return float|int
     */
    public function getZ()
    {
        return $this->_z;
    }

    /**
     * @return float
     */
    public function getW()
    {
        return $this->_w;
    }

    /**
     * @return Color
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @param float|int $x
     */
    public function setX($x)
    {
        $this->_x = (double)$x;
    }

    /**
     * @param float|int $y
     */
    public function setY($y)
    {
        $this->_y = (double)$y;
    }

    /**
     * @param float|int $z
     */
    public function setZ($z)
    {
        $this->_z = (double)$z;
    }

    /**
     * @param float $w
     */
    public function setW($w)
    {
        $this->_w = (double)$w;
    }

    /**
     * @param Color $color
     */
    public function setColor(Color $color)
    {
        $this->_color = $color;
    }
}