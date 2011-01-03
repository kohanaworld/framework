<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

/**
 * Unit tests for response class
 *
 * @group kohana
 *
 * @package    Unittest
 * @author     Kohana Team
 * @copyright  (c) 2008-2010 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Kohana_ResponseTest extends Unittest_TestCase
{
	/**
	 * Ensures that Kohana::$expose adds the x-powered-by header and
	 * makes sure it's set to the correct Kohana Framework string
	 *
	 * @test
	 */
	public function test_expose()
	{
		Kohana::$expose = TRUE;
		$response = new Response;
		$headers = $response->send_headers()->headers();
		$this->assertArrayHasKey('x-powered-by', (array) $headers);

		if (isset($headers['x-powered-by']))
		{
			$this->assertSame($headers['x-powered-by']->value, 'Kohana Framework '.Kohana::VERSION.' ('.Kohana::CODENAME.')');
		}

		Kohana::$expose = FALSE;
		$response = new Response;
		$headers = $response->send_headers()->headers();
		$this->assertArrayNotHasKey('x-powered-by', (array) $headers);
	}
}