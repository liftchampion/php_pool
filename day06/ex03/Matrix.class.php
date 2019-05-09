<?php

require_once 'Vector.class.php';

class Matrix
{
    public function __construct(array $construct)
    {
        $p = 0;
        if (array_key_exists('preset', $construct)) {
            $p = $construct["preset"];
            if ($p == Matrix::IDENTITY) {
                $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                    "x" => 1,
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 1,
                    "z" => 0
                ))));
                $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => 1
                ))));
                $this->_dt[3] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[3]->setW(1);
            }
            else if ($p == Matrix::SCALE) {
                if (array_key_exists("scale", $construct)) {
                    $this->_scale = (float)$construct['scale'];
                }
                $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                    "x" => $this->_scale,
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => $this->_scale,
                    "z" => 0
                ))));
                $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => $this->_scale
                ))));
                $this->_dt[3] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[3]->setW(1);
            }
            else if ($p == Matrix::RX || $p == Matrix::RY || $p == Matrix::RZ) {
                if (array_key_exists("angle", $construct)) {
                    $this->_angle = (float)$construct['angle'];
                }
                if ($p == Matrix::RX) {
                    $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                        "x" => 1,
                        "y" => 0,
                        "z" => 0
                    ))));
                    $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                        "x" => 0,
                        "y" => cos($this->_angle),
                        "z" => sin($this->_angle)
                    ))));
                    $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                        "x" => 0,
                        "y" => -sin($this->_angle),
                        "z" => cos($this->_angle)
                    ))));
                }

                if ($p == Matrix::RY) {
                    $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                        "x" => cos($this->_angle),
                        "y" => 0,
                        "z" => -sin($this->_angle)
                    ))));
                    $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                        "x" => 0,
                        "y" => 1,
                        "z" => 0
                    ))));
                    $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                        "x" => sin($this->_angle),
                        "y" => 0,
                        "z" => cos($this->_angle)
                    ))));
                }

                if ($p == Matrix::RZ) {
                    $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                        "x" => cos($this->_angle),
                        "y" => sin($this->_angle),
                        "z" => 0
                    ))));
                    $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                        "x" => -sin($this->_angle),
                        "y" => cos($this->_angle),
                        "z" => 0
                    ))));
                    $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                        "x" => 0,
                        "y" => 0,
                        "z" => 1
                    ))));
                }
                $this->_dt[3] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[3]->setW(1);
            }
            else if ($p == Matrix::TRANSLATION) {
                if (array_key_exists("vtc", $construct)) {
                    $this->_vtc = $construct['vtc'];
                }
                $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                    "x" => 1,
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 1,
                    "z" => 0
                ))));
                $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => 1
                ))));
                $this->_dt[3] = new Vector(array("dest" => new Vertex(array(
                    "x" => $this->_vtc->getX(),
                    "y" => $this->_vtc->getY(),
                    "z" => $this->_vtc->getZ()
                ))));
                $this->_dt[3]->setW(1);
            }
            else if ($p == Matrix::PROJECTION) {
                if (array_key_exists("fov", $construct)) {
                    $this->_fov = (float)$construct['fov'];
                    $this->_fov_rad = $this->_fov * pi() / 180;
                }
                if (array_key_exists("ratio", $construct)) {
                    $this->_ratio = (float)$construct['ratio'];
                }
                if (array_key_exists("near", $construct)) {
                    $this->_near = (float)$construct['near'];
                }
                if (array_key_exists("far", $construct)) {
                    $this->_far = (float)$construct['far'];
                }
                $this->_dt[0] = new Vector(array("dest" => new Vertex(array(
                    "x" => 1 / ($this->_ratio * tan($this->_fov_rad / 2)),
                    "y" => 0,
                    "z" => 0
                ))));
                $this->_dt[1] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 1 / (tan($this->_fov_rad / 2)),
                    "z" => 0
                ))));
                $this->_dt[2] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => ($this->_near + $this->_far) / ($this->_near - $this->_far)
                ))));
                $this->_dt[2]->setW(-1);
                $this->_dt[3] = new Vector(array("dest" => new Vertex(array(
                    "x" => 0,
                    "y" => 0,
                    "z" => (2 * $this->_near * $this->_far) / ($this->_near - $this->_far)
                ))));
                $this->_dt[3]->setW(0);
            }
            if (Matrix::$verbose)
                print ("Matrix ".Matrix::$_names[$p]." instance constructed\n");
        }
    }
    public function __toString()
    {
        $l1 = sprintf("M | vtcX | vtcY | vtcZ | vtxO");
        $l0 = sprintf("-----------------------------");
        $l2 = sprintf("x | %.2f | %.2f | %.2f | %.2f", $this->_dt[0]->getX(), $this->_dt[1]->getX(), $this->_dt[2]->getX(), $this->_dt[3]->getX());
        $l3 = sprintf("y | %.2f | %.2f | %.2f | %.2f", $this->_dt[0]->getY(), $this->_dt[1]->getY(), $this->_dt[2]->getY(), $this->_dt[3]->getY());
        $l4 = sprintf("z | %.2f | %.2f | %.2f | %.2f", $this->_dt[0]->getZ(), $this->_dt[1]->getZ(), $this->_dt[2]->getZ(), $this->_dt[3]->getZ());
        $l5 = sprintf("w | %.2f | %.2f | %.2f | %.2f", $this->_dt[0]->getW(), $this->_dt[1]->getW(), $this->_dt[2]->getW(), $this->_dt[3]->getW());
        return $l1."\n".$l0."\n".$l2."\n".$l3."\n".$l4."\n".$l5;
    }
    static public function doc(){
        return file_get_contents("Matrix.doc.txt");
    }
    public function mult(Matrix $rhs) {
        $new = clone $this;
        $new->SetDt(array(
            0 => new Vector(array('dest' => new Vertex(array(
                "x" => $this->mult_one($rhs, 0, 0),
                "y" => $this->mult_one($rhs, 0, 1),
                "z" => $this->mult_one($rhs, 0, 2),
            )))),
            1 => new Vector(array('dest' => new Vertex(array(
                "x" => $this->mult_one($rhs, 1, 0),
                "y" => $this->mult_one($rhs, 1, 1),
                "z" => $this->mult_one($rhs, 1, 2),
            )))),
            2 => new Vector(array('dest' => new Vertex(array(
                "x" => $this->mult_one($rhs, 2, 0),
                "y" => $this->mult_one($rhs, 2, 1),
                "z" => $this->mult_one($rhs, 2, 2),
            )))),
            3 => new Vector(array('dest' => new Vertex(array(
                "x" => $this->mult_one($rhs, 3, 0),
                "y" => $this->mult_one($rhs, 3, 1),
                "z" => $this->mult_one($rhs, 3, 2),
            )))),
        ));
        $this->_dt[0]->setW($this->mult_one($rhs, 0, 3));
        $this->_dt[1]->setW($this->mult_one($rhs, 1, 3));
        $this->_dt[2]->setW($this->mult_one($rhs, 2, 3));
        $this->_dt[3]->setW($this->mult_one($rhs, 3, 3));
        return $new;
    }
    const IDENTITY = "1";
    const SCALE = "2";
    const RX = "3";
    const RY = "4";
    const RZ = "5";
    const TRANSLATION = "6";
    const PROJECTION = "7";
    static private $_names = array(
        1 => "IDENTITY",
        2 => "SCALE preset",
        3 => "Ox ROTATION preset",
        4 => "Oy ROTATION preset",
        5 => "Oz ROTATION preset",
        6 => "TRANSLATION preset",
        7 => "PROJECTION preset");
    private $_preset = 0;
    private $_scale = 0;
    private $_angle = 0;
    private $_vtc = 0;
    private $_fov = 0;
    private $_fov_rad = 0;
    private $_ratio = 0;
    private $_near = 0;
    private $_far = 0;
    private $_dt = array();
    static public $verbose = False;

    public function transformVertex(Vertex $vtx) {
        $new = clone $this;
        $new->SetDt(array(
            0 => new Vector(array('dest' => new Vertex(array(
                "x" => $vtx->getX(),
                "y" => $vtx->getY(),
                "z" => $vtx->getZ(),
            )))),
            1 => new Vector(array('dest' => new Vertex(array(
                "x" => 0,
                "y" => 1,
                "z" => 0,
            )))),
            2 => new Vector(array('dest' => new Vertex(array(
                "x" => 0,
                "y" => 0,
                "z" => 1,
            )))),
            3 => new Vector(array('dest' => new Vertex(array(
                "x" => 0,
                "y" => 0,
                "z" => 0,
            )))),
        ));
        $this->_dt[0]->setW($vtx->getW());
        $this->_dt[1]->setW(0);
        $this->_dt[2]->setW(0);
        $this->_dt[3]->setW(1);
        $after_m = $this->mult($new);
        return $after_m->_dt[0];
    }

    private function mult_one(Matrix $rhs, $i, $j) {
        $sum = 0;
        for ($r = 0; $r < 4; $r++) {
            $sum += $this->_dt[$i]->getAll()[$r] * $rhs->getDt()[$r]->getAll()[$j];
        }
        return $sum;
    }
    /**
     * @param array $dt
     */
    public function setDt(array $dt)
    {
        $this->_dt = $dt;
    }

    /**
     * @return array
     */
    public function getDt()
    {
        return $this->_dt;
    }
}