<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LocationType extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'LocationType';
  protected $primaryKey = 'LocationType.LocationTypeID';

  public function SelectLocationType()
  {
    $where = "WHERE LocationTypeID = '1'
      OR LocationTypeID = '5'";
    $sql = DB::connection('sqlsrv')->select("SELECT LocationTypeID, LocationType FROM LocationType $where ORDER BY LocationTypeID ASC");
    //dd($sql);
      return $sql;
  }
}
