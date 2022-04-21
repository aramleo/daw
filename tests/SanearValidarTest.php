<?php

use PHPUnit\Framework\TestCase;

class SanearValidarTest extends TestCase{
    
    private $op;
    
    /**
     * setUp. Llama a la clase FuncionesSaneaValida
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->op = new FuncionesSaneaValida;
    }
   
    /**
     * testSanearNombre. Comprueba la función sanearNombre
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

        
    /**
     * testValidarLongitudEmail. Salida en caso que el email sea mayor de 80 carácteres
     *
     * @return void
     */
    public function testValidarLongitudEmail(){

        $this->assertEquals( 'El email debe ser menor de 80 carácteres', $this->op->validaEmail('user@exampkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkle'));
    }
    
    /**
     * testSanearPassword. Comprueba si devuelve la cadena limpia de espacios al inicio y al final
     *
     * @return void
     */
    public function testSanearPassword(){
        $this->assertEquals( 'ertegfve/%:', $this->op->sanearPassword('   ertegfve/%:    '));
    }
    
    /**
     * testValidaPassword. Comrpueba si el password tiene una longitud mínima de 8, si están vacios tanto password como comprobación 
     * y si tanto password como comprobación de password coinciden
     *
     * @return void
     */
    public function testValidaPassword(){
        $this->assertEquals('El password no es válido (tiene que tener una longitud mínima de 8).', $this->op->validaPassword('',''));
        $this->assertEquals( 'El password no es válido (tiene que tener una longitud mínima de 8).', $this->op->validaPassword('ere/%:', 'ere/%:'));
        $this->assertEquals( 'La repetición del password no coincide.', $this->op->validaPassword('erjjjjjjje/%:', 'ere/%:'));
    }
    
    /**
     * testEspaciosBlancos. Comprueba la eliminación de espacios en blanco
     *
     * @return void
     */
    public function testEspaciosBlancos(){
        $this->assertEquals('Andres Ramos', $this->op->espaciosBlanco('   Andres Ramos    '));
        
    }
    
    /**
     * testCaracterEspecial. Comprueba la salida de los carácteres especiales
     *
     * @return void
     */
    public function testCaracterEspecial(){
        $this->assertEquals( 'Andres&lt;Ramos', $this->op->caracterEspecial('Andres<Ramos'));
    }
    
    /**
     * testPri_mayus. Comprueba que solo deja el carácter primero ne mayúasculas
     *
     * @return void
     */
    public function testPri_mayus(){
        $this->assertEquals( 'Andres', $this->op->pri_mayus('ANdres'));
    }   
     
    /**
     * testMinus. Comprueba que todos los carácteres son en minúsculas excepto los primeros de
     * cada palabra
     *
     * @return void
     */
    public function testMinus(){
        $this->assertEquals( 'Andres Ramos', $this->op->minus('ANdres ramos'));
    }
    
    /**
     * testLimpia_dir. Limpia la dirección de espacios en blanco, carácteres especiales los transforma y
     * pone en mayúsculas la primera letra del string
     *
     * @return void
     */
    public function testLimpia_dir(){
        $this->assertEquals('Rosa&lt;martinez, 35', $this->op->limpia_dir('   Rosa<Martinez, 35') );
    }
    
    /**
     * testMagnus. Comprueba que salen todos los carácteres en mayúsculas
     *
     * @return void
     */
    public function testMagnus(){
        $this->assertEquals('ANDRES', $this->op->magnus('andres') );
    }
    
    /**
     * testValidaLongitud. Comprueba la longitud minima y máxima de una cadena que corresponde a un campo
     * designado como elemento
     *
     * @return void
     */
    public function testValidaLongitud(){
        $this->assertEquals('nombre debe ser mayor de 2 carácteres', $this->op->validaLongitud('a', 2, 7, 'nombre'));
        $this->assertEquals('nombre debe ser menor de 7 carácteres', $this->op->validaLongitud('andresra', 2, 7, 'nombre'));
    }

    
    /**
     * testSoloPassword. Teastea solo el password sin la confirmación del passsword
     *
     * @return void
     */
    public function testSoloPassword(){
        $this->assertEquals('El password no es válido (tiene que tener una longitud mínima de 8).', $this->op->soloPassword('') );
        $this->assertEquals('El password no es válido (tiene que tener una longitud mínima de 8).', $this->op->soloPassword('as') );
    }
    
    /**
     * testValidaDni. Testea que el DNI se ajuste a las normas de contrucción de un DNI español
     *
     * @return void
     */
    public function testValidaDni(){
        $this->assertEquals('El DNI ingresado no es válido', $this->op->validaDni('28491563P') );
    }
    
    /**
     * testValidaCp. Testa que el código postal no esté vacío, tenga 5 cifras y sea númerico
     *
     * @return void
     */
    public function testValidaCp(){
        $this->assertEquals('El código postal no es válido', $this->op->validaCp('') );
        $this->assertEquals('El código postal no es válido', $this->op->validaCp('456879') );
        $this->assertEquals('El código postal no es válido', $this->op->validaCp('abcde') );
    }
    
    /**
     * testValidaTfn. Comprueba que el teléfono no esté vacío, tenga nueve carácteres y sea un
     * número.
     *
     * @return void
     */
    public function testValidaTfn(){
        $this->assertEquals('El teléfono no es válido', $this->op->validaTfn('') );
        $this->assertEquals('El teléfono no es válido', $this->op->validaTfn('12345678') );
        $this->assertEquals('El teléfono no es válido', $this->op->validaTfn('asdfghjkl') );
    }

}