<?php

namespace Elao\Bundle\MceMediaBundle;

use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Configuration class for tinymce mediamanager
 */
class Configuration
{
    protected $context;

    protected $isLogin = false;

    protected $configs;

    protected $role;

    protected $secretKey;

    /**
     * __construct
     *
     * @param SecurityContextInterface $context  context
     * @param boolean                  $isLogin  is login ?
     * @param string                   $role     role
     * @param array                    $configs  configs
     *
     * @return void
     */
    public function __construct(SecurityContextInterface $context, $isLogin, $role, $secretKey, array $configs = array())
    {
        $this->context = $context;

        $this->isLogin = $isLogin;
        $this->configs = $configs;
        $this->role = $role;
        $this->secretKey = $secretKey;

        if ($isLogin == false && $role != '') {
            $this->isLogin = $this->context->isGranted($role);
        }
    }

    /**
     * Get isLogin
     *
     * @return boolean
     */
    public function getIsLogin()
    {
        return $this->isLogin;
    }

    /**
     * Get Secret key
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Get configs
     *
     * @return array
     */
    public function getConfigs()
    {
        return $this->configs;
    }
}