<?php

namespace FacturaScripts\Plugins\Ollinete\Controller;

use FacturaScripts\Core\Model\Cliente;
use FacturaScripts\Plugins\POS\Lib\POS\Sales\Order;
use FacturaScripts\Plugins\POS\Lib\POS\Sales\OrderRequest;

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

    /**
     * Process sales.
     *
     * @return void
     */
    protected function saveOrder()
    {
        if (false === $this->validateSaveRequest($this->request)) {
            return;
        }

        $orderRequest = new OrderRequest($this->request);
        $order = new Order($orderRequest);
        $order->reference = $this->request->get('reference');

        if ($order->save()) {
            $this->session->storeTransaction($order);
            $this->printTicket($order->getDocument());
        }
    }

}
