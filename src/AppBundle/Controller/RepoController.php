<?php
/**
 * Created by PhpStorm.
 * User: SURAJ
 * Date: 18-11-2017
 * Time: 16:00
 */

namespace AppBundle\Controller;


use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RepoController extends Controller
{

    /**
     * @Route("/{username}", name="repo", defaults={"username": "never-potm"    })
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function repoAction(Request $request, $username)
    {

        $templateData = $this->get('repo_api')->getProfile($username);

        return $this->render(':repo:index.html.twig', $templateData);
    }

    /**
     * @Route("/profile/{username}", name="repo_profile", defaults={"username": "never-potm"    })
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileAction(Request $request, $username)
    {

        $templateData = $this->get('repo_api')->getProfile($username);

        return $this->render(':repo:profile.html.twig', $templateData);
    }

    /**
     * @Route("/repos/{username}", name="repo_display", defaults={"username": "never-potm"    })
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function reposAction(Request $request, $username)
    {

        $repoData = $this->get('repo_api')->getRepos($username);

        return $this->render(':repo:repos.html.twig', $repoData);
    }

}