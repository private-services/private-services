<?php


namespace AppBundle\Security;


use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CustomUserProvider implements UserProviderInterface
{
    /**
     * @var array
     */
    private $users;

    /**
     * CustomUserProvider constructor.
     * @param array $users
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }


    public function loadUserByUsername($username)
    {
        $customUser = null;
        foreach ($this->users as $user) {
            if (array_key_exists('login', $user) && $user['login'] === $username) {
                $customUser = new User(
                    $user['login'],
                    $user['password'],
                    $user['roles'],
                    $user['message']
                );
            }
        }

        return $customUser;
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user);
    }

    public function supportsClass($class)
    {
        return $class = 'AppBundle\Security\User';
    }
}