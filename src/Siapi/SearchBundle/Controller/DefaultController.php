<?php

namespace Siapi\SearchBundle\Controller;

use SIAPI\Component\Application;
use SIAPI\Component\Search\Query\Params;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $application = new Application([
            'host' => "http://" . $_SERVER['HTTP_HOST']
        ]);

        $page = $request->query->get('page', 1);
        $params = new Params($request->query->all());

        $repository = $application->getRepository('image');
        $resultSet = $repository->findAllByParameters($params);

        $json = $application->getResponse($resultSet, $params, $page);


        return new Response($json, 200, ['Content-Type: application/json']);
    }
}
