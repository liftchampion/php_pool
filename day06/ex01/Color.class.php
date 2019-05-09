<?php


class Color
{
    public function __construct(array $construct)
    {
        if (array_key_exists("rgb", $construct)) {
            $col = (int)$construct["rgb"];
            $this->red =  ($col & 0x00ff0000) >> 16;
            $this->green = ($col & 0x0000ff00) >> 8;
            $this->blue = $col & 0x000000ff;
        }
        else {
            if (array_key_exists("red", $construct)) {
                $this->red = (int)$construct["red"];
            }
            if (array_key_exists("green", $construct)) {
                $this->green = (int)$construct["green"];
            }
            if (array_key_exists("blue", $construct)) {
                $this->blue = (int)$construct["blue"];
            }
        }
        if (Color::$verbose)
            print ($this->__toString()." constructed.\n");
    }
    public function __toString()
    {
        $red_s = sprintf("%3s", $this->red);
        $green_s = sprintf("%3s", $this->green);
        $blue_s = sprintf("%3s", $this->blue);
        return "Color( red: ".$red_s.", green: ".$green_s.", blue: ".$blue_s." )";
    }
    public function doc() {
        return (file_get_contents("Color.doc.txt"));
    }
    public function add(Color $rhs) {
        return (new Color(array("red" => $this->red + $rhs->red,
                                "green" => $this->green + $rhs->green,
                                "blue" => $this->blue + $rhs->blue)));
    }
    public function sub(Color $rhs) {
        return (new Color(array("red" => $this->red - $rhs->red,
                                "green" => $this->green - $rhs->green,
                                "blue" => $this->blue - $rhs->blue)));
    }
    public function mult($f) {
        return (new Color(array("red" => $this->red * $f,
                                "green" => $this->green * $f,
                                "blue" => $this->blue * $f)));
    }
    public function __destruct()
    {
        if (Color::$verbose)
            print ($this->__toString()." destructed.\n");
    }


    static public $verbose = False;
    public $red = 0;
    public $green = 0;
    public $blue = 0;
}