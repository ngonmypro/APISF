<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LeadSourceInformation extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'LeadSourceInformation';
  protected $primaryKey = 'LeadSourceInformation.LocationId';
  public $timestamps = false;

}
