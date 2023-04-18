<?php
use PHPUnit\Framework\TestCase;


class ventasTest extends TestCase{

    public function testDeleteVenta()
    {
        $activo = new Activo();
        $this->assertEquals("ok",$activo->mdlDelete("activos",11));
    }

    public function testDeleteActivoValuesNull()
    {
        $activo = new Activo();
        $this->expectException(InvalidArgumentException::class);
        $activo->mdlDelete(null,null);
    }

    public function testAddActivoValuesNull()
    {
        $activo = new Activo();
        $this->expectException(InvalidArgumentException::class);
        $activo->mdlAdd(null,null);
    }

    public function testTrueActivoSearch()
    {
        $activo = new Activo();
        $this->assertTrue($activo->mdlShow("activos", "codigo", 1));
    }

    public function testFalseActivoSearch()
    {
        $activo = new Activo();
        $this->assertFalse($activo->mdlUpdate("activos", NULL));
    }


    
    

}

?>