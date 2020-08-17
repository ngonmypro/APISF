<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'Employee';
  protected $primaryKey = 'EmployeeID';
  public $timestamps = false;

  public function SelectCountry()
  {
    $sql = DB::connection('sqlsrv')->select("SELECT * FROM Employee");
    //dd($sql);
      return $sql;
  }

  public function ChkEmpID($employee_id)
  {
    $sql = DB::connection('sqlsrv')->select("SELECT EmployeeID, SFDateCreated FROM Employee WHERE EmployeeID = '$employee_id'");

    return $sql;
  }

  public function ViewDataUpdate($employeeid)
  {
    $sql = DB::connection('sqlsrv')->select("SELECT LocationID
              , FirstName
              , LastName
              , NickName
              , Title
              , Birthday
              , ACodePhone
              , CCodePhone
              , Phone
              , ACodeAltPhone
              , CCodeAltPhone
              , AltPhone
              , ACodeFax
              , CCodeFax
              , Fax
              , ACodeMobile
              , CCodeMobile
              , Mobile
              , leadsource
              , Email
              , SFDateCreated
              , SFUserCreated
              , SFContactId
              , Created
              , UserBy
            FROM Employee
              WHERE EmployeeID = '$employeeid'");

    return $sql;
  }

  public function SelectIsid($Employee)
  {
    $sql = DB::connection('sqlsrv')->select(" SELECT  [IS].ISID

        FROM Employee AS Emp
        INNER JOIN [IS] ON Emp.EmployeeId = [IS].EmployeeId

        WHERE Emp.FirstName + ' ' + Emp.LastName = '$Employee'
    ");

    return $sql;
  }
}
