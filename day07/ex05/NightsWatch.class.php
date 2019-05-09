<?php


class NightsWatch
{
    public function recruit($fg) {
        $this->_fighters[] = $fg;
    }
    public function fight() {
        foreach ($this->_fighters as &$fg) {
            if ($fg instanceof IFighter)
                $fg->fight();
        }
    }
    private $_fighters = [];
}