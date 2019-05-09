<?php


class Tyrion extends Lannister
{
    public function sleepWith($who) {
        if ($who instanceof Jaime || $who instanceof Cersei) {
            echo "Not even if I'm drunk !\n";
        }
        else {
            Lannister::sleepWith($who);
        }
    }
}