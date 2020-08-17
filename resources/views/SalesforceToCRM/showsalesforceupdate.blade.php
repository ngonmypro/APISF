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
<input type="hidden" name="employeeid" id="employeeid" value="<?PHP echo $employeeid;?>" />
<input type="hidden" name="locationid" id="locationid" value="<?PHP echo $locationid;?>" />
<aside class="normal-side">
  <section class="content-header"><h3 align='center'><b>View Data Salesforce</b></h3></section><hr>
  <section class="content">
    @foreach($SalesforceAccountArray as $RowData)
    <div class="box box-primary">
      <div class="box-body">
        <!-- <h4>To Employee</h4> -->
        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Title</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="title_nameC" value="{{$RowData->salutationC}}" id="title_nameC" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">FirstName</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="first_nameC" value="{{$RowData->first_nameC}}" id="first_nameC" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">LastName</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="last_nameC" value="{{$RowData->last_nameC}}" id="last_nameC" disabled>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">NickName</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="middle_nameC" value="{{$RowData->middle_nameC}}" id="middle_nameC" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Birthday</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control datepicker" name="birthdateC" value="{{$RowData->birthdateC}}" id="birthdateC" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">E-mail</label>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="emailC" value="{{$RowData->emailC}}" id="emailC" disabled>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Phone</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="phone_country_prefixC" value="{{$RowData->phone_country_prefixC}}" id="phone_country_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="phone_city_prefixC" value="{{$RowData->phone_city_prefixC}}" id="phone_city_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="phoneC" value="{{$RowData->phoneC}}" id="phoneC" disabled/>
            </div>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Phone home</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="home_country_prefixC" value="{{$RowData->home_country_prefixC}}" id="home_country_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="home_city_prefixC" value="{{$RowData->home_city_prefixC}}" id="home_city_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="homeC" value="{{$RowData->homeC}}" id="homeC" disabled/>
            </div>
          </div>
          </div>

          <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Fax</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="fax_country_prefixC" value="{{$RowData->fax_country_prefixC}}" id="fax_country_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="fax_city_prefixC" value="{{$RowData->fax_city_prefixC}}" id="fax_city_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="faxC" value="{{$RowData->faxC}}" id="faxC" disabled/>
            </div>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Mobile</label>
          </div>
          <div class="col-sm-4  ">
            <div style="display:inline-flex;">
              <input type="text" class="form-control cPhone" style="width:20%;" name="mobile_country_prefixC" value="{{$RowData->mobile_country_prefixC}}" id="mobile_country_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control aPhone" style="width:30%;" name="mobile_city_prefixC" value="{{$RowData->mobile_city_prefixC}}" id="mobile_city_prefixC" disabled/>&nbsp;&nbsp;
              <input type="text" class="form-control phone" style="width:50%;" name="mobileC" value="{{$RowData->mobileC}}" id="mobileC" disabled/>
            </div>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control">Position</label>
          </div>
          <div class="col-sm-2  ">
              <input type="text" class="form-control" name="PositionC" value="{{$RowData->position_nameC}}" id="PositionC" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Department</label>
          </div>
          <div class="col-sm-2  ">
              <input type="text" class="form-control" name="DepartmentC" value="{{$RowData->department_nameC}}" id="DepartmentC" disabled>
          </div>

          <div class="col-sm-1" align='right'>
            <label for="form-control">Leadsource</label>
          </div>
          <div class="col-sm-2  ">
              <input type="text" class="form-control" name="leadsourceC" value="{{$RowData->leadsourceC}}" id="leadsourceC" disabled>
          </div>

          <!-- <div class="col-sm-1" align='right'>
            <label for="form-control">Address</label>
          </div>
          <div class="col-sm-5">
            <textarea name="mailing_addressC" class="form-control" rows="2" id="mailing_addressC">{{$RowData->mailing_addressC}}</textarea>
          </div> -->
        </div>

        <div class="row form-group">
          <div class="col-sm-1" align='right'>
            <label for="form-control" style="display:none;">SFContactId</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="account_idC" value="{{$RowData->account_idC}}" id="SFContactId" style="display:none;">
          </div>
          <div class="col-sm-1" align='right'>
            <label for="form-control" style="display:none;">SFUpdateTimeCon</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="SFUpdateTimeCon" value="{{$RowData->updated_atC}}" id="SFUpdateTimeCon" style="display:none;">
          </div>
          <div class="col-sm-2" align='right'>
            <label for="form-control" style="display:none;">SFUserUpdateCon</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="SFUserUpdateCon" value="{{$RowData->updated_byC}}" id="SFUserUpdateCon" style="display:none;">
          </div>
        </div>

        @endforeach


    <input type="text" class="form-control" name="session_id" value="{{$session_id}}" id="session_id" style="display:none;">
    <hr>
    <div class="row form-group">
      <div class="col-sm-12" align='center'>
        <button type="button" class="btn btn-flat btn-warning btn-sm" name="button" Onclick="UpdateToCrm();">Update CRM</button>
      </div>
    </div>
  </div>
</div>
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
    var url = '{{url('/UpdateSfToCrm')}}';

    var salutationC = $("#salutationC").val();
    var title_nameC = $("#title_nameC").val();
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
    var SFUpdateTimeCon = $("#SFUpdateTimeCon").val();
    var SFUserUpdateCon = $("#SFUserUpdateCon").val();
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
    var locationid = $("#locationid").val();
    var employeeid = $("#employeeid").val();
    var PositionC = $("#PositionC").val();
    var DepartmentC = $("#DepartmentC").val();

    if ($("#MICE_AGENT").is(':checked')) {
      var MICE_AGENT = 1;
    }else {
      var MICE_AGENT = 0;
    }

    var request = $.ajax({
          url: url,
          method: "POST",
          data: { salutationC: salutationC,
                  title_nameC: title_nameC,
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
                  SFUpdateTimeCon: SFUpdateTimeCon,
                  SFUserUpdateCon: SFUserUpdateCon,
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
                  locationid: locationid,
                  employeeid: employeeid,
                  PositionC: PositionC,
                  DepartmentC: DepartmentC,
                  MICE_AGENT: MICE_AGENT,
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
