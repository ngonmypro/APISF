@extends('layouts.master')
@section('pageTitle', 'Salesforce To CRM')
@section('content')
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{csrf_token()}}" />
</head>

<aside class="right-side">
  <section class="content-header"><h1>Salesforce To CRM</h1></section>
  <section class="content">
    <div class="box box-primary">
      <div class="box-body">
        <form autocomplete="off" id="form_input">
          <input type="hidden" id="edit_vacationFomulaId" value="">
          <div class="row">

            <!-- <div class="col-sm-2" align='right'>
              <input type="radio" name="Type" id="Merge" value="M"> <label for="form-control">Merge</label>
              <input type="radio" name="Type" id="Update" value="U"> <label for="form-control">Update</label>
            </div> -->
            <div class="col-sm-1" align='right'>
              <label for="form-control">Name </label>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" class="form-control" name="namesf" value="" id="namesf">
              </div>
            </div>

            <input type="text" class="form-control" name="session_id" value="<?php echo $session_id; ?>" id="session_id" style="display:none;">
            <!-- <div class="col-sm-3">
              <div class="form-group">
                <select class="form-control" name="">
                  <option value=""> # Select # </option>
                  <option value="1"> Location </option>
                  <option value="2"> Employee </option>
                </select>
              </div>
            </div> -->
            <div class="col-sm-3">
              <div class="form-group">
                <button type="button" class="btn btn-flat btn-info btn-sm" name="button" OnClick="javascript:SearchSFLocation(); SearchSF();">Search</button>
              </div>
            </div>
          </div>
          <!-- <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12" style="text-align:right;">
              <button type="button" onclick="submitBtn()" id="submitButton" class="btn btn-flat btn-success btn-sm">Save</button>
              <button type="button" onclick="resetForm()" class="btn btn-flat btn-default btn-sm">Reset</button>
            </div>
          </div> -->
        </form><hr>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              <label for="from-control"><h4>Location</h4></label>
              <div id="div-result_salesforce_Location" ></div>
            </div>

            <div class="col-md-6">
              <label for="from-control"><h4>Employee</h4></label>
              <div id="div-result_salesforce" ></div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </section>
</aside>
  @include('layouts.inc-scripts')
<script type="text/javascript">
  function SearchSF() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url = '{{url('/SearchSalesforce')}}';
    // var Type = $("#Type").val();


      // if(document.getElementById('Merge').checked) {
      //   var Type = $("#Merge").val();
      //   alert(Type);
      // }else if(document.getElementById('Update').checked) {
      //   var Type = $('#Update').val();
      //   alert(Type);
      // }else {
      //   alert("Select Merge or Update please.");
      //   exit();
      // }

    var namesf = $("#namesf").val();
    var session_id = $("#session_id").val();
    var request = $.ajax({
          url: url,
          method: "POST",
          data: { namesf: namesf,
            session_id: session_id,
            _token: CSRF_TOKEN
          },
          dataType: "text"
    });
    request.done(function(data) {
// alert(data2)
      $("#div-result_salesforce").html(data);
    //  alert("Yes "+data);
    });
    request.fail(function(data) {
      alert("Error search Salesforce");
    });
  }

  function SearchSFLocation() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url = '{{url('/SearchSalesforce2')}}';

    // if(document.getElementById('Merge').checked) {
    //   var Type = $("#Merge").val();
    //   alert(Type);
    // }else if(document.getElementById('Update').checked) {
    //   var Type = $('#Update').val();
    //   alert(Type);
    // }else {
    //   alert("Select Merge or Update please.");
    //   exit();
    // }

    var namesf = $("#namesf").val();
    var session_id = $("#session_id").val();
    var request = $.ajax({
          url: url,
          method: "POST",
          data: { namesf: namesf,
            session_id: session_id,
            _token: CSRF_TOKEN
          },
          dataType: "text"
    });
    request.done(function(data) {
// alert(data2)
      $("#div-result_salesforce_Location").html(data);
    //  alert("Yes "+data);
    });
    request.fail(function(data) {
      alert("Error search Salesforce");
    });
}
  function SearchICSCrm() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url = '{{url('/SearchICSCrm')}}';

    var namesf = $("#namesf").val();
    var session_id = $("#session_id").val();

    var request = $.ajax({
          url: url,
          method: "POST",
          data: { namesf: namesf,
            session_id: session_id,
            _token: CSRF_TOKEN
          },
          dataType: "text"
    });
    request.done(function(data) {
      $("#div-result_crm").html(data);
    //  alert("Yes "+data);
    });
    request.fail(function(data) {
      alert("Error search Salesforce");
    });
  }

</script>
@endsection
