<?php


class UnholyFactory
{
    public function absorb($f) {
        if ($f instanceof Fighter) {
            if (!array_key_exists($f->getType(), $this->_fithers)) {
                $this->_fithers[$f->getType()] = $f;
                echo "(Factory absorbed a fighter of type " . $f->getType() . ")\n";
            }
            else {
                echo "(Factory already absorbed a fighter of type " . $f->getType() . ")\n";
            }
        }
        else {
            echo "(Factory can't absorb this, it's not a fighter)\n";
        }
    }
    public function fabricate($rf) {
        if (array_key_exists($rf, $this->_fithers)) {
            echo "(Factory fabricates a fighter of type ".$rf.")\n";
            return $this->_fithers[$rf];
        }
        else {
            echo "(Factory hasn't absorbed any fighter of type ".$rf.")\n";
            return null;
        }
    }
    private $_fithers = [];
}