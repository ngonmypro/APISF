<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LeadSourceType extends Model
{
  protected $connection = 'sqlsrv';
  protected $table = 'LeadSourceType';
  protected $primaryKey = 'LeadSourceType.SourceId';
  public $timestamps = false;

  public function SelectSourceType($account_sourceA)
  {
    $sql = DB::select("SELECT [SourceId]
              ,[SourceName]
           FROM [ICSDB].[dbo].[LeadSourceType]
           WHERE SourceName = '$account_sourceA'
    ");

      return $sql;
  }
}
