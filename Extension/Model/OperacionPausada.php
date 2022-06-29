<?php

namespace FacturaScripts\Plugins\Ollinete\Extension\Model;

use Closure;

class OperacionPausada
{

    public function reference(): Closure
    {
        return function () {
            return $this->reference;
        };
    }

}
