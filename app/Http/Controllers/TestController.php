<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Response;
use App\SalesforceAccount;
use APP\Employee;

class TestController extends Controller{

  public function TestShow()
  {
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
       FROM SalesforceAccount AS SFA
      INNER JOIN SalesforceContact AS SFC ON SFA.salesforce_account_pk_id = SFC.salesforce_account_pk_id");


    return view('SalesforceToCRM/index')->with(compact('sql'));
  }
}
