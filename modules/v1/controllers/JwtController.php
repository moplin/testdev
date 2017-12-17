<?php

namespace app\modules\v1\controllers;

use Yii;
use \yii\web\Response;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class JwtController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
    
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBuild()
    {

        $signer = new Sha256();

        $token = Yii::$app->jwt->getBuilder()
        ->setIssuer('http://test.dev') // Configures the issuer (iss claim)
        ->setAudience('http://test.dev') // Configures the audience (aud claim)
        ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60) // Configures the time before which the token cannot be accepted (nbf claim)
        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('uid', 1) // Configures a new claim, called "uid"
        ->set('test', 'wobba lobba dub dub') // Configures a new claim, called "uid"
        ->sign($signer, 'testing') //Firmada
        ->getToken(); // Retrieves the generated token

        $token->getHeaders(); // Retrieves the token headers
        $token->getClaims(); // Retrieves the token claims
        $srp_token = (string)$token;
        return ['token'=>$srp_token];
        //return $token;
    }

}
