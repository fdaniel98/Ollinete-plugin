<?php
namespace FacturaScripts\Plugins\Ollinete;

class Init extends \FacturaScripts\Core\Base\InitClass
{
    public function init()
    {
        // se ejecuta cada vez que carga FacturaScripts (si este plugin está activado).
        $this->loadExtension(new Extension\Model\OperacionPausada());
        $this->loadExtension(new Extension\Model\FacturaCliente());
        $this->loadExtension(new Extension\Model\Cliente());
    }

    public function update()
    {
        // se ejecuta cada vez que se instala o actualiza el plugin.
    }
}