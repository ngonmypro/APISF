<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class tbContacts extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'tbContacts';
  protected $primaryKey = 'PK_ID';
  public $timestamps = false;


}
