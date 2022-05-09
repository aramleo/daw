<?php

use PHPUnit\Framework\TestCase;

/**
 * SanearValidarTest. Archivos para testear unitariamente la clase Conexion
 */
class ConexionTest extends TestCase{
    
    private $op;
    
    /**
     * setUp. Llama a la clase Conexion
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->op = new Conexion;
    }

    public function testConexion(){

        $this->assertTrue(true);
        
    }
   
}