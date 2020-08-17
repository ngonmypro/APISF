<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Location extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'Location';
  protected $primaryKey = 'LocationID';
  public $timestamps = false;

  public function SelectLocation($namesf)
  {
    $where = '';
    if ($namesf != '') {
      $where .= "(EP.FirstName like '%$namesf%' OR EP.LastName LIKE '%$namesf%')";
    }

    $sql  = DB::connection("sqlsrv")->select("SELECT EP.FirstName AS FirstName
      , EP.LastName AS LastName
      , EP.SFContactId
      , EP.SFDateCreated
      , EP.SFUserCreated
      , LC.SFAccountId
      , LC.SFDateCreated
      , LC.SFUserCreated
      FROM Location AS LC
      INNER JOIN Employee AS EP ON LC.LocationID = EP.LocationID

       WHERE $where
       AND EP.SFContactId IS NOT NULL
       AND EP.SFDateCreated IS NOT NULL
       AND EP.SFUserCreated IS NOT NULL
       AND LC.SFAccountId IS NOT NULL
       AND LC.SFDateCreated IS NOT NULL
       AND LC.SFUserCreated IS NOT NULL

       GROUP BY EP.FirstName
         , EP.LastName
         , EP.SFContactId
         , EP.SFDateCreated
         , EP.SFUserCreated
         , LC.SFAccountId
         , LC.SFDateCreated
         , LC.SFUserCreated");
    //dd($sql);
      return $sql;
  }

  public function SelectLocationEmployee($first_nameC,$last_nameC)
  {
    $where = '';
    if ($first_nameC != '') {
      $where .= "EP.FirstName = '$first_nameC'";
    }

    if ($last_nameC != '') {
      $where .= "AND EP.LastName = '$last_nameC'";
    }

    $sql  = DB::connection("sqlsrv")->select("SELECT EP.FirstName AS FirstName
      , EP.LastName AS LastName
      , EP.SFContactId
      , EP.SFDateCreated
      , EP.SFUserCreated
      , LC.SFAccountId
      , LC.SFDateCreated
      , LC.SFUserCreated
      FROM Location AS LC
      INNER JOIN Employee AS EP ON LC.LocationID = EP.LocationID

       WHERE $where
       AND EP.SFContactId IS NOT NULL
       AND EP.SFDateCreated IS NOT NULL
       AND EP.SFUserCreated IS NOT NULL
       AND LC.SFAccountId IS NOT NULL
       AND LC.SFDateCreated IS NOT NULL
       AND LC.SFUserCreated IS NOT NULL

       GROUP BY EP.FirstName
         , EP.LastName
         , EP.SFContactId
         , EP.SFDateCreated
         , EP.SFUserCreated
         , LC.SFAccountId
         , LC.SFDateCreated
         , LC.SFUserCreated");
    //dd($sql);
      return $sql;
  }

  public function ChkLocation($account_id/*,$created_at,$updated_at*/)
  {
    /*  $where = "";
    if ($updated_at != '') {
      $where = " AND SFDateCreated != '$updated_at'";
    }else {
      $where = " AND SFDateCreated != '$created_at'";
    }*/
    $sql  = DB::connection("sqlsrv")->select("SELECT LC.LocationID AS LocationID
      , LC.SFDateCreated AS SFDateCreated

      FROM Location AS LC

       WHERE LC.SFAccountId = '$account_id'  ");
      return $sql;
  }

  public function SelectLocationID($SFAccountId)
  {
    $sql = DB::select("SELECT LocationID FROM Location WHERE SFAccountId = '$SFAccountId'");

    return $sql;
  }

  public function ViewDataMerge($account_id)
  {
    $sql = DB::select("SELECT LocationID,
            CompanyID,
            LocationTypeID,
            Company,
            Street,
            City,
            CCodePhone,
            ACodePhone,
            Phone,
            CCodeFax,
            ACodeFax,
            Fax,
            CountryID,
            Url1,
            Created,
            UserBy,
            MICE_AGENT,
            BusinessUnitID,
            SFDateCreated,
            SFUserCreated,
            SFAccountId,
            TOMarketId,
            TO_TA

        FROM Location
        WHERE SFAccountId = '$account_id'");

        return $sql;
  }

}
