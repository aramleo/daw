<?php

use PHPUnit\Framework\TestCase;

class SanearValidarTest extends TestCase{
    
    private $op;

    public function setUp(): void
    {
        $this->op = new FuncionesSaneaValida;
    }
   
    /**
     * testSanearNombre. Comprueba la fucnión sanearNombre
     *
     * @return void
     */
    public function testSanearNombre(){

        $this->assertEquals('Andres Ramos', $this->op->sanearNombre(' Andres Ramos '));
    }
        
    /**
     * testValidaNombre. Comprueba la validación del nombre. Si es superior a 6 e inferior a 100
     *
     * @return void
     */
    public function testValidaNombre(){

        $this->assertEquals( 'El nombre debe ser mayor de 6 carácteres', $this->op->validaNombre('An'));
        $this->assertEquals( 'El nombre debe ser menor de 100 carácteres', $this->op->validaNombre('Andres Ramos ttttttttttttttttttttttttttttttttttttttttttttttt
        tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt'));
    }
    
    /**
     * testSanearEmail. Comprueba el saneamiento del email
     *
     * @return void
     */
    public function testSanearEmail(){

        $this->assertEquals('user@example.com', $this->op->sanearEmail('user(@exam//ple.com'));
    }
    
    /**
     * testValidarFormatoEmail. Comprueba la validación del email
     *
     * @return void
     */
    public function testValidarFormatoEmail(){

        $this->assertEquals( 'user@example no es un email válido', $this->op->validaEmail('user@example'));
    }
    public function testValidarLongitudEmail(){

        $this->assertEquals( 'El email debe ser menor de 80 carácteres', $this->op->validaEmail('user@exampkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkle'));
    }

    public function testSanearPassword(){
        $this->assertEquals( 'ertegfve/%:', $this->op->sanearPassword('   ertegfve/%:    '));
    }

    public function testValidaPassword(){
        $this->assertEquals('El password no es válido (tiene que tener una longitud mínima de 8).', $this->op->validaPassword('',''));
        $this->assertEquals( 'El password no es válido (tiene que tener una longitud mínima de 8).', $this->op->validaPassword('ere/%:', 'ere/%:'));
        $this->assertEquals( 'La repetición del password no coincide.', $this->op->validaPassword('erjjjjjjje/%:', 'ere/%:'));
    }

}