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
  <section class="content-header"><h3 align='center'><b>View Data Salesforce</b></h3></section>
  <section class="content">
    @foreach($SalesforceAccountArray as $RowData)
    <div class="box box-primary">
      <div class="box-body">
        <h4>To Employee</h4>
        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Title</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="salutationC" value="{{$RowData->salutationC}}" id="salutationC">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">FirstName</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="first_nameC" value="{{$RowData->first_nameC}}" id="first_nameC">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">LastName</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="last_nameC" value="{{$RowData->last_nameC}}" id="last_nameC">
          </div>
        </div>

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">NickName</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="middle_nameC" value="{{$RowData->middle_nameC}}" id="middle_nameC">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Birthday</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control datepicker" name="birthdateC" value="{{$RowData->birthdateC}}" id="birthdateC">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">E-mail</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="emailC" value="{{$RowData->emailC}}" id="emailC">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Phone</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="phone_country_prefixC" value="{{$RowData->phone_country_prefixC}}" id="phone_country_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="phone_city_prefixC" value="{{$RowData->phone_city_prefixC}}" id="phone_city_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="phoneC" value="{{$RowData->phoneC}}" id="phoneC"/>
            </div>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Phone home</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="home_country_prefixC" value="{{$RowData->home_country_prefixC}}" id="home_country_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="home_city_prefixC" value="{{$RowData->home_city_prefixC}}" id="home_city_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="homeC" value="{{$RowData->homeC}}" id="homeC"/>
            </div>
          </div>
          </div>

          <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Fax</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="fax_country_prefixC" value="{{$RowData->fax_country_prefixC}}" id="fax_country_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="fax_city_prefixC" value="{{$RowData->fax_city_prefixC}}" id="fax_city_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="faxC" value="{{$RowData->faxC}}" id="faxC"/>
            </div>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Mobile</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="mobile_country_prefixC" value="{{$RowData->mobile_country_prefixC}}" id="mobile_country_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="mobile_city_prefixC" value="{{$RowData->mobile_city_prefixC}}" id="mobile_city_prefixC"/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="mobileC" value="{{$RowData->mobileC}}" id="mobileC"/>
            </div>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Leadsource</label>
          </div>
          <div class="col-sm-3  ">
              <input type="text" class="form-control" name="leadsourceC" value="{{$RowData->leadsourceC}}" id="leadsourceC">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Address</label>
          </div>
          <div class="col-sm-5">
            <textarea name="mailing_addressC" class="form-control" rows="2" id="mailing_addressC">{{$RowData->mailing_addressC}}</textarea>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control" style="display:none;">SFContactId</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="account_idC" value="{{$RowData->account_idC}}" id="SFContactId" style="display:none;">
          </div>
          <div class="col-sm-1" align='right'>
            <label for="form-control" style="display:none;">SFCreatedTimeCon</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="SFCreatedTimeCon" value="{{$RowData->created_atC}}" id="SFCreatedTimeCon" style="display:none;">
          </div>
          <div class="col-sm-2" align='right'>
            <label for="form-control" style="display:none;">SFUserCreatedCon</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="created_byC" value="{{$RowData->created_byC}}" id="SFUserCreatedCon" style="display:none;">
          </div>
        </div>


        <hr>
        <h4>To Location</h4>
        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Company</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="account_descriptionA" value="{{$RowData->account_descriptionA}}" id="account_descriptionA">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">City</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="cityA" value="{{$RowData->cityA}}" id="cityA">
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Country</label>
          </div>
          <div class="col-sm-2">
            <select class="form-control" name="countryA" id="countryA">
              @foreach($CountryArray AS $CountryData)
              <option value="{{$CountryData->CountryID}}" <?php if($CountryData->Country == $RowData->countryA){ echo "selected"; } ?> >{{$CountryData->Country}}</option>
              @endforeach
            </select>
          </div>
        </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Address</label>
      </div>
      <div class="col-sm-5">
        <textarea name="billing_addressA" class="form-control" rows="2" id="billing_addressA">{{$RowData->billing_addressA}}</textarea>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Website</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="websiteA" value="{{$RowData->websiteA}}" id="websiteA">
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Phone</label>
      </div>
      <div class="col-sm-4  ">
        <div style="display:inline-flex;">
          <input type="text" class="form-control cPhone" style="width:20%" name="phone_country_prefixA" value="{{$RowData->phone_country_prefixA}}" id="phone_country_prefixA"/>&nbsp;&nbsp;
          <input type="text" class="form-control aPhone" style="width:30%" name="phone_city_prefixA" value="{{$RowData->phone_city_prefixA}}" id="phone_city_prefixA"/>&nbsp;&nbsp;
          <input type="text" class="form-control phone" style="width:50%" name="phoneA" value="{{$RowData->phoneA}}" id="phoneA"/>
        </div>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Fax</label>
      </div>
      <div class="col-sm-4  ">
        <div style="display:inline-flex;">
          <input type="text" class="form-control cPhone" style="width:20%" name="fax_country_prefixA" value="{{$RowData->fax_country_prefixA}}" id="fax_country_prefixA"/>&nbsp;&nbsp;
          <input type="text" class="form-control aPhone" style="width:30%" name="fax_city_prefixA" value="{{$RowData->fax_city_prefixA}}" id="fax_city_prefixA"/>&nbsp;&nbsp;
          <input type="text" class="form-control phone" style="width:50%" name="faxA" value="{{$RowData->faxA}}" id="faxA"/>
        </div>
      </div>


    </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Type</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="account_typeA" value="{{$RowData->account_typeA}}" id="account_typeA">
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Sales Office</label>
      </div>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="sales_officeA" value="{{$RowData->sales_officeA}}" id="sales_officeA" >
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control">Business Unit</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="business_unit_teamA" id="business_unit_teamA">
        <option value=""> # SELECT BU # </option>
        @foreach($BusinessUnitArray AS $BusinessUnitData)
        <option value="{{$BusinessUnitData->BusinessUnitID}}" <?php if($BusinessUnitData->BusinessUnit == $RowData->business_unit_teamA){ echo "selected"; } ?> >
          {{$BusinessUnitData->BusinessUnit}}</option>
        @endforeach
        </select>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-1" align="right">
        <label for="form-control">TO Market</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="TOMarket" id="TOMarket">
          <option value=""> # SELECT TO #</option>
          @foreach($TOMarketMasterArray as $TOMarketMasterArrayData)
            <option value="{{$TOMarketMasterArrayData->TOMarketId}}">{{$TOMarketMasterArrayData->TOMarketData}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-1" align="right">
        <label for="form-control">Type of contact</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="Tcontact" id="Tcontact">
          @foreach($LocationTypeArray as $LocationTypeArrayData)
            <option value="{{$LocationTypeArrayData->LocationTypeID}}">{{$LocationTypeArrayData->LocationType}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-1" align="right">
        <label for="form-control">Type of client</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control" name="Tclient" id="Tclient">
          <option value=""> # SELECT Client #</option>
          @foreach($TO_TA as $TO_TADATA)
            <option value="{{$TO_TADATA}}">{{$TO_TADATA}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-2">
        <input type="checkbox" name="MICE_AGENT" id="MICE_AGENT" value=""> <label for="form-control">  MICE Agent</label>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-sm-1" align='right'>
        <label for="form-control">Group</label>
      </div>
      <div class="col-sm-2">
        <select class="form-control selectTo" name="GCountry" id="GCountry">
          <option value=""> # SELECT GROUP # </option>
          @foreach($CompanyArray as $CompanyArrayData)
            <option value="{{$CompanyArrayData->CompanyID}}">{{$CompanyArrayData->Company}}</option>
          @endforeach
        </select>
      </div>

      <div class="col-sm-1" align='right'>
        <label for="form-control" style="display:none;">SFAccountId</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="SFAccountId" value="{{$RowData->account_idA}}" id="SFAccountId" style="display:none;">
      </div>
      <div class="col-sm-1" align='right'>
        <label for="form-control" style="display:none;">SFCreatedTimeAcc</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="SFCreatedTimeAcc" value="{{$RowData->created_atA}}" id="SFCreatedTimeAcc" style="display:none;">
      </div>
      <div class="col-sm-1" align='right'>
        <label for="form-control" style="display:none;">SFUserCreatedAcc</label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="SFUserCreatedAcc" value="{{$RowData->created_byA}}" id="SFUserCreatedAcc" style="display:none;">
      </div>
      <!-- <div class="col-sm-1" align='right'>
        <label for="form-control"></label>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="" value="">
      </div> -->
    </div>
    <input type="text" class="form-control" name="session_id" value="{{$session_id}}" id="session_id" style="display:none;">
    <hr>
    <div class="row form-group">
      <div class="col-sm-12" align='center'>
        <button type="button" class="btn btn-flat btn-success btn-sm" name="button" Onclick="CreateToCrm();">Create CRM</button>
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

  function CreateToCrm() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url = '{{url('/CreateSfToCrm')}}';

    var salutationC = $("#salutationC").val();
    var first_nameC = $("#first_nameC").val();
    var last_nameC = $("#last_nameC").val();
    var middle_nameC = $("#middle_nameC").val();
    var birthdateC = $("#birthdateC").val();
    var emailC = $("#emailC").val();
    var phone_country_prefixC = $("#phone_country_prefixC").val();
    var phone_city_prefixC = $("#phone_city_prefixC").val();
    var phoneC = $("#phoneC").val();
    var home_country_prefixC = $("#home_country_prefixC").val();
    var home_city_prefixC = $("#home_city_prefixC").val();
    var homeC = $("#homeC").val();
    var fax_country_prefixC = $("#fax_country_prefixC").val();
    var fax_city_prefixC = $("#fax_city_prefixC").val();
    var faxC = $("#faxC").val();
    var mobile_country_prefixC = $("#mobile_country_prefixC").val();
    var mobile_city_prefixC = $("#mobile_city_prefixC").val();
    var mobileC = $("#mobileC").val();
    var leadsourceC = $("#leadsourceC").val();
    var mailing_addressC = $("#mailing_addressC").val();
    var SFContactId = $("#SFContactId").val();
    var SFCreatedTimeCon = $("#SFCreatedTimeCon").val();
    var SFUserCreatedCon = $("#SFUserCreatedCon").val();
    var account_descriptionA = $("#account_descriptionA").val();
    var cityA = $("#cityA").val();
    var countryA = $("#countryA").val();
    var billing_addressA = $("#billing_addressA").val();
    var websiteA = $("#websiteA").val();
    var phone_country_prefixA = $("#phone_country_prefixA").val();
    var phone_city_prefixA = $("#phone_city_prefixA").val();
    var phoneA = $("#phoneA").val();
    var fax_country_prefixA = $("#fax_country_prefixA").val();
    var fax_city_prefixA = $("#fax_city_prefixA").val();
    var faxA = $("#faxA").val();
    var account_typeA = $("#account_typeA").val();
    var sales_officeA = $("#sales_officeA").val();
    var business_unit_teamA = $("#business_unit_teamA").val();
    var SFCreatedTimeAcc = $("#SFCreatedTimeAcc").val();
    var SFAccountId = $("#SFAccountId").val();
    var SFUserCreatedAcc = $("#SFUserCreatedAcc").val();
    var TOMarket = $("#TOMarket").val();
    var Tcontact = $("#Tcontact").val();
    var Tclient = $("#Tclient").val();
    var GCountry = $("#GCountry").val();
    var session_id = $("#session_id").val();

    if ($("#MICE_AGENT").is(':checked')) {
      var MICE_AGENT = 1;
    }else {
      var MICE_AGENT = 0;
    }
    if (account_descriptionA == '') {
      alert("Plase input Company.");
    }else {
    if (TOMarket == '') {
      alert("Plase Select To Market.");
    }else {
      if (Tcontact == '') {
        alert("Plase Select Type of contact.");
      }else {
        if (GCountry == '') {
          alert("Plase Select GROUP.");
        }else {
    var request = $.ajax({
          url: url,
          method: "POST",
          data: { salutationC: salutationC,
                  first_nameC: first_nameC,
                  last_nameC: last_nameC,
                  middle_nameC: middle_nameC,
                  birthdateC: birthdateC,
                  emailC: emailC,
                  phone_country_prefixC: phone_country_prefixC,
                  phone_city_prefixC: phone_city_prefixC,
                  phoneC: phoneC,
                  home_country_prefixC: home_country_prefixC,
                  home_city_prefixC: home_city_prefixC,
                  homeC: homeC,
                  fax_country_prefixC: fax_country_prefixC,
                  fax_city_prefixC: fax_city_prefixC,
                  faxC: faxC,
                  mobile_country_prefixC: mobile_country_prefixC,
                  mobile_city_prefixC: mobile_city_prefixC,
                  mobileC: mobileC,
                  leadsourceC: leadsourceC,
                  mailing_addressC: mailing_addressC,
                  SFContactId: SFContactId,
                  SFCreatedTimeCon: SFCreatedTimeCon,
                  SFUserCreatedCon: SFUserCreatedCon,
                  account_descriptionA: account_descriptionA,
                  cityA: cityA,
                  countryA: countryA,
                  billing_addressA: billing_addressA,
                  websiteA: websiteA,
                  phone_country_prefixA: phone_country_prefixA,
                  phone_city_prefixA: phone_city_prefixA,
                  phoneA: phoneA,
                  fax_country_prefixA: fax_country_prefixA,
                  fax_city_prefixA: fax_city_prefixA,
                  faxA: faxA,
                  account_typeA: account_typeA,
                  sales_officeA: sales_officeA,
                  business_unit_teamA: business_unit_teamA,
                  SFCreatedTimeAcc: SFCreatedTimeAcc,
                  SFAccountId: SFAccountId,
                  SFUserCreatedAcc: SFUserCreatedAcc,
                  TOMarket: TOMarket,
                  Tcontact: Tcontact,
                  Tclient: Tclient,
                  GCountry: GCountry,
                  session_id: session_id,
                  MICE_AGENT: MICE_AGENT,
                  _token: CSRF_TOKEN
              },
          dataType: "text"
    });
    request.done(function(data) {
      alert(data);
      window.location.close();
      //$("#div-result").html(data);
    //  alert("Yes "+data);
    });
    request.fail(function(data) {
      alert("Error search Salesforce");
    });

      }
    }
  }
}
  }

  </script>
@endsection
