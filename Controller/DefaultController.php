<?php

namespace Elao\TinyMceBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * ElaoTinyMceBundle DefaultController
 */
class DefaultController extends Controller
{
    /**
     * Login action call from tinymce
     *
     * @return Response
     */
    public function loginAction()
    {
        $configuration = $this->get('elao.tiny_mce.configuration');

        $this->getRequest()->getSession()->start();

        $_SESSION['tiny_isLogin'] = $configuration->getIsLogin();
        $_SESSION['tiny_userKey'] = $configuration->getUserKey();
        $_SESSION['tiny_pathKey'] = $configuration->getPathKey();
        $_SESSION['tiny_rootpathKey'] = $configuration->getRootPathKey();

        foreach ($configuration->getConfigs() as $key => $config) {
            $_SESSION['tiny_config.'.$key] = $config;
        }

        return new Response('');
    }
}