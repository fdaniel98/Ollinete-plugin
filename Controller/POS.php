<?php

namespace FacturaScripts\Plugins\Ollinete\Controller;

use FacturaScripts\Core\Model\Cliente;

class POS extends \FacturaScripts\Plugins\POS\Controller\POS
{

    const DEFAULT_TRANSACTION = 'FacturaCliente';
    const PAUSED_TRANSACTION = 'OperacionPausada';

    public function getRef($code)
    {
        $cliente = new Cliente();
        $cliente->loadFromCode($code);
        return $cliente->ref;
    }

}
