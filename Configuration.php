<?php

namespace Elao\TinyMce;

use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Configuration class for tinymce mediamanager
 */
class Configuration
{
    protected $context;

    protected $isLogin = false;

    protected $userKey;

    protected $rootpath;

    protected $path;

    protected $configs;

    protected $role;

    /**
     * __construct
     *
     * @param SecurityContextInterface $context  context
     * @param boolean                  $isLogin  is login ?
     * @param string                   $role     role
     * @param string                   $rootpath context
     * @param string                   $path     path
     * @param array                    $configs  configs
     *
     * @return void
     */
    public function __construct(SecurityContextInterface $context, $isLogin, $role, $rootpath, $path, array $configs = array())
    {
        $this->context = $context;

        $this->isLogin = $isLogin;
        $this->rootpath = $rootpath;
        $this->path = $path;
        $this->configs = $configs;
        $this->role = $role;

        if ($isLogin == false && $role != '') {
            $this->isLogin = $this->context->isGranted($role);
        }
    }

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        $this->userKey = (string) $this->context->getToken()->getUser()->getUsername();
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
     * Get UserKey
     *
     * @return string
     */
    public function getUserKey()
    {
        return $this->userKey;
    }

    /**
     * Get Path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get Rootpath
     *
     * @return string
     */
    public function getRootPath()
    {
        return $this->rootpath;
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

    /**
     * Set config
     *
     * @param string $key   key
     * @param string $value value
     *
     * @return void
     */
    public function setConfig($key, $value)
    {
        $this->configs[$key] = $value;
    }

    /**
     * Get config
     *
     * @param string      $key     key
     * @param string|null $default default value
     *
     * @return string|null
     */
    public function getConfig($key, $default = null)
    {
        if (isset($this->configs[$key])) {
            return $this->configs[$key];
        } else {
            return $default;
        }
    }
}