<?php

namespace John;

class USER extends Record
{
    protected $_tableName = 'users';
    protected $_data = Array('id'       => null,
			    'name'     => null,
		            'birthday' => null
			   );
}

class RecordTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
	$dsn = 'mysql:host=localhost;dbname=myorm';
	$username = 'root';
        $password = '1qaZ2wsX';

	$user = new User($dsn,$username,$password);
	$user->truncate();
    }
   
    public function testIdShouldBeOneAfterSave()
    {
	$dsn = 'mysql:host=localhost;dbname=myorm';
	$username = 'root';
        $password = '1qaZ2wsX';

	$user = new User($dsn,$username,$password);
	    $user->name = 'JohnXie';
	    $user->birthday = '1985-10-26';
	    $id = $user->save();
	    $this->assertEquals(1,$id);
    }
    public function testNameShouldBeKennyXieAfterSave()
    {
	$dsn = 'mysql:host=localhost;dbname=myorm';
	$username = 'root';
        $password = '1qaZ2wsX';

	$user = new User($dsn,$username,$password);
	    $user->name = 'JohnXie';
	    $user->birthday = '1985-10-26';
	    $user->save();
	    $user->id = '1';
	    $user->name = 'KennyXie';
	    $myname = $user->save();
	    $this->assertEquals('KennyXie',$myname);
    }

}
