<?php


class Lannister
{
    public function sleepWith($who) {
        if (get_parent_class($who) == "Stark")
            echo "Let's do this\n";
    }
}