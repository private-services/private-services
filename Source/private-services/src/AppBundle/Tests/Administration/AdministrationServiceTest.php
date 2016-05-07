<?php


use AppBundle\Administration\AdministrationService;
use Symfony\Component\HttpFoundation\Response;

class AdministrationServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var  AdministrationService */
    private $administrationService;

    /**
     * @test
     **/
    public function theAdministrationActionShouldReturnAResponse()
    {
        $response = $this->administrationService->administrationAction();

        self::assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response );
    }

    /**
     * @test
     */
    public function theAdministrationActionResponseShouldBeOk()
    {
        $response = $this->administrationService->administrationAction();
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @return AdministrationService
     */
    protected function setUp()
    {
        $this->administrationService = new AdministrationService();
    }

}
