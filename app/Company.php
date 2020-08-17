<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Company extends Model
{
  protected $table = 'Company';
  protected $primaryKey = 'Company.CompanyID';

  public function SelectCompany()
  {
    // $where = "WHERE TOMarketId = 'A650356B-4711-4B78-91E9-58795B408C37'
    //   OR TOMarketId = '0CF4647A-5C95-43F6-AD8A-51EEDD71510A'
    //   OR TOMarketId = 'B7BA54D6-38FF-4959-9395-BAD03881A8F3'
    //   OR TOMarketId = 'E71E17F7-673A-4B3A-8F58-8C759EE568B4'
    //   OR TOMarketId = '5524EF35-5EC9-47A7-92A3-F395E595A3D4'
    //   OR TOMarketId = '9AF66C3F-820E-4A42-BEA5-389F2FF01096'
    //   OR TOMarketId = 'B3BBEDB2-352E-4CCE-B332-4C5AB85FD601'
    //   OR TOMarketId = '32CEC734-E7D6-45BA-8EB9-CB8537683A0C'
    //   OR TOMarketId = '14A7CD80-A785-4D57-BDB4-066EAD750D63'
    //   OR TOMarketId = '39A6D437-50BE-4336-894D-505FA0C1BA8B'
    //   OR TOMarketId = '9F1B54F3-3417-42BF-9937-BBFB6AE8A39C'
    //   OR TOMarketId = '301AB24C-F77A-4BFD-9B76-3BDA869DFEA5'
    //   OR TOMarketId = 'B39608AA-7049-44A6-A08E-CAF980487612'";
    $sql = DB::connection('sqlsrv')->select("SELECT CompanyID, Company FROM Company ORDER BY Company ASC");
    //dd($sql);
      return $sql;
  }
}
