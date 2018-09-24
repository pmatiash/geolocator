<?php

namespace MatiashApp\Controller;

use MatiashApp\MatiashApp;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function getAction(Request $request, MatiashApp $app)
    {
        $clientIp = $request->getClientIp();

        return $app->render(
            'index.html.twig',
            [
                'clientIp' => $clientIp
            ]
        );
    }
}

