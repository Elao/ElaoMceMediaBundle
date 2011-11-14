<?php

namespace Elao\TinyMceBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        $url = $this->getRequest()->query->get('return_url');

        $configuration = $this->get('elao.tiny_mce.configuration');

        $this->getRequest()->getSession()->start();

        $_SESSION['tiny_isLogin'] = $configuration->getIsLogin();
        $_SESSION['tiny_userKey'] = $configuration->getUserKey();
        $_SESSION['tiny_pathKey'] = $configuration->getPath();
        $_SESSION['tiny_rootpathKey'] = realpath($configuration->getRootPath());

        $_SESSION['tiny_config.general.language'] = $this->getRequest()->getSession()->getLocale();

        foreach ($configuration->getConfigs() as $key => $config) {
            $_SESSION['tiny_config.'.$key] = $config;
        }

        if ($configuration->getIsLogin() == false) {
            return new Response('You don\'t have access to this page.');
        }

        return $this->redirect($url);
    }
}