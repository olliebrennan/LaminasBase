<?php
/**
 * LaminasBase
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br>
 * @license AGPL-3.0 <https://www.gnu.org/licenses/agpl-3.0.en.html>
 */
namespace LaminasBaseTest\Mapper;

use PHPUnit\Framework\TestCase;
use Laminas\Db\Adapter\Adapter;
use LaminasBase\Db\Adapter\MasterSlaveAdapter;
use LaminasBaseTest\Mapper\TestAsset\TestMapper;

class AbstractDbMapperTest extends TestCase
{
    public function setup():void
    {
        $this->mockDriver = $this->createMock('Laminas\Db\Adapter\Driver\DriverInterface');
        $this->mockConnection = $this->createMock('Laminas\Db\Adapter\Driver\ConnectionInterface');
        $this->mockDriver->expects($this->any())->method('checkEnvironment')->will($this->returnValue(true));
        $this->mockDriver->expects($this->any())->method('getConnection')->will($this->returnValue($this->mockConnection));
        $this->mockPlatform = $this->createMock('Laminas\Db\Adapter\Platform\PlatformInterface');
        $this->mockStatement = $this->createMock('Laminas\Db\Adapter\Driver\StatementInterface');
        $this->mockDriver->expects($this->any())->method('createStatement')->will($this->returnValue($this->mockStatement));

        $this->adapter = new Adapter($this->mockDriver, $this->mockPlatform);
        $this->masterSlaveAdapter = new MasterSlaveAdapter($this->adapter, $this->mockDriver, $this->mockPlatform);
    }

    public function testSetMasterAndSlaveDbAdapterSettersAndGettersWorksAsExpected()
    {
        $this->mapper = new TestMapper;
        $this->mapper->setDbAdapter($this->adapter);
        $this->assertSame($this->adapter, $this->mapper->getDbAdapter());
        $this->assertSame($this->adapter, $this->mapper->getDbSlaveAdapter());
        $newAdapter = new Adapter($this->mockDriver, $this->mockPlatform);
        $this->mapper->setDbSlaveAdapter($newAdapter);
        $this->assertSame($newAdapter, $this->mapper->getDbSlaveAdapter());
        unset($this->mapper);
    }

    public function testSetMasterSlaveDbAdapterSetterAndGettersAlsoWorksAsExpected()
    {
        $this->mapper = new TestMapper;
        $this->mapper->setDbAdapter($this->masterSlaveAdapter);
        $this->assertSame($this->masterSlaveAdapter, $this->mapper->getDbAdapter());
        $this->assertSame($this->adapter, $this->mapper->getDbSlaveAdapter());
        $newAdapter = new Adapter($this->mockDriver, $this->mockPlatform);
        $this->mapper->setDbSlaveAdapter($newAdapter);
        $this->assertSame($newAdapter, $this->mapper->getDbSlaveAdapter());
        unset($this->mapper);
    }
}
