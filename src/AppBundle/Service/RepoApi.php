<?php
/**
 * Created by PhpStorm.
 * User: SURAJ
 * Date: 19-11-2017
 * Time: 13:10
 */

namespace AppBundle\Service;

use GuzzleHttp\Client;

class RepoApi
{

    public function getProfile($username)
    {

        $client = new Client();
        $response = $client->request('GET', 'https://api.github.com/users/'.$username);

        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'username' => $username,
            'avatar_url' => $data['avatar_url'],
            'name' => $data['name'],
            'login' => $data['login'],
            'details' => [
                'company' => $data['company'],
                'location' => $data['location'],
                'joined_on' => 'Joined on '.(new \DateTime($data['created_at']))->format('d m Y')
            ],
            'blog' => $data['blog'],
            'social_data' => [
                "Public Repos" => $data['public_repos'],
                "Followers" => $data['followers'],
                "Following" => $data['following'],
            ],

        ];
    }

    public function getRepos($username)
    {

        $client = new Client();
        $response = $client->request('GET', 'https://api.github.com/users/'.$username . '/repos');

        $data = json_decode($response->getBody()->getContents(), true);

        return [
            "repo_count" => count($data),
            "most_stars" => array_reduce($data, function($mostStars, $currentRepo) {

                return $currentRepo['stargazers_count'] > $mostStars ? $currentRepo['stargazers_count'] : $mostStars;
            }, 0),
            "repos" => $data
        ];
    }

}