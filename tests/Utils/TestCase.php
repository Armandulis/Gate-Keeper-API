<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\MockObject\Exception;
use \PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TestCase
 * Helps test classes to test classes and prepare tests
 */
class TestCase extends BaseTestCase
{
  public Request $request;

  protected function setUp() : void
  {
    parent::setUp();

    $this->request = new Request();
  }

  /**
   * Prepares the controller by setting up the container.
   * @param AbstractController $controller The controller to prepare.
   * @return void
   * @throws Exception
   */
  public function prepareController( AbstractController $controller ) : void
  {
    // Set up container
    $container = $this->createMock( ContainerInterface::class );
    $controller->setContainer( $container );
  }
}
