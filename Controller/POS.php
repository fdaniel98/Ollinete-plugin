<?php

namespace FacturaScripts\Plugins\Ollinete\Controller;

use FacturaScripts\Dinamic\Model\Cliente;
use FacturaScripts\Dinamic\Lib\POS\Sales\Customer;

class POS extends \FacturaScripts\Plugins\POS\Controller\POS
{
    const DEFAULT_ORDER = 'FacturaCliente';
    const HOLD_ORDER = 'OperacionPausada';

    protected function execPreviusAction(string $action): bool
    {
        switch ($action) {
            case 'search-barcode':
                $this->searchBarcode();
                return false;

            case 'search-customer':
                $this->searchCustomer();
                return false;

            case 'search-product':
                $this->searchProduct();
                return false;

            case 'resume-order':
                $this->resumeOrder();
                return false;

            case 'recalculate-order':
                $this->recalculateOrder();
                return false;

            case 'delete-order-on-hold':
                $this->deleteOrderOnHold();
                return false;

            case 'save-new-customer':
                $this->saveNewCustomer();
                return false;

            default:
                return true;
        }
    }

    private function saveNewCustomer()
    {
        $taxID = $this->request->request->get('taxID');
        $name = $this->request->request->get('name');
        $ref = $this->request->request->get('ref');

        $cliente = new Cliente();

        $cliente->cifnif = $taxID;
        $cliente->nombre = $name;
        $cliente->ref = $ref;
        $cliente->razonsocial = $name;

        $isSaved = $cliente->save();

        if ($isSaved) {
            $this->setAjaxResponse($cliente);
            return;
        }

        $this->setAjaxResponse('Error al guardar el cliente');
    }

}
