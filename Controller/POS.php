<?php

namespace FacturaScripts\Plugins\Ollinete\Controller;

use FacturaScripts\Core\Model\Cliente;
use FacturaScripts\Plugins\POS\Lib\POS\Sales\Order;
use FacturaScripts\Plugins\POS\Lib\POS\Sales\OrderRequest;

class POS extends \FacturaScripts\Plugins\POS\Controller\POS
{

    const DEFAULT_TRANSACTION = 'FacturaCliente';
    const PAUSED_TRANSACTION = 'OperacionPausada';

    public function getRef($code, $reference)
    {
        if (empty($reference)) {
            $cliente = new Cliente();
            $cliente->loadFromCode($code);
            return $cliente->ref;
        }

        return $reference;
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

    protected function holdOrder()
    {
        if (false === $this->validateSaveRequest($this->request)) {
            return;
        }

        $this->request->request->set('tipo-documento', self::PAUSED_TRANSACTION);
        $request = new OrderRequest($this->request);
        $transaction = new Order($request);
        $transaction->reference = $this->request->get('reference');

        if ($transaction->hold()) {
            $this->toolBox()->i18nLog()->info('operation-is-paused');
        }
    }

}
