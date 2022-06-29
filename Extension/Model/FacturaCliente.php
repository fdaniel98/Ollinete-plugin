<?php

namespace FacturaScripts\Plugins\Ollinete\Extension\Model;

use Closure;

class FacturaCliente
{

    public function reference(): Closure
    {
        return function () {
            return $this->reference;
        };
    }

}
