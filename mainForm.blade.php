@extends('layouts.master')
@section('content')
<form id="edit-employee-form" target="_blank" action="{{url('crm/employee/edit_employee')}}" method="POST">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" name="emp_id" id="emp_id" />
</form> 
<form id="edit-location-form" target="_blank" action="{{url('crm/location/edit_location')}}" method="POST">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" name="location_id" id="location_id" />
</form>
<aside class="right-side">   
  <section class="content-header search-page">
    <div class="fix-inline">
      <h1>Search page</h1>
      <div class="search-btn-right">
        @if($my_is_data->UserTypeID > 1 && $my_is_data->UserTypeID <= 4 )
        <a href="{{url('crm/location/show_location')}}" target="_blank" ><button type="button" class="btn btn-flat btn-info btn-sm"> Add and Modify </button></a>
        <a href="#"><button type="button" onclick="exportExcel()" class="btn btn-flat btn-success btn-sm"> Export Excel </button></a>
        @endif
      </div>
    </div>
  </section>
  <section class="content mainform">
    <div class="box box-primary">
      <div class="box-body">
        <form id="for-export" action="{{ url('crm/searchExportExcel') }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group"><input type="text" name="searchText" id="searchText" class="form-control" placeholder="Search"></div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <button type="button" class="btn btn-sm btn-flat btn-primary" id="btn_click_search" onclick="btn_search()">Search</button>
                <button type="button" class="btn btn-sm btn-flat btn-default" onclick="btn_reset()">Reset</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2"><label>Group</label></div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="group_input" id="group_input">
                  <option value="">------- ALL -------</option>
                  @foreach($company_group as $company)
                    <option value=" {{ $company->CompanyID }} "> {{ $company->Company }} </option>  
                  @endforeach  
                </select>
              </div>
            </div>
            <div class="col-md-2"><label>Limit to</label></div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" id="limit_input" name="limit_input">
                  <option value="-1">ALL</option> 
                    @foreach($limits as $limit)
                    <option value="{{ $limit }}"> {{ $limit }} </option>  
                    @endforeach 
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2"><label>Type of contact</label></div>
            <div class="col-md-2">
              <div class="form-group">
                <select class="form-control" name="TContact_input" id="TContact_input">
                  <option value="-1">ALL</option> 
                    @foreach($location_types as $location_type)
                    <option value="{{$location_type->LocationTypeID}}">{{$location_type->LocationType}}</option>  
                    @endforeach   
                </select>
              </div>
            </div>

            <!-- Country -->
            <div class="col-md-2 col-md-offset-2">
              <label>Country</label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select class="form-control" name="country_input" id="country_input">
                  <option value="-1">ALL</option> 
                    @foreach($countrys as $country)
                      <option value=" {{ $country->CountryID }} "> {{ $country->Country }} </option>  
                    @endforeach   
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-2"><label>Type of client</label></div>
            <div class="col-md-2">
              <div class="form-group">
                <select class="form-control" name="TClient_input" id="TClient_input">
                  <option value="" selected>All</option>
                  <option value="TO" >TO</option>
                  <option value="TA" >TA</option>  
                  <option value="ONLINE">ONLINE</option>
                </select>
              </div>
            </div>
            <div class="col-md-1" style="margin-right: -20px">
              <input type="checkbox" name="MICE_AGENT" id="MICE_AGENT" value="1">
            </div>
            <div class="col-md-2">MICE Agent</div>
          </div>
          <div class="row">
            <div class="col-md-2"><label>IS Office</label></div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="isOffice_input" id="isOffice_input">
                  <option value="-1">ALL-</option> 
                  @foreach($is_offices as $is_office)
                    <option value="{{$is_office->OfficeID}}">{{$is_office->OfficeCode}}</option>  
                  @endforeach   
                </select>
              </div>
            </div>

            <!-- IS Dept -->
            <div class="col-md-2">
              <label>IS Dept</label>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="isDept_input" id="isDept_input">
                  <option value="-1">ALL</option> 
                  @foreach($depts as $dept)
                    <option value=" {{ $dept->DEPT_ID }} "> {{ $dept->DEPT_DESC }} </option>  
                  @endforeach    
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-2"><label>Inactive</label></div>
            <div class="col-md-4">
              <div class="form-group">
                <input id="rblinactive1" type="radio" name="rblinactive" value="1"  checked/>Exclude
                <input id="rblinactive2" type="radio" name="rblinactive" value="2" />Include
                <input id="rblinactive3" type="radio" name="rblinactive" value="3" />Only
              </div>
            </div>

            <!-- Inbound -->
            <div class="col-md-2">
              <label>Inbound</label>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="inbound_input" id="inbound_input">
                  <option value="-11" selected>All inbound staffs</option>
                  <option value="-1">Asia-Pacific Team</option>
                  <option value="-2">Americas Team</option>
                  <option value="-3">Europe Team (German-speaking)</option>
                  <option value="-4">Europe Team</option>
                  <option value="-5">Visa Team</option>
                  <option value="-6">Oceana Team</option> 

                  @foreach($IS_datas as $IS_data)
                    <option value="{{ $IS_data->ISID }}"> {{ $IS_data->FirstName }} {{ $IS_data->LastName }} </option>                     
                  @endforeach
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-2"><label>Sales</label></div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="ddlissalesrep" id="ddlissalesrep">
                  <option value="-1">All sale staffs</option> 
                  <option value="0">Blank</option> 
                  @foreach($IS_datas as $IS_data)
                    <option value="{{$IS_data->ISID}}">{{$IS_data->FirstName}} {{$IS_data->LastName}}</option>                     
                  @endforeach  
                </select>
              </div>
            </div>

            <!-- Marget -->
            <div class="col-md-2">
              <label>Market</label>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="marget_input" id="marget_input">
                  <option value="-1">All TO Markets</option>
                  <option value="0">Non-TO Market</option>
                  @foreach($markets as $market)
                    <option value="{{ $market->TOMarketId }}"> {{ $market->TOMarketData }} </option>                     
                  @endforeach 
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-2"><label>City</label></div>
            <div class="col-md-4">
              <div class="form-group"><input type="text" class="form-control" placeholder="City..." name="city" id="city_input"></div>
            </div>
            <div class="col-md-2"><label>Zip code</label></div>
            <div class="col-md-4">
              <div class="form-group"><input type="text" class="form-control" placeholder="Zipcode ..." name="txtZip" id="txtZip"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2"><label>State</label></div>
            <div class="col-md-4">
              <div class="form-group"><input type="text" class="form-control" placeholder="State ..." name="txtState" id="txtState"></div>
            </div>
            <div class="col-md-2"><label>Email domain</label></div>
            <div class="col-md-4">
              <div class="form-group"><input type="text" class="form-control" placeholder="Email domain ..." name="txtEmaildomain" id="txtEmaildomain"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2"><label>Entry Date</label></div>
            <div class="col-md-4">
              <div class="form-group"><input type="text" class="form-control datepicker" name="txtCreateDate" id="txtCreateDate"></div>
            </div>
            <div class="col-md-2"><label>Last Action Date</label></div>
            <div class="col-md-4">
              <div class="form-group"><input type="text" class="form-control datepicker" name="txtLastUpdate" id="txtLastUpdate"></div>
            </div>
          </div>
          <hr>
          <div class="row" id="choosePage" style="display:none;">
            <div class="col-md-1">
              <div class="form-group">
                <select id="pagechoose" onChange="choose_page()" class="form-control">
                  <option value="1">1</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <form id="sendMail_form" action="{{ route('sendMailPage') }}" method="POST" target="_blank">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
        <div class="col-md-12"><p id="s_total"></p></div>
        <table id="table_search" class="table table-bordered" style="display:none;">
          <thead>
            <tr>
              <th>NO</th>
              <th>Company</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</aside>
<div class="modal_waiting"></div>
@section('data-table')
  <script type="text/javascript">
    $body = $("body");
    $(document)
      .ajaxStart(function() {
        $body.addClass("loading");   
      })
      .ajaxStop(function() {
        $body.removeClass("loading");
    });
    $(document).ready(function(){
      $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
      });
    });
  </script>
  <script type="text/javascript">
    var input = document.getElementById("searchText");
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    input.addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
        document.getElementById("btn_click_search").click();
      }
    });
    function btn_search(){
      var MICE_AGENT = 0;
      if(document.getElementById('MICE_AGENT').checked) {
        var MICE_AGENT = 1;
      } 
      var pagechoose_get = document.getElementById("pagechoose").value;
      if(pagechoose_get > 1){
        pagechoose = pagechoose_get
      }else{
        pagechoose = 1;
      }
      var request = $.post('{{ url('crm/searchMainform') }}',
                          {_token: CSRF_TOKEN, 
                            companyId : document.getElementById("group_input").value , 
                            lbxgroup: document.getElementById("TContact_input").value,
                            lbxlimit: document.getElementById("limit_input").value,
                            ddlisoffice: document.getElementById("isOffice_input").value,
                            lbxcountry : document.getElementById("country_input").value,
                            TClient_input : document.getElementById("TClient_input").value,
                            lbxdept : document.getElementById("isDept_input").value,
                            rblinactive : $('input[name=rblinactive]:checked').val(),
                            ddlisreservationrep : document.getElementById("inbound_input").value,
                            ddlissalesrep : document.getElementById("ddlissalesrep").value,
                            ddltomarket : document.getElementById("marget_input").value,
                            city : document.getElementById("city_input").value,
                            txtZip : document.getElementById("txtZip").value,
                            txtState : document.getElementById("txtState").value,
                            txtEmaildomain : document.getElementById("txtEmaildomain").value,
                            txtCreateDate : document.getElementById("txtCreateDate").value,
                            txtLastUpdate : document.getElementById("txtLastUpdate").value,
                            pagechoose : pagechoose,
                            searchText : document.getElementById("searchText").value,
                            MICE_AGENT : MICE_AGENT,
              });
      request.done( function(response){
        $("#pagechoose").empty();
        $("#table_search tbody tr").remove(); 
        $("#choosePage").css('display','block');
        $("#table_search").css('display','table');
        var item_Array = $.parseJSON(response);
        if(item_Array["data"].length > 0){
          itemArray = item_Array["data"]
          var allPages = itemArray[0]['allPages'];
          var page_current = itemArray[0]['page_current'];
          var total = itemArray[0]['total'];
          document.getElementById("s_total").innerHTML = "Total " + total + " records" + "<a style='cursor:pointer' onclick='sendMail()'> E-mail </a>";
          var mContact = "";
          var no = 1;
          for(index = 0; index < itemArray.length; index++){
            var itemData = itemArray[index];
            var IsMainContact = itemData['IsMainContact'];
            if(IsMainContact == 1){
              mContact= "*";
            }else{
              mContact= "";
            }
            $("#table_search > tbody").append("<tr><td>" +  itemData['RunNo'] + "</td>\
                                        <td><a class='link_click' target='_blank' onclick='editLocation(this)' data-location-id='"+ 
                                              itemData['LocationID'] +"'>" + mContact +itemData['Company'] + "</a></td>\
                                        <td><a class='link_click' target='_blank' onclick='editEmployee(this)' data-emp-id='"+ itemData['empId'] +"' > " 
                                        + itemData['FullName'] +"</a>" + itemData['Pos'] 
                                        + "</td></tr>");
            no++;
          }
          select = document.getElementById('pagechoose');
          for (var i = 1; i<=allPages; i++){
              var opt = document.createElement('option');
              opt.value = i;
              opt.innerHTML = i;
              opt.classList.add('form-control');
              select.appendChild(opt);
          }
          document.getElementById("pagechoose").selectedIndex = page_current-1;
        }else{
          document.getElementById("s_total").innerHTML = "Total 0 records";
          $('#table_search > tbody').append('<tr><td colspan="3"><center>' + 'No Data to Display' + '</center></td></tr>');
        }
        if(item_Array["forMail"].length > 0){
          forMail_array = item_Array["forMail"]
          for(index = 0; index < forMail_array.length; index++){
            var itemData = forMail_array[index];
            console.log(itemData["EmployeeID"])
            $("#sendMail_form").append("<input type='hidden' name='EmployeeID[]' value='"+itemData["EmployeeID"]+"'>");
          }
        }
      });
      request.error(function(response){
        alert("Something wrong. Click OK to refresh page.");
        location.reload();
      });
    }
    function sendMail(){
      $('#sendMail_form').submit();
    }
    function choose_page(){
      var pagechoose = document.getElementById("pagechoose").value;
      btn_search()
    }
    function editEmployee(item){
      var emp_id = $(item).data('emp-id');
      document.getElementById("emp_id").value = emp_id;
      $('#edit-employee-form').submit();

    }
    function editLocation(item){
      var location_id = $(item).data('location-id');
      document.getElementById("location_id").value = location_id;
      $('#edit-location-form').submit();  
    }
    function exportExcel(){
      var form = document.getElementById("for-export");
      form.submit();
    }
    function btn_reset(){
      document.getElementById("for-export").reset(); 
    }
  </script>
  @if(Session::get('message') != "" || Session::get('message') != null)
    <script>
      alert("{{ Session::pull('message') }}");
    </script>
  @endif
  @stop
@endsection