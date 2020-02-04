<?php
/**
 * LaminasBase
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br>
 * @license AGPL-3.0 <https://www.gnu.org/licenses/agpl-3.0.en.html>
 */
namespace LaminasBaseTest\Form;

use PHPUnit\Framework\TestCase;
use LaminasBase\Form\ProvidesEventsForm;
use Laminas\EventManager\EventManager;

class ProvidesEventsFormTest extends TestCase
{
    public function setup():void
    {
        $this->form = new ProvidesEventsForm;
    }

    public function testGetEventManagerSetsDefaultIdentifiers()
    {
        $em = $this->form->getEventManager();
        $this->assertInstanceOf('Laminas\EventManager\EventManager', $em);
        $this->assertContains('LaminasBase\Form\ProvidesEventsForm', $em->getIdentifiers());
    }

    public function testSetEventManagerWorks()
    {
        $em = new EventManager();
        $this->form->setEventManager($em);
        $this->assertSame($this->form->getEventManager(), $em);
    }
}

