@extends('layouts.master')
@section('pageTitle', 'Salesforce To CRM')
@section('content')
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{csrf_token()}}" />
</head>
<!-- <form id="search-TO-form" target="_blank" action="{{url('crm/location/search_sale')}}" method="POST">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" name="location_id" id="location_id" />
  <input type="hidden" name="status_search" id="status_search" />
</form> -->
<aside class="normal-side">
  <section class="content-header"><h3 align='center'><b>View Data Location Salesforce</b></h3></section><hr>
  <section class="content">
    @foreach($SalesforceAccountArray as $RowData)
    <div class="box box-primary">
      <div class="box-body">

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Company</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="account_nameA" value="{{$RowData->account_nameA}}" id="account_nameA" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">City</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="cityA" value="{{$RowData->cityA}}" id="cityA" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Country</label>
          </div>
          <div class="col-sm-2">
            <select class="form-control" name="countryA" id="countryA" disabled>
                    <option value="{{$CountryID}}" >{{$Country}}</option>
            </select>
          </div>
        </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Address</label>
      </div>
      <div class="col-sm-5">
        <textarea name="billing_addressA" class="form-control" rows="2" id="billing_addressA" disabled>{{$RowData->billing_addressA}}</textarea>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Zipcode</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="ZipCodeA" value="{{$RowData->zip_codeA}}" id="ZipCodeA" disabled>
      </div>
      </div>

      <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Website</label>
      </div>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="websiteA" value="{{$RowData->websiteA}}" id="websiteA" disabled>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Phone</label>
      </div>
      <div class="col-sm-4  ">
        <div style="display:inline-flex;">
          <input type="text" class="form-control cPhone" style="width:20%" name="phone_country_prefixA" value="{{$RowData->phone_country_prefixA}}" id="phone_country_prefixA" disabled/>&nbsp;&nbsp;
          <input type="text" class="form-control aPhone" style="width:30%" name="phone_city_prefixA" value="{{$RowData->phone_city_prefixA}}" id="phone_city_prefixA" disabled/>&nbsp;&nbsp;
          <input type="text" class="form-control phone" style="width:50%" name="phoneA" value="{{$RowData->phoneA}}" id="phoneA" disabled/>
        </div>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Fax</label>
      </div>
      <div class="col-sm-4  ">
        <div style="display:inline-flex;">
          <input type="text" class="form-control cPhone" style="width:20%" name="fax_country_prefixA" value="{{$RowData->fax_country_prefixA}}" id="fax_country_prefixA" disabled/>&nbsp;&nbsp;
          <input type="text" class="form-control aPhone" style="width:30%" name="fax_city_prefixA" value="{{$RowData->fax_city_prefixA}}" id="fax_city_prefixA" disabled/>&nbsp;&nbsp;
          <input type="text" class="form-control phone" style="width:50%" name="faxA" value="{{$RowData->faxA}}" id="faxA" disabled/>
        </div>
      </div>


    </div>

    <div class="row form-group">
      <!-- <div class="col-sm-1" align='right'>
        <label for="form-control">Type</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="account_typeA" value="{{$RowData->account_typeA}}" id="account_typeA" disabled>
      </div> -->

      <div class="col-sm-1" align='right'>
        <label for="form-control">Sales Office</label>
      </div>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="sales_officeA" value="{{$RowData->sales_officeA}}" id="sales_officeA"  disabled>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Business Unit</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="business_unit_teamA" id="business_unit_teamA" disabled>
        <option value=""> # SELECT BU # </option>
        @foreach($BusinessUnitArray AS $BusinessUnitData)
        <option value="{{$BusinessUnitData->BusinessUnitID}}" <?php if($BusinessUnitData->BusinessUnit == $RowData->business_unit_teamA){ echo "selected"; } ?> >
          {{$BusinessUnitData->BusinessUnit}}</option>
        @endforeach
        </select>
      </div>

      <div class="col-sm-1" align="right">
        <label for="form-control">TO Market</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="TOMarket" id="TOMarket" disabled>
          <option value=""> # SELECT TO #</option>
          @foreach($TOMarketMasterArray as $TOMarketMasterArrayData)
            <option value="{{$TOMarketMasterArrayData->TOMarketId}}" <?php if($TOMarketMasterArrayData->TOMarketData == $RowData->to_marketA){ echo "selected"; } ?>>{{$TOMarketMasterArrayData->TOMarketData}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-1" align="right">
        <label for="form-control">Type of contact</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="Tcontact" id="Tcontact" disabled>
          @foreach($LocationTypeArray as $LocationTypeArrayData)
            <option value="{{$LocationTypeArrayData->LocationTypeID}}" <?php if($LocationTypeArrayData->LocationTypeID == $RowData->type_of_contactA){ echo "selected"; } ?>>{{$LocationTypeArrayData->LocationType}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-1" align="right">
        <label for="form-control">Type of client</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="Tclient" value="{{$RowData->account_typeA}}" id="Tclient"  disabled>
      </div>
      <!-- <div class="col-sm-2">
        <input type="checkbox" name="MICE_AGENT" id="MICE_AGENT" value="" disabled> <label for="form-control">  MICE Agent</label>
      </div> -->
      <div class="col-sm-1" align='right'>
        <label for="form-control">Group</label>
      </div>
      <div class="col-sm-3">
        <select class="form-control selectTo" name="GCountry" id="GCountry" disabled>
          <option value=""> # SELECT GROUP # </option>
          @foreach($CompanyArray as $CompanyArrayData)
            <option value="{{$CompanyArrayData->CompanyID}}"<?php if($CompanyArrayData->Company == $RowData->company_groupA){ echo "selected"; } ?>>{{$CompanyArrayData->Company}}</option>
          @endforeach
        </select>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control" style="display:none;">SFAccountId</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="SFAccountId" value="{{$RowData->account_idA}}" id="SFAccountId" style="display:none;" disabled>
      </div>
      <div class="col-sm-1" align='right'>
        <label for="form-control" style="display:none;">SFUserCreatedAcc</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="SFUserCreatedAcc" value="{{$RowData->created_byA}}" id="SFUserCreatedAcc" style="display:none;" disabled>
      </div>
      <!-- <div class="col-sm-1" align='right'>
        <label for="form-control"></label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="" value="">
      </div> -->
    </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Account Owner</label>
      </div>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="account_ownerA" value="{{$RowData->account_ownerA}}" id="account_ownerA"  disabled>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Account Source</label>
      </div>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="account_sourceA" value="{{$RowData->account_sourceA}}" id="account_sourceA"  disabled>
      </div>
    </div>

    <input type="text" class="form-control" name="locationid" value="{{$locationid}}" id="locationid" style="display:none;" disabled>
    <input type="text" class="form-control" name="session_id" value="{{$session_id}}" id="session_id" style="display:none;" disabled>
    <input type="text" class="form-control" name="created_date" value="{{$RowData->created_atA}}" id="created_date" style="display:none;" disabled>
    <input type="text" class="form-control" name="update_date" value="{{$RowData->updated_atA}}" id="update_date" style="display:none;" disabled>
    <hr>
    <div class="row form-group">
      <div class="col-sm-12" align='center'>
        <button type="button" class="btn btn-flat btn-warning btn-sm" name="button" Onclick="UpdateToCrm();">Update CRM</button>
      </div>
    </div>
  </div>
</div>
@endforeach
  </section>
</aside>
  @include('layouts.inc-scripts')
  <script>
  $(document).ready(function () {
  $('.selectTo').select2();
  $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
      });
});

function UpdateToCrm() {
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var url = '{{url('/UpdateSfLocationToCrm')}}';

  var account_nameA = $("#account_nameA").val();
  var cityA = $("#cityA").val();
  var countryA = $("#countryA").val();
  var ZipCodeA = $("#ZipCodeA").val();
  var billing_addressA = $("#billing_addressA").val();
  var websiteA = $("#websiteA").val();
  var phone_country_prefixA = $("#phone_country_prefixA").val();
  var phone_city_prefixA = $("#phone_city_prefixA").val();
  var phoneA = $("#phoneA").val();
  var fax_country_prefixA = $("#fax_country_prefixA").val();
  var fax_city_prefixA = $("#fax_city_prefixA").val();
  var faxA = $("#faxA").val();
  // var account_typeA = $("#account_typeA").val();
  var sales_officeA = $("#sales_officeA").val();
  var business_unit_teamA = $("#business_unit_teamA").val();
  var SFAccountId = $("#SFAccountId").val();
  var SFUserCreatedAcc = $("#SFUserCreatedAcc").val();
  var TOMarket = $("#TOMarket").val();
  var Tcontact = $("#Tcontact").val();
  var Tclient = $("#Tclient").val();
  var GCountry = $("#GCountry").val();
  var session_id = $("#session_id").val();
  var locationid = $("#locationid").val();
  var employeeid = $("#employeeid").val();
  var account_ownerA = $("#account_ownerA").val();
  var account_sourceA = $("#account_sourceA").val();
  var created_date = $("#created_date").val();
  var update_date = $("#update_date").val();

  if (countryA == '0' || countryA == '240') {
    alert("No country information!! Please check in the Salesforce system.");
    exit();
  }

  if (account_nameA == '') {
    alert("No company information!! Please check in the Salesforce system.");
    exit();
  }

  if (TOMarket == '') {
    alert("No TO Market information!! Please check in the Salesforce system.");
    exit();
  }

  if (Tcontact == '') {
    alert("No Type of contact information!! Please check in the Salesforce system.");
    exit();
  }
  if (GCountry == ''  || GCountry == '4489') {
    alert("No GROUP information!! Please check in the Salesforce system.");
    exit();
  }
  // if ($("#MICE_AGENT").is(':checked')) {
  //   var MICE_AGENT = 1;
  // }else {
  //   var MICE_AGENT = 0;
  // }

  var request = $.ajax({
        url: url,
        method: "POST",
        data: {
                account_nameA: account_nameA,
                cityA: cityA,
                countryA: countryA,
                ZipCodeA: ZipCodeA,
                billing_addressA: billing_addressA,
                websiteA: websiteA,
                phone_country_prefixA: phone_country_prefixA,
                phone_city_prefixA: phone_city_prefixA,
                phoneA: phoneA,
                fax_country_prefixA: fax_country_prefixA,
                fax_city_prefixA: fax_city_prefixA,
                faxA: faxA,
                // account_typeA: account_typeA,
                sales_officeA: sales_officeA,
                business_unit_teamA: business_unit_teamA,
                SFAccountId: SFAccountId,
                SFUserCreatedAcc: SFUserCreatedAcc,
                TOMarket: TOMarket,
                Tcontact: Tcontact,
                Tclient: Tclient,
                GCountry: GCountry,
                session_id: session_id,
                locationid: locationid,
                employeeid: employeeid,
                account_ownerA: account_ownerA,
                account_sourceA: account_sourceA,
                created_date: created_date,
                update_date: update_date,
                // MICE_AGENT: MICE_AGENT,
                _token: CSRF_TOKEN
            },
        dataType: "text"
  });
  request.done(function(data) {
    alert(data);
    window.close();
    //$("#div-result").html(data);
  //  alert("Yes "+data);
  });
  request.fail(function(data) {
    alert("Error search Salesforce");
  });

}

  </script>
@endsection
