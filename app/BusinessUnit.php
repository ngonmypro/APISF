<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class BusinessUnit extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'BusinessUnit';
  protected $primaryKey = 'BusinessUnit.BusinessUnitID';

  public function SelectCountry()
  {
    $sql = DB::connection('sqlsrvsf')->select("SELECT * FROM SalesforceAccount");
    //dd($sql);
      return $sql;
  }

  public function CheckBU($business_unit_teamA)
  {
    $sql = DB::connection("sqlsrv")->select("SELECT BusinessUnitID FROM BusinessUnit WHERE BusinessUnit LIKE '%$business_unit_teamA%'");
    return $sql;
  }

  public function SelectBusinessUnit()
  {
    $sql = DB::connection("sqlsrv")->select("SELECT BusinessUnitID, BusinessUnit FROM BusinessUnit");
    return $sql;
  }
}
