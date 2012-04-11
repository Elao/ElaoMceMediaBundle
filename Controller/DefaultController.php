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

        if ($configuration->getIsLogin() == false) {
            return new Response('You don\'t have access to this page.');
        }

        $key = md5(implode('', $configuration->getConfigs()).$configuration->getSecretKey());

        return $this->render('ElaoTinyMceBundle:Default:login.html.twig', array('configuration' => $configuration, 'url' => $url, 'key' => $key));
    }
}