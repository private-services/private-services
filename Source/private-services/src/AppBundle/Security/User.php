<?php


namespace AppBundle\Security;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var array
     */
    private $roles;
    /**
     * @var string|null
     */
    private $message;

    /**
     * User constructor.
     * @param string $username
     * @param string $password
     * @param array $roles
     * @param string $salt
     * @param string|null $message
     */
    public function __construct($username, $password, array $roles, $message = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
        $this->message = $message;
    }

    /**@inheritdoc */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }
}