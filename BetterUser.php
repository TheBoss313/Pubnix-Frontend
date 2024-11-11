<?php

namespace myPHPnotes\Microsoft\Models;

use GuzzleHttp\Exception\ClientException;
use Microsoft\Graph\Model\User as MicrosoftUser;
class BetterUser extends BaseModel
{
    public $data;
    function __construct()
    {
        $this->checkAuthentication();
        $this->fetch_data();
    }
    function fetch_data()
    {
        $url =  "/me/memberOf";
        try {
            $user = $this->graph()->createRequest("get",$url)
                ->setReturnType(MicrosoftUser::class)
                ->execute();
            var_dump($user);
            echo "NO ERR";
        } catch (ClientException $e) {
//            throw new \Exception("Cannot connect make sure you have asked User.Read permission from the authenticated user.", 1);
            echo "ERR";
            return false;
        }
        $this->data = $user;
        return $this->data;
    }
}