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
        <!-- <div class="sec_search">
          <div id="demo" class="collapse">

            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <input type="text" class="form-control" name="" value="">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <button type="button" class="btn btn-info" name="button">Search</button>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-sm-12" style="text-align:right;">
                <button type="button" onclick="searchBtn()" id="submitButton" class="btn btn-flat btn-default btn-sm">Search</button>
              </div>
            </div>
          </div>

          <button data-toggle="collapse" data-target="#demo">show search</button>

        </div> -->
        <form autocomplete="off" id="form_input">
          <input type="hidden" id="edit_vacationFomulaId" value="">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <input type="text" class="form-control" name="" value="">
              </div>
            </div>
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
                <button type="button" class="btn btn-flat btn-info btn-sm" name="button">Search</button>
              </div>
            </div>
          </div>
          <!-- <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12" style="text-align:right;">
              <button type="button" onclick="submitBtn()" id="submitButton" class="btn btn-flat btn-success btn-sm">Save</button>
              <button type="button" onclick="resetForm()" class="btn btn-flat btn-default btn-sm">Reset</button>
            </div>
          </div> -->
        </form>
        <div class="row">
          <div class="col-md-12">
            <div id="div-result">
            <table id="table_result" class="table table-bordered" >
              <thead>
                <th style="width:50px;">NO</th>
                <th>Name</th>
                <!-- <th>Day</th>
                <th>Specific Person</th>
                <th>Updated at</th>
                <th></th> -->
              </thead>
              <tbody>
                <td>1</td>
                <td><a href="{{ url('/ViewSalesforceToCRM/2') }}" target='_blank'>Pongpichan Niramitwasu</a> </td>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>
</aside>
  @include('layouts.inc-scripts')
  <script>
function viewdata() {
  alert("test");
}
  </script>
@endsection
