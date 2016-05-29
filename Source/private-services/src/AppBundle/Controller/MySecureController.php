<?php
/**
 * Created by PhpStorm.
 * User: sixer
 * Date: 29.05.16
 * Time: 20:34
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class MySecureController
 * @package AppBundle\Controller
 * @Route(service="ps.secure_controller")
 */
class MySecureController
{
    /**
     * @var AuthorizationChecker
     */
    private $authorizationChecker;

    /**
     * MySecureController constructor.
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }


    /**
     * @Route(
     *  "/",
     *  name="homepage"
     * )
     */
    public function homeAction(Request $request)
    {
        $text = "Hallo";

        if ($this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            $text .= ' Admin';
        }

        return new Response("<html><body>" . $text . "!</body></bod></html>");
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        return new Response("<html><body>Admin</body></bod></html>");
    }

}