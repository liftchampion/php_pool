<?php


class Vector
{
    static public function doc() {
        return (file_get_contents("Vector.doc.txt"));
    }
    public function __construct(array $construct)
    {
        if (array_key_exists("orig", $construct)) {
            $s = $construct["orig"];
        }
        else {
            $s = new Vertex(array(
                "x" => 0,
                "y" => 0,
                "z" => 0));
        }
        if (array_key_exists("dest", $construct)) {
            $this->_x = (double)$construct["dest"]->getX() - (double)$s->getX();
            $this->_y = (double)$construct["dest"]->getY() - (double)$s->getY();
            $this->_z = (double)$construct["dest"]->getZ() - (double)$s->getZ();
        }
        if (Vector::$verbose)
            print ($this." constructed\n");
    }
    public function __toString()
    {
        return sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
            $this->getX(), $this->getY(), $this->getZ(), $this->getW());
    }
    public function magnitude() {
        return (float)(sqrt(pow($this->getX(), 2) + pow($this->getY(), 2) + pow($this->getZ(), 2)));
    }
    public function normalize() {
        $mag = $this->magnitude();
        return (new Vector(array("dest" => new Vertex(array(
            "x" => $this->getX() / $mag,
            "y" => $this->getY() / $mag,
            "z" => $this->getZ() / $mag)))));
    }
    public function add(Vector $rhs) {
        return (new Vector(array("dest" => new Vertex(array(
            "x" => $this->getX() + $rhs->getX(),
            "y" => $this->getY() + $rhs->getY(),
            "z" => $this->getZ() + $rhs->getZ())))));
    }
    public function sub(Vector $rhs) {
        return (new Vector(array("dest" => new Vertex(array(
            "x" => $this->getX() - $rhs->getX(),
            "y" => $this->getY() - $rhs->getY(),
            "z" => $this->getZ() - $rhs->getZ())))));
    }
    public function opposite() {
        return (new Vector(array("dest" => new Vertex(array(
            "x" => $this->getX() * -1,
            "y" => $this->getY() * -1,
            "z" => $this->getZ() * -1)))));
    }
    public function scalarProduct($k) {
        return (new Vector(array("dest" => new Vertex(array(
            "x" => $this->getX() * $k,
            "y" => $this->getY() * $k,
            "z" => $this->getZ() * $k)))));
    }
    public function dotProduct(Vector $rhs) {
        return (
            $this->getX() * $rhs->getX() +
            $this->getY() * $rhs->getY() +
            $this->getZ() * $rhs->getZ());
    }
    public function cos(Vector $rhs) {
        return (
            $this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
    }
    public function crossProduct(Vector $rhs) {
        return (new Vector(array("dest" => new Vertex(array(
            "x" => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(),
            "y" => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(),
            "z" => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX())))));
    }


    static public $verbose = False;
    private $_x = 0.0;
    private $_y = 0.0;
    private $_z = 0.0;
    private $_w = 0.0;

    /**
     * @return float
     */
    public function getX()
    {
        return $this->_x;
    }
    /**
     * @return float
     */
    public function getY()
    {
        return $this->_y;
    }
    /**
     * @return float
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
    public function __destruct()
    {
        if (Vector::$verbose)
            print ($this." destructed\n");
    }
}