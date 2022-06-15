<?php

namespace FacturaScripts\Plugins\Ollinete\Extension\Model;

use Closure;

class Cliente
{

    public function ref(): Closure
    {
        return function () {
            return $this->ref;
        };
    }

}
