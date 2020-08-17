<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use DB;
use Mail;
use App\Vacation;
use App\UserAuth;
use App\Is;
class VacationController extends Controller{
  public function leaveFromArkHr($sessionId = null,$emp_id = null){
    if($sessionId){
      Session::put('session_id', $sessionId);
      $tbAuth_data = UserAuth::where('SessionId','=',$sessionId)->first();
      if($tbAuth_data){
        $Is_data = IS::find($tbAuth_data->ISID);
        Session::put('userType_id', $Is_data->UserTypeID);
        Session::put('ISID', $Is_data->ISID);
        Session::put('back_tap', "vacation");

        setcookie('my_isid', $tbAuth_data->ISID, time() + 86400, "/");
        setcookie('session_id', $sessionId, time() + 86400, "/");
        setcookie('fullname', $tbAuth_data->FullName, time() + 86400, "/");
        return redirect()->route('edit_emp', ['emp_id' => $emp_id]);
      }
    }
  }
  public function saveLeaveVacation(Request $request){

    $id_owner = isset($request->id_owner)? $request->id_owner : NULL ;
    $isid_owner = isset($request->isid_owner)? $request->isid_owner : NULL ;
    $vacation_edit = isset($request->vacation_edit)? $request->vacation_edit : NULL ;
    $day = isset($request->days)? $request->days : NULL ;
    $txtolddays = isset($request->txtolddays)? $request->txtolddays : NULL ;
    $leaveType = $request->leaveType;
    $otherLeave = $request->otherLeave;
    $Years = "";
    $txtYearOld = $request->txtYearOld;


    if ($leaveType == 7) {
      $Y = date("Y");
      $Years = $Y;
    }else {
        if(!empty($request->txtyear1)){
          $Years = $request->txtyear1;
        }
    }
$datevalidatefrom = substr($request->from_date,6,4).substr($request->from_date,3,2).substr($request->from_date,0,2);
$datevalidateto = substr($request->to_date,6,4).substr($request->to_date,3,2).substr($request->to_date,0,2);

$dateif = ($txtYearOld+1).'0531';
        // dd($datevalidatefrom,$datevalidateto,$dateif);
    if ($leaveType == 1 && $Years == $txtYearOld && ($datevalidatefrom > $dateif || $datevalidateto > $dateif)) {
      echo '<script language="javascript">';
      echo 'alert("Annual leave last year valid until 31 May.")';
      echo '</script>';
      echo "<script>history.back();</script>";
      exit();
    }
    // dd($leaveType, $Years);
    //dd($isid_owner);
    //$otherLeave_type = $request->otherLeave_type;
    $is_model = Is::find($isid_owner);



    $vacation2 = new Vacation();
    $vacationCount = $vacation2->selectCountDay($isid_owner, $Years, $leaveType, $otherLeave);
    foreach ($vacationCount as $row) {
      $rowDay = $row->rowVacation;
    }
    //dd($rowDay);
    if ($leaveType == 7) { //เช็ค vacation type
      // Loop เช็ควันลาเกินกำหนด
      if ($otherLeave == '1AE4B0EF-28FC-4357-83CE-E0FA4A0F67E1' && $rowDay >= 1) {
        echo '<script language="javascript">';
        echo 'alert("You use exercised the maximum of Birthday Leave.")';
        echo '</script>';
        echo "<script>history.back();</script>";
        exit();
      }elseif ($otherLeave == '2F01D74A-8C70-4BF5-8B21-EE25B6A6E7D9' && $rowDay >= 3) {
        echo '<script language="javascript">';
        echo 'alert("You use exercised the maximum of Business Leave.")';
        echo '</script>';
        echo "<script>history.back();</script>";
        exit();
       }
    }
    //dd($vacationCount);
    //if(isset($request->vacation_btn_update)){
    //}
    if($request->vacation_select == "add"){

      if($vacation_edit != null || $vacation_edit != ""){
        $vacation = Vacation::find($vacation_edit);
      }
      else{
        $vacation = new Vacation();
      }

      $new_year = $is_model->CurrentYears;
      if($is_model->RemainDays > 0){
        $new_year = $is_model->CurrentYears - 1;
      }
      $vacation->VacationTypeID =  isset($request->leaveType)? $request->leaveType : NULL ;
      $vacation->VacationOtherLeaveCaseId = isset($request->otherLeave)? $request->otherLeave : NULL ;
      $vacation->ISID =  isset($request->isid_owner)? $request->isid_owner : NULL;
      $vacation->UserBy =  isset($request->edit_by)? $request->edit_by : NULL ;
      $vacation->DateFrom = isset($request->from_date)? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->from_date))) : NULL ;
      $vacation->DateTo = isset($request->to_date)? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->to_date))) : NULL ;
      $vacation->CompensationID = "0";
      $vacation->Days_of_Vacation = isset($request->days)? $request->days : NULL ;
      $vacation->Remark = isset($request->remarks)? $request->remarks : NULL ;
      if($vacation->VacationTypeID == 2 || $vacation->VacationTypeID == 4){
        $vacation->Years = null;
      }else{
        $vacation->Years = $new_year;
      }
      $vacation->Active = 1;
      $vacation_type = $vacation->VacationTypeID;
      $compensation_id = $vacation->CompensationID;

      $day = $vacation->Days_of_Vacation;
      if($vacation_type != 6){
        if($vacation_type == 1){
          if($is_model->RemainDays <= 0){
            $is_model->Vacation = $is_model->Vacation - $day;
          }
          else{
            if($day > $is_model->RemainDays){
              $rem = $day-$is_model->RemainDays;
              $is_model->RemainDays = 0;
              $is_model->Vacation = $is_model->Vacation - $rem;
            }else{
              $rem = 0;
              $is_model->RemainDays = $is_model->RemainDays - $day;
            }
          }
        }
        if($compensation_id = 1){
          DB::table('Compensation')->where('CompensationID', $compensation_id)->update(['Inactive' => 1]);
        }
      }
      else{
        if($is_model->Vacation_Bussiness >= 0){
          $is_model->Vacation_Bussiness = $is_model->Vacation_Bussiness - $day;
        }
      }
      $vacation->save();
      $is_model->save();
      Session::put('message' , 'save complete.');


    }else{
      //dd($vacation_edit);

      if($vacation_edit != null || $vacation_edit != ""){
        $vacation = Vacation::find($vacation_edit);
      }
      else{
        $vacation = new Vacation();
        $vacation->Active = 0;
      }
      $new_year = $is_model->CurrentYears;
      if($is_model->RemainDays > 0){
        $new_year = $is_model->CurrentYears - 1;
      }
      $vacation->VacationTypeID =  isset($request->leaveType)? $request->leaveType : NULL ;
      $vacation->VacationOtherLeaveCaseId = isset($request->otherLeave)? $request->otherLeave : NULL ;
      $vacation->ISID =  isset($request->isid_owner)? $request->isid_owner : NULL;
      $vacation->UserBy =  isset($request->edit_by)? $request->edit_by : NULL ;
      $vacation->DateFrom = isset($request->from_date)? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->from_date))) : NULL ;
      $vacation->DateTo = isset($request->to_date)? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->to_date))) : NULL ;
      $vacation->CompensationID = "0";
      $vacation->Days_of_Vacation = isset($request->days)? $request->days : NULL ;
      $vacation->Remark = isset($request->remarks)? $request->remarks : "" ;
      if($vacation->VacationTypeID == 2 || $vacation->VacationTypeID == 4){
        $vacation->Years = null;
      }else{
        $vacation->Years = $new_year;
      }
// dd($otherLeave,$request->leaveType, $request->txtyear1);
      if ($request->leaveType == 7) {
        if(!empty($request->txtyear1)){
          $vacation->Years = $request->txtyear1;
          //$vacation->VacationOtherLeaveCaseId = $request->otherLeave_type;
        }
      }else {
        if(!empty($request->txtyear1)){
          $vacation->Years = $request->txtyear1;
        }
      }



      $manager_data = Is::find($is_model->Manager);
      if(!$manager_data){
        Session::put('message' , 'please assign manager.');
        Session::put('back_tap' , 'vacation');
        return redirect()->route('edit_emp', ['emp_id' => $id_owner]);
      }
      // dd($vacation);
      $vacation->save();
      $is_model->save();
      $vacationID = $vacation->VacationID;
      $vacationType = $vacation->vacationType->VacationType;
      $employee_mail = $is_model->employee->Email;
      $employee_name = $is_model->employee->FirstName ." ". $is_model->employee->LastName;
      $days = $vacation->Days_of_Vacation;
      $ref = $vacation->Years;
      $remarks = $vacation->Remark;
      $dateFrom = date('d-M-Y' , strtotime($vacation->DateFrom));
      $dateTo = date('d-M-Y' , strtotime($vacation->DateTo));
      $manager =  $manager_data->employee;
      $link_approve = url('crm/vacation/approve/'.$vacationID);
      $link_reject = url('crm/vacation/reject/'.$vacationID);
      $manager_mail = $manager->Email;
      if($vacation_edit != null || $vacation_edit != ""){
      Session::put('message' , 'Update complete.');
      }else{
        Mail::send('emails.send', ['vacationType' => $vacationType,'employee_mail' => $employee_mail,'days' => $days,'remarks' => $remarks,'dateFrom' => $dateFrom,
              'dateTo' => $dateTo,'manager_mail' => $manager_mail,'link_approve' => $link_approve,'link_reject' => $link_reject, 'ref' => $ref ],
              function ($message) use ($employee_mail , $employee_name , $manager_mail){
                  $message->from($employee_mail, $employee_name);
                  $message->to($manager_mail);
                  $message->cc('kittiporn@icstravelgroup.com');
                  $message->subject("Leave Application for ". $employee_name);
        });
        Mail::send('emails.sendEmployee', ['vacationType' => $vacationType,'employee_mail' => $employee_mail,'days' => $days,'remarks' => $remarks,'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,'manager_mail' => $manager_mail, 'ref' => $ref], function ($message) use ($employee_mail , $employee_name , $manager_mail){
                  $message->from($employee_mail, $employee_name);
                  $message->to($employee_mail);
                  $message->subject("Leave Application for ". $employee_name);
        });
        // Mail::send('emails.send', ['vacationType' => $vacationType,'employee_mail' => $employee_mail,'days' => $days,'remarks' => $remarks,'dateFrom' => $dateFrom,
        //       'dateTo' => $dateTo,'manager_mail' => 'piti@icstravelgroup.com','link_approve' => $link_approve,'link_reject' => $link_reject ],
        //       function ($message) use ($employee_mail , $employee_name , $manager_mail){
        //           $message->from($employee_mail, $employee_name);
        //           $message->to($manager_mail);
        //           $message->subject("Leave Application for ". $employee_name);
        // });

        Session::put('message' , 'send email request to manager complete.');
      }
    }
    Session::put('back_tap' , 'vacation');
    return redirect()->route('edit_emp', ['emp_id' => $id_owner]);
  }

  public function viewVacation(){
    $result_array = [];
    $vac_id = !empty($_POST['vac_id']) ? $_POST['vac_id'] : null;
    $vacation_data = Vacation::find($vac_id);
    //dd($vacation_data);
    $result_array = ['VacationID' => $vacation_data->VacationID,'ISID' => $vacation_data->ISID,'CompensationID' => $vacation_data->CompensationID,
      'VacationTypeID' => $vacation_data->VacationTypeID,'DateFrom' => date('d/m/Y',strtotime($vacation_data->DateFrom)),'DateTo' => date('d/m/Y',strtotime($vacation_data->DateTo)),
      'Days_of_Vacation' => $vacation_data->Days_of_Vacation,'Remark' => $vacation_data->Remark, 'Years' => $vacation_data->Years, 'VacationOtherLeaveCaseId' => $vacation_data->VacationOtherLeaveCaseId,
      'Active' => $vacation_data->Active,'IsDel' => $vacation_data->IsDel, 'IsCancel' => $vacation_data->IsCancel ];
    return json_encode( $result_array);
  }
  public function deleteVacation(){
    $message = "delete success";
    $vac_id = !empty($_POST['vac_id']) ? $_POST['vac_id'] : null;
    $isid = !empty($_POST['isid']) ? $_POST['isid'] : null;
    $YearOld = !empty($_POST['YearOld']) ? $_POST['YearOld'] : null;
    $YearNew = !empty($_POST['YearNew']) ? $_POST['YearNew'] : null;
    //dd($vac_id);
    $is_model = Is::find($isid);
    $vacation_data = Vacation::find($vac_id);
    //dd($vacation_data);
    $RemainDays = $is_model->RemainDays;
    $dayOfVacation =  $vacation_data->Days_of_Vacation;
    $type_of_vacation = $vacation_data->VacationTypeID;
    $Active = $vacation_data->Active;
    $ref = $vacation_data->Years;
// dd($dayOfVacation, $RemainDays, $Active, $vacation_data, $type_of_vacation);
    if ($Active == 1) {
      if($vacation_data != null){
        if($type_of_vacation == 1){
          if ($ref == $YearOld) {
            // dd($dayOfVacation, $RemainDays, $Active, $vacation_data, $type_of_vacation);
            $is_model->RemainDays = $is_model->RemainDays + $dayOfVacation;
            $is_model->save();
          }elseif($ref == $YearNew) {
            // dd($dayOfVacation, $RemainDays, $Active, $vacation_data, $type_of_vacation);
            $is_model->Vacation = $is_model->Vacation + $dayOfVacation;
            $is_model->save();
          }

        }
      $vacation_data = Vacation::find($vac_id)->delete();
      }
    }else {
      $vacation_data = Vacation::find($vac_id)->delete();
    }

    return json_encode( $message);
  }
  public function cancelVacation(){
    $message = "cancel success";
    $vac_id = !empty($_POST['vac_id']) ? $_POST['vac_id'] : null;
    $isid = !empty($_POST['isid']) ? $_POST['isid'] : null;
    // data Employee
    $is_model = Is::find($isid);
    $employee_mail = $is_model->employee->Email;
    $employee_name = $is_model->employee->FirstName ." ". $is_model->employee->LastName;

    // data manager
    $manager_data = Is::find($is_model->Manager);
    $manager =  $manager_data->employee;
    $manager_mail = $manager->Email;

    // data vacation
    $vacation_data = Vacation::find($vac_id);
    $vacationID = $vacation_data->VacationID;
    $vacationType = $vacation_data->vacationType->VacationType;
    $days = $vacation_data->Days_of_Vacation;
    $remarks = $vacation_data->Remark;
    $dateFrom = date('d-M-Y' , strtotime($vacation_data->DateFrom));
    $dateTo = date('d-M-Y' , strtotime($vacation_data->DateTo));
    $dayOfVacation =  $vacation_data->Days_of_Vacation;
    $type_of_vacation = $vacation_data->VacationTypeID;

    if($vacation_data != null){
      $vacation_data->IsCancel = 1;
      $vacation_data->save();

      Mail::send('emails.cancel', ['vacationType' => $vacationType,'employee_mail' => $employee_mail,'days' => $days,'remarks' => $remarks,'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,'manager_mail' => $manager_mail ],
            function ($message) use ($employee_mail , $employee_name , $manager_mail){
                $message->from($employee_mail, $employee_name);
                $message->to($manager_mail);
                $message->subject("Leave Application for " . $employee_name . " (canceled)");
      });
    }
    return json_encode( $message);
  }
  public function approveVacation(Request $request){
    $vacation_data = Vacation::find($request->vacationID);
    if($vacation_data){
      $isid_owner = $vacation_data->is_model;
      $is_model = Is::find($isid_owner->ISID);
      $vacation_type = $vacation_data->VacationTypeID;
      $compensation_id = $vacation_data->CompensationID;
      $day = $vacation_data->Days_of_Vacation;
      $vacation_active = $vacation_data->Active;
      $vacation_IsCancel = $vacation_data->IsCancel;
      if($vacation_active == 1){
        echo '<script language="javascript">';
        echo 'alert("This request already approve!")';
        echo '</script>';
        echo "<script>window.close();</script>";
        exit();
      }
      if ($vacation_IsCancel == 1) {
        echo '<script language="javascript">';
        echo 'alert("Already user canceled leave.")';
        echo '</script>';
        echo "<script>window.close();</script>";
        exit();
      }
      if($vacation_type != 6){
        if($vacation_type == 5 || $vacation_type == 2 || $vacation_type == 4){
          $vacation_data->Active = 1;
        }
        else if($vacation_type == 1){
          if($is_model->RemainDays <= 0){
            $is_model->Vacation = $is_model->Vacation - $day;
          }
          else{
            if($day > $is_model->RemainDays){
              $rem = $day-$is_model->RemainDays;
              $is_model->RemainDays = 0;
              $is_model->Vacation = $is_model->Vacation - $rem;
            }else{
              $rem = 0;
              $is_model->RemainDays = $is_model->RemainDays - $day;
            }
          }
        }
        if($compensation_id = 1){
          DB::table('Compensation')->where('CompensationID', $compensation_id)->update(['Inactive' => 1]);
        }
      }
      else{
        if($is_model->Vacation_Bussiness >= 0){
          $is_model->Vacation_Bussiness = $is_model->Vacation_Bussiness - $day;
        }
      }
      $vacation_data->Active = 1;
      $mail_hr = "hr.thailand@icstravelgroup.com";
      $mailLeaveBy = $vacation_data->is_model->employee->Email;
      $manager =  Is::find($is_model->Manager)->employee;
      $manager_mail = $manager->Email;
      $vacationType = $vacation_data->vacationType->VacationType;
      $dateFrom = date('d M Y' , strtotime($vacation_data->DateFrom));
      $dateTo = date('d M Y' , strtotime($vacation_data->DateTo));
      $dayOfVacation = $vacation_data->Days_of_Vacation;
      $remark = $vacation_data->Remark;
      $country_id = $vacation_data->is_model->employee->location->CountryID; # 225 = Vietnam
      if($country_id == 225){
        Mail::send('emails.approveVac', ['vacationType' => $vacationType,'dateFrom' => $dateFrom,'dateTo' => $dateTo,'remark' => $remark,'dayOfVacation' => $dayOfVacation,
                  'remark' => $remark,'isApprove' => 1 ], function ($message) use ($mailLeaveBy , $mail_hr , $manager_mail){
                    $message->from($manager_mail, "");
                    $message->to($mailLeaveBy);
                    $message->cc(['hr.thailand@icstravelgroup.com','anh@icstravelgroup.com','diem@icstravelgroup.com']);
                    $message->subject("Result Leave Application");
        });
      }else{
        Mail::send('emails.approveVac', ['vacationType' => $vacationType,'dateFrom' => $dateFrom,'dateTo' => $dateTo,'remark' => $remark,'dayOfVacation' => $dayOfVacation,
                'remark' => $remark,'isApprove' => 1 ], function ($message) use ($mailLeaveBy , $mail_hr , $manager_mail){
                  $message->from($manager_mail, "");
                  $message->to($mailLeaveBy);
                  $message->cc($mail_hr);
                  $message->subject("Result Leave Application");
        });
      }
      $vacation_data->save();
      $is_model->save();
      echo '<script language="javascript">';
      echo 'alert("Aprrove Successful!")';
      echo '</script>';
      echo "<script>window.close();</script>";
    }
    else{
      echo '<script language="javascript">';
      echo 'alert("Request has been delete!")';
      echo '</script>';
      echo "<script>window.close();</script>";
    }
  }
  public function rejectVacation(Request $request){
    $vacation_data = Vacation::find($request->vacationID);
    if($vacation_data){
      $is_model = Is::find($vacation_data->ISID);
      $mail_hr = "hr.thailand@icstravelgroup.com";
      $mailLeaveBy = $vacation_data->is_model->employee->Email;
      $manager =  Is::find($is_model->Manager)->employee;
      $manager_mail = $manager->Email;
      $vacationType = $vacation_data->vacationType->VacationType;
      $dateFrom = date('d M Y' , strtotime($vacation_data->DateFrom));
      $dateTo = date('d M Y' , strtotime($vacation_data->DateTo));
      $dayOfVacation = $vacation_data->Days_of_Vacation;
      $remark = $vacation_data->Remark;
      $country_id = $vacation_data->is_model->employee->location->CountryID; # 225 = Vietnam
      if($country_id == 225){
        Mail::send('emails.approveVac', ['vacationType' => $vacationType,'dateFrom' => $dateFrom,'dateTo' => $dateTo,'remark' => $remark,'dayOfVacation' => $dayOfVacation,
                  'remark' => $remark,'isApprove' => 0 ], function ($message) use ($mailLeaveBy , $mail_hr , $manager_mail){
                      $message->from($mailLeaveBy, "");
                      $message->to($mailLeaveBy);
                      $message->cc(['hr.thailand@icstravelgroup.com','anh@icstravelgroup.com','diem@icstravelgroup.com']);
                      $message->subject("Result Leave Application");
        });
      }else{
        Mail::send('emails.approveVac', ['vacationType' => $vacationType,'dateFrom' => $dateFrom,'dateTo' => $dateTo,'remark' => $remark,'dayOfVacation' => $dayOfVacation,
                    'remark' => $remark,'isApprove' => 0 ], function ($message) use ($mailLeaveBy , $mail_hr , $manager_mail){
                        $message->from($mailLeaveBy, "");
                        $message->to($mailLeaveBy);
                        $message->cc($mail_hr);
                        $message->subject("Result Leave Application");
        });
      }
      $vacation_data->IsDel = 1;
      $vacation_data->save();
      echo '<script language="javascript">';
      echo 'alert("Rejected Successful!")';
      echo '</script>';
      echo "<script>window.close();</script>";
    }
    else{
      echo '<script language="javascript">';
      echo 'alert("Request has been delete!")';
      echo '</script>';
      echo "<script>window.close();</script>";
    }
  }

  public function checkCountBirthdayLeaveRemain(Request $request){

      $id_owner = isset($request->id_owner)? $request->id_owner : NULL ;
      $isid_owner = isset($request->isid_owner)? $request->isid_owner : NULL ;
      $otherLeave = isset($request->otherLeave)? $request->otherLeave : NULL ;
      $leaveType  = isset($request->leaveType)? $request->leaveType : NULL ;

      $to_date   = isset($request->to_date)? $request->to_date : NULL ;
      $thisyear = date("Y");
      $caseBirthdayID = '1AE4B0EF-28FC-4357-83CE-E0FA4A0F67E1'; //Birthday Leave 1AE4B0EF-28FC-4357-83CE-E0FA4A0F67E1
      $nodays   = isset($request->days)? $request->days : 1 ;
      $vacationUse = 0 ;

      $today = date("Y/m/d");
      $session_id = Session::get('session_id');
      $IS = new Is();
      $user_data = $IS->checkDataBySession($session_id, $today);
      $isid_edit = $user_data[0]->ISID;
      if(!empty($isid_edit)){
          if($leaveType == 7 AND ($otherLeave == $caseBirthdayID)){
              if($nodays==1){
                  $data  = DB::select("
                        SELECT COUNT(VacationID) AS countVacationID
                            FROM Vacation
                         WHERE   ISID = '$isid_owner'
                                 AND Active = 1
                                 AND VacationOtherLeaveCaseId ='$caseBirthdayID'
                                 AND YEAR(DateTo) = $thisyear
                     ");
                  $rs = $data[0];
                  $vacationUse  = ($rs->countVacationID)?$rs->countVacationID:0;
              }else{
                  $vacationUse = 11; //Days over limit
              }
          }else{
              $vacationUse = 0 ;
          }
      }else{
          $vacationUse = 99; //access_denied
      }
      return $vacationUse;
      exit();
  }

  public function checkRefDate($isid_owner){
    $is_model = Is::find($isid_owner);
    $year = date('Y');
    if($is_model->RemainDays <= 0){
      return  $year-1;
    }
    else{
      return  $year - 1;
    }
  }
}
