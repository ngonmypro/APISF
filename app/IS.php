<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class IS extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'IS';
  protected $primaryKey = 'ISID';
  public $timestamps = false;

  public function SelectISID($EmployeeID)
  {
    $sql = DB::connection('sqlsrv')->select("SELECT ISID FROM IS WHERE EmployeeID = '$EmployeeID'");

    return $sql;
  }
}
