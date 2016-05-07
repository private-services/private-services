<?php

namespace AppBundle\Administration;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AdministrationService
{

    /**
     * @Route()
     */
    public function administrationAction()
    {
        return new Response();
    }
}