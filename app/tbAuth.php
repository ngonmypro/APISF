<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class tbAuth extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'tbAuth';
  protected $primaryKey = 'AutoId';

  public function SelectAuth($session_id)
  {
    $sql = DB::select("SELECT AutoId
            , ServerId
            , BCode
            , ISID
            , Date_Expired
            , ClientIP
            , SessionId
            , Date_Login
            , ShortCut
            , FullName
            , Email
            , officecode
            , country
            , DateCreated
            , DateUpdated
            , jwt
        FROM  tbAuth
          where sessionId = '$session_id'");

  return $sql;
  }
}
