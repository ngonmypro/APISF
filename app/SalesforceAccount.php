<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class SalesforceAccount extends Model
{
  protected $connection = 'sqlsrvsf';
  // protected $table = 'SalesforceAccount';
  // protected $primaryKey = 'SalesforceAccount.salesforce_account_pk_id';

  public function SelectCountry($namesf)
  {
    $where = '';
    if ($namesf != '') {
      $where .= "AND SFC.first_name LIKE '%$namesf%' OR SFC.last_name LIKE '%$namesf%' OR SFA.account_name LIKE '%$namesf%'";
    }

    $sql = DB::connection('sqlsrvsf')->select("SELECT SFA.[account_id] AS account_id
      ,SFA.[account_name] AS account_name
      ,SFC.[account_id] AS contact_id
      ,SFC.[salutation] AS title_nameC
      ,SFC.[first_name] AS first_nameC
      ,SFC.[last_name] AS last_nameC
      ,SFC.[email] AS emailC
      ,SFC.[salesforce_account_pk_id] AS salesforce_account_pk_idC
      ,SFC.[created_at] AS created_atC
      ,SFC.[updated_at] AS updated_atC
      ,SFC.[department_name] AS department_nameC
      ,SFC.[position_name] AS position_nameC
      ,SFC.[employee_id] AS employee_idC
      ,SFC.[is_sync] AS is_syncC
       FROM SalesforceAccount AS SFA
      INNER JOIN SalesforceContact AS SFC ON SFA.salesforce_account_pk_id LIKE SFC.salesforce_account_pk_id
      WHERE SFC.[is_sync] != '0'
      $where

      ");
// dd($sql);
      return $sql;
  }

  public function SelectLocation($namesf)
  {
    $where = '';
    if ($namesf != '') {
      $where .= "AND SFA.account_name LIKE '%$namesf%'";
    }

    $sql = DB::connection('sqlsrvsf')->select("SELECT SFA.[account_id] AS account_id
      ,SFA.[account_name] AS account_name
      ,SFA.[country] AS account_country
      ,SFA.[salesforce_account_pk_id] AS salesforce_account_pk_id
      ,SFA.[created_at] AS created_at
      ,SFA.[updated_at] AS updated_at
      ,SFA.[is_sync] AS is_sync
       FROM SalesforceAccount AS SFA
      -- LEFT JOIN SalesforceContact AS SFC ON SFA.salesforce_account_pk_id = SFC.salesforce_account_pk_id
      WHERE SFA.[is_sync] != '0'
      $where

      GROUP BY SFA.[account_id]
        ,SFA.[account_name]
        ,SFA.[country]
        ,SFA.[salesforce_account_pk_id]
        ,SFA.[created_at]
        ,SFA.[updated_at]
        ,SFA.[is_sync]
      ");

      return $sql;
  }

  public function ViewDataSalesforce($salesforce_account_pk_id)
  {
    $where = '';
    if ($salesforce_account_pk_id != '') {
      $where .= "WHERE SFA.salesforce_account_pk_id = '$salesforce_account_pk_id'";
    }
  $sql = DB::connection('sqlsrvsf')->select("SELECT SFA.[salesforce_account_pk_id] AS salesforce_account_pk_idA
    ,SFA.[account_id] AS account_idA
    ,SFA.[account_description] AS account_descriptionA
    ,SFA.[billing_address] AS billing_addressA
    ,SFA.[account_owner] AS account_ownerA
    ,SFA.[city] AS cityA
    ,SFA.[country] AS countryA
    ,SFA.[phone_country_prefix] AS phone_country_prefixA
    ,SFA.[phone_city_prefix] AS phone_city_prefixA
    ,SFA.[phone] AS phoneA
    ,SFA.[fax_country_prefix] AS fax_country_prefixA
    ,SFA.[fax_city_prefix] AS fax_city_prefixA
    ,SFA.[fax] AS faxA
    ,SFA.[industry_name] AS industry_nameA
    ,SFA.[shipping_address] AS shipping_addressA
    ,SFA.[website] AS websiteA
    ,SFA.[account_type] AS account_typeA
    ,SFA.[sales_office] AS sales_officeA
    ,SFA.[business_unit_team] AS business_unit_teamA
    ,SFA.[created_at] AS created_atA
    ,SFA.[created_by] AS created_byA
    ,SFA.[updated_at] AS updated_atA
    ,SFA.[updated_by] AS updated_byA
    ,SFA.[is_sync] AS is_syncA
    ,SFA.[account_name] AS account_nameA
    ,SFA.[account_source] AS account_sourceA

    ,SFC.[salesforce_contact_pk_id] AS salesforce_contact_pk_idC
    ,SFC.[account_id] AS account_idC
    ,SFC.[salutation] AS salutationC
    ,SFC.[first_name] AS first_nameC
    ,SFC.[last_name] AS last_nameC
    ,SFC.[middle_name] AS middle_nameC
    ,SFC.[suffix] AS suffixC
    ,SFC.[do_not_call] AS do_not_callC
    ,SFC.[do_not_email] AS do_not_emailC
    ,SFC.[birthdate] AS birthdateC
    ,SFC.[email] AS emailC
    ,SFC.[leadsource] AS leadsourceC
    ,SFC.[mailing_address] AS mailing_addressC
    ,SFC.[phone_country_prefix] AS phone_country_prefixC
    ,SFC.[phone_city_prefix] AS phone_city_prefixC
    ,SFC.[phone] AS phoneC
    ,SFC.[home_country_prefix] AS home_country_prefixC
    ,SFC.[home_city_prefix] AS home_city_prefixC
    ,SFC.[home] AS homeC
    ,SFC.[fax_country_prefix] AS fax_country_prefixC
    ,SFC.[fax_city_prefix] AS fax_city_prefixC
    ,SFC.[fax] AS faxC
    ,SFC.[mobile_country_prefix] AS mobile_country_prefixC
    ,SFC.[mobile_city_prefix] AS mobile_city_prefixC
    ,SFC.[mobile] AS mobileC
    ,SFC.[created_at] AS created_atC
    ,SFC.[created_by] AS created_byC
    ,SFC.[updated_at] AS updated_atC
    ,SFC.[updated_by] AS updated_byC
    ,SFC.[is_sync] AS is_syncC
    ,SFC.[salesforce_account_pk_id] AS salesforce_account_pk_idC
    ,SFC.[iata_travel_agency_number] AS iata_travel_agency_numberC
    ,SFC.[employee_id] AS employee_idC
    ,SFC.[title_name] AS title_nameC
    ,SFC.[department_name] AS department_nameC
    ,SFC.[position_name] AS position_nameC
     FROM SalesforceAccount AS SFA
    INNER JOIN SalesforceContact AS SFC ON SFA.salesforce_account_pk_id LIKE SFC.salesforce_account_pk_id

    $where
    ");

    return $sql;
  }

  public function ViewDataSalesforceAccount($salesforce_account_pk_id)
  {
    $where = '';
    if ($salesforce_account_pk_id != '') {
      $where .= "WHERE SFA.salesforce_account_pk_id = '$salesforce_account_pk_id'";
    }
  $sql = DB::connection('sqlsrvsf')->select("SELECT SFA.[salesforce_account_pk_id] AS salesforce_account_pk_idA
    ,SFA.[account_id] AS account_idA
    ,SFA.[account_description] AS account_descriptionA
    ,SFA.[billing_address] AS billing_addressA
    ,SFA.[account_owner] AS account_ownerA
    ,SFA.[city] AS cityA
    ,SFA.[country] AS countryA
    ,SFA.[phone_country_prefix] AS phone_country_prefixA
    ,SFA.[phone_city_prefix] AS phone_city_prefixA
    ,SFA.[phone] AS phoneA
    ,SFA.[fax_country_prefix] AS fax_country_prefixA
    ,SFA.[fax_city_prefix] AS fax_city_prefixA
    ,SFA.[fax] AS faxA
    ,SFA.[industry_name] AS industry_nameA
    ,SFA.[shipping_address] AS shipping_addressA
    ,SFA.[website] AS websiteA
    ,SFA.[account_type] AS account_typeA
    ,SFA.[sales_office] AS sales_officeA
    ,SFA.[business_unit_team] AS business_unit_teamA
    ,SFA.[created_at] AS created_atA
    ,SFA.[created_by] AS created_byA
    ,SFA.[updated_at] AS updated_atA
    ,SFA.[updated_by] AS updated_byA
    ,SFA.[is_sync] AS is_syncA
    ,SFA.[account_name] AS account_nameA
    ,SFA.[account_source] AS account_sourceA
    ,SFA.[to_market] AS to_marketA
    ,SFA.[company_group] AS company_groupA
    ,SFA.[type_of_contact] AS type_of_contactA
    ,SFA.[zip_code] AS zip_codeA

     FROM SalesforceAccount AS SFA

    $where
    ");

    return $sql;
  }

  public function ViewDataSalesforceLocationUpdate($salesforce_account_pk_id)
  {
    $where = '';
    if ($salesforce_account_pk_id != '') {
      $where .= "WHERE SFA.salesforce_account_pk_id = '$salesforce_account_pk_id'";
    }

  $sql = DB::connection('sqlsrvsf')->select("SELECT SFA.[salesforce_account_pk_id] AS salesforce_account_pk_idA
    ,SFA.[account_id] AS account_idA
    ,SFA.[account_description] AS account_descriptionA
    ,SFA.[billing_address] AS billing_addressA
    ,SFA.[account_owner] AS account_ownerA
    ,SFA.[city] AS cityA
    ,SFA.[country] AS countryA
    ,SFA.[phone_country_prefix] AS phone_country_prefixA
    ,SFA.[phone_city_prefix] AS phone_city_prefixA
    ,SFA.[phone] AS phoneA
    ,SFA.[fax_country_prefix] AS fax_country_prefixA
    ,SFA.[fax_city_prefix] AS fax_city_prefixA
    ,SFA.[fax] AS faxA
    ,SFA.[industry_name] AS industry_nameA
    ,SFA.[shipping_address] AS shipping_addressA
    ,SFA.[website] AS websiteA
    ,SFA.[account_type] AS account_typeA
    ,SFA.[sales_office] AS sales_officeA
    ,SFA.[business_unit_team] AS business_unit_teamA
    ,SFA.[created_at] AS created_atA
    ,SFA.[created_by] AS created_byA
    ,SFA.[updated_at] AS updated_atA
    ,SFA.[updated_by] AS updated_byA
    ,SFA.[is_sync] AS is_syncA
    ,SFA.[account_name] AS account_nameA
    ,SFA.[account_source] AS account_sourceA
    ,SFA.[to_market] AS to_marketA
    ,SFA.[company_group] AS company_groupA
    ,SFA.[type_of_contact] AS type_of_contactA
    ,SFA.[zip_code] AS zip_codeA

    -- ,SFC.[salesforce_contact_pk_id] AS salesforce_contact_pk_idC
    -- ,SFC.[account_id] AS account_idC
    -- ,SFC.[salutation] AS salutationC
    -- ,SFC.[first_name] AS first_nameC
    -- ,SFC.[last_name] AS last_nameC
    -- ,SFC.[middle_name] AS middle_nameC
    -- ,SFC.[suffix] AS suffixC
    -- ,SFC.[do_not_call] AS do_not_callC
    -- ,SFC.[do_not_email] AS do_not_emailC
    -- ,SFC.[birthdate] AS birthdateC
    -- ,SFC.[email] AS emailC
    -- ,SFC.[leadsource] AS leadsourceC
    -- ,SFC.[mailing_address] AS mailing_addressC
    -- ,SFC.[phone_country_prefix] AS phone_country_prefixC
    -- ,SFC.[phone_city_prefix] AS phone_city_prefixC
    -- ,SFC.[phone] AS phoneC
    -- ,SFC.[home_country_prefix] AS home_country_prefixC
    -- ,SFC.[home_city_prefix] AS home_city_prefixC
    -- ,SFC.[home] AS homeC
    -- ,SFC.[fax_country_prefix] AS fax_country_prefixC
    -- ,SFC.[fax_city_prefix] AS fax_city_prefixC
    -- ,SFC.[fax] AS faxC
    -- ,SFC.[mobile_country_prefix] AS mobile_country_prefixC
    -- ,SFC.[mobile_city_prefix] AS mobile_city_prefixC
    -- ,SFC.[mobile] AS mobileC
    -- ,SFC.[created_at] AS created_atC
    -- ,SFC.[created_by] AS created_byC
    -- ,SFC.[updated_at] AS updated_atC
    -- ,SFC.[updated_by] AS updated_byC
    -- ,SFC.[is_sync] AS is_syncC
    -- ,SFC.[salesforce_account_pk_id] AS salesforce_account_pk_idC
     FROM SalesforceAccount AS SFA
    -- INNER JOIN SalesforceContact AS SFC ON SFA.salesforce_account_pk_id = SFC.salesforce_account_pk_id

    $where
    ");

    return $sql;
  }

  public function ViewDataSalesforceMerge($salesforce_account_pk_id,$first_nameC,$last_nameC)
  {
    $where = '';
    if ($salesforce_account_pk_id != '') {
      $where .= "WHERE SFA.salesforce_account_pk_id = '$salesforce_account_pk_id'";
    }

    if ($first_nameC != '') {
      $where .= "AND SFC.first_name = '$first_nameC'";
    }

    if ($last_nameC != '') {
      $where .= "AND SFC.last_name = '$last_nameC'";
    }

  $sql = DB::connection('sqlsrvsf')->select("SELECT SFA.[salesforce_account_pk_id] AS salesforce_account_pk_idA
    ,SFA.[account_id] AS account_idA
    ,SFA.[account_description] AS account_descriptionA
    ,SFA.[billing_address] AS billing_addressA
    ,SFA.[account_owner] AS account_ownerA
    ,SFA.[city] AS cityA
    ,SFA.[country] AS countryA
    ,SFA.[phone_country_prefix] AS phone_country_prefixA
    ,SFA.[phone_city_prefix] AS phone_city_prefixA
    ,SFA.[phone] AS phoneA
    ,SFA.[fax_country_prefix] AS fax_country_prefixA
    ,SFA.[fax_city_prefix] AS fax_city_prefixA
    ,SFA.[fax] AS faxA
    ,SFA.[industry_name] AS industry_nameA
    ,SFA.[shipping_address] AS shipping_addressA
    ,SFA.[website] AS websiteA
    ,SFA.[account_type] AS account_typeA
    ,SFA.[sales_office] AS sales_officeA
    ,SFA.[business_unit_team] AS business_unit_teamA
    ,SFA.[created_at] AS created_atA
    ,SFA.[created_by] AS created_byA
    ,SFA.[updated_at] AS updated_atA
    ,SFA.[updated_by] AS updated_byA
    ,SFA.[is_sync] AS is_syncA
    ,SFA.[account_name] AS account_nameA
    ,SFA.[account_source] AS account_sourceA

    ,SFC.[salesforce_contact_pk_id] AS salesforce_contact_pk_idC
    ,SFC.[account_id] AS account_idC
    ,SFC.[salutation] AS salutationC
    ,SFC.[first_name] AS first_nameC
    ,SFC.[last_name] AS last_nameC
    ,SFC.[middle_name] AS middle_nameC
    ,SFC.[suffix] AS suffixC
    ,SFC.[do_not_call] AS do_not_callC
    ,SFC.[do_not_email] AS do_not_emailC
    ,SFC.[birthdate] AS birthdateC
    ,SFC.[email] AS emailC
    ,SFC.[leadsource] AS leadsourceC
    ,SFC.[mailing_address] AS mailing_addressC
    ,SFC.[phone_country_prefix] AS phone_country_prefixC
    ,SFC.[phone_city_prefix] AS phone_city_prefixC
    ,SFC.[phone] AS phoneC
    ,SFC.[home_country_prefix] AS home_country_prefixC
    ,SFC.[home_city_prefix] AS home_city_prefixC
    ,SFC.[home] AS homeC
    ,SFC.[fax_country_prefix] AS fax_country_prefixC
    ,SFC.[fax_city_prefix] AS fax_city_prefixC
    ,SFC.[fax] AS faxC
    ,SFC.[mobile_country_prefix] AS mobile_country_prefixC
    ,SFC.[mobile_city_prefix] AS mobile_city_prefixC
    ,SFC.[mobile] AS mobileC
    ,SFC.[created_at] AS created_atC
    ,SFC.[created_by] AS created_byC
    ,SFC.[updated_at] AS updated_atC
    ,SFC.[updated_by] AS updated_byC
    ,SFC.[is_sync] AS is_syncC
    ,SFC.[salesforce_account_pk_id] AS salesforce_account_pk_idC
    ,SFC.[iata_travel_agency_number] AS iata_travel_agency_numberC
    ,SFC.[employee_id] AS employee_idC
    ,SFC.[title_name] AS title_nameC
    ,SFC.[department_name] AS department_nameC
    ,SFC.[position_name] AS position_nameC
     FROM SalesforceAccount AS SFA
    INNER JOIN SalesforceContact AS SFC ON SFA.salesforce_account_pk_id LIKE SFC.salesforce_account_pk_id

    $where
    ");

    return $sql;
  }

  public function UpdateEmpID($AccountID,$Employee)
  {
    $sql = DB::connection('sqlsrvsf')->update("UPDATE SalesforceContact
      SET employee_id = '$Employee',
          is_sync = '0'
      WHERE account_id = '$AccountID'
    ");

    return $sql;
  }

  public function UpdateSync($AccountID)
  {
    $sql = DB::connection('sqlsrvsf')->update("UPDATE SalesforceContact
      SET is_sync = '0'
      WHERE account_id = '$AccountID'
    ");

    return $sql;
  }

  public function UpdateSyncAccount($AccountID)
  {
    $sql = DB::connection('sqlsrvsf')->update("UPDATE SalesforceAccount
      SET is_sync = '0'
      WHERE account_id = '$AccountID'
    ");

    return $sql;
  }
}
