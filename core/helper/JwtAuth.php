<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth{

  /**
   * @param int $uid 用户id
   * @param int $howLongExpire 多久过期
   * @param int $salt 盐
   * @return array [expireTime:int(seconds),token:string]
   */
  public static function generateToken(
    $uid, //用户id
    $howLongExpire, //多久过期 Unix时间戳
    $salt //盐
  ){

    $now = time();
    
    $payload = [
      "uid" => $uid,
      "iss" => 'hedaoshe.com',
      "isa" => $now,
      "nbf" => $now,
      "exp" => $now + $howLongExpire,
    ];

    $token = JWT::encode($payload, $salt, 'HS256');
    return [
      'token'=>$token,
      'expireTime'=>$now + $howLongExpire,
    ];

  }


  public static function verifyToken($token,$salt){
    try{
      $decoded = JWT::decode($token, new Key($salt, 'HS256'));
      return true;
    }catch(Exception $e){
      return false;
    }

    return true;

  }
  

}