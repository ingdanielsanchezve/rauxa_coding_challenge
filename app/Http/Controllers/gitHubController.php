<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class gitHubController extends Controller
{
    static function makeGitHubRequest($url)
    {
        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Agent smith');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, env('GITHUB_USER').':'.env('GITHUB_TOKEN'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        $result = json_decode(trim($output), true);
        return $result;
    }

    static function getGitHubUserFollowers($url)
    {

        return self::makeGitHubRequest($url);

    }

    static function getGitHubUserFollowersPerPage($user, $page)
    {

        $followers = self::getGitHubUserFollowers("https://api.github.com/users/$user/followers?page=$page&per_page=30");

        return response()->json(['followers' => isset($followers) ? $followers : []]);

    }

    function searchGitHubUser($user)
    {
        // VagrantStory
        // guisehn
        $user_info = self::makeGitHubRequest("https://api.github.com/users/$user");

        if (array_key_exists('id', $user_info)) {            
        
            if($user_info['followers'] > 0){
                
                $followers = self::getGitHubUserFollowers($user_info['followers_url']);

            }
            
            $resp = [
                'message'         => 'OK',
                'user'            => $user_info,
                'followers_count' => (array_key_exists('followers', $user_info)) ? $user_info['followers'] : 0,
                'pages'           => (array_key_exists('followers', $user_info)) ? ($user_info['followers'] % 30 == 0) ? ($user_info['followers'] / 30) : (int) ($user_info['followers'] / 30) + 1 : 0,
                'followers'       => isset($followers) ? $followers : []
            ];

        }else{
            
            $resp = $user_info;

        }

        return response()->json($resp);

    }

    function getGitHubUser(){

        $user_info = self::makeGitHubRequest("https://api.github.com/user");

        if (array_key_exists('id', $user_info)) {            
            
            $resp = [ 'message' => 'OK', 'user' => $user_info];

        }else{
            
            $resp = $user_info;

        }

        return response()->json($resp);
    }

}
