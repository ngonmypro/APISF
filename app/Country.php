<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'Country';
  protected $primaryKey = 'CountryID';

  public function SelectCountrySeart($countryA)
  {
    $sql  = DB::connection("sqlsrv")->select("SELECT CountryID FROM Country WHERE Country LIKE '%$countryA%'");
    //dd($sql);
      return $sql;
  }

  public function SelectCountry($countryA)
  {
    $sql  = DB::connection("sqlsrv")->select("SELECT CountryID, Country FROM Country where Country = '$countryA'");
    //dd($sql);
      return $sql;
  }

  public function SelectCountrytocontact($country)
  {
    $sql  = DB::connection("sqlsrv")->select("SELECT CountryID, Country FROM Country where CountryID = '$country'");
    //dd($sql);
      return $sql;
  }
}
