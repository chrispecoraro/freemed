<?php
 // $Id$
 // note: all billing functions accessable from this menu, which is called
 //       by the main menu
 // lic : GPL, v2

$page_name = "billing_functions.php";
include ("lib/freemed.php");

//----- Login/authenticate
freemed_open_db ();

//----- Create user object
$this_user = CreateObject('FreeMED.User');

//----- Set page title
$page_title = _("Billing Functions");

//----- Add page to stack
page_push();

//----- Check for "current_patient" in SESSION
if ($SESSION["current_patient"] != 0) $patient = $SESSION["current_patient"];

$patient_information = "<B>"._("NO PATIENT SPECIFIED")."</B>";
if ($patient>0) {
	$this_patient = CreateObject('FreeMED.Patient', $patient);
	$patient_information = freemed_patient_box ($this_patient);
} // if there is a patient

//
// payment links removed till billing module is
// complete. use manage to make payments
//
   // here is the actual guts of the menu
if (freemed::user_flag(USER_DATABASE)) {
   $display_buffer .= "
    <p/>

    <div ALIGN=\"CENTER\">
    $patient_information
    </div>

    <p/>

    <table BORDER=0 CELLSPACING=2 CELLPADDING=2 VALIGN=\"MIDDLE\"
     ALIGN=\"CENTER\">
    ".($this_patient ? "" :
    "<tr>
     <td COLSPAN=2 ALIGN=\"CENTER\">
      <div>
      <a HREF=\"patient.php\"
      >"._("Select a Patient")."</a>
      </div>
     </td>
    </tr>" )."
    </table> 
    <p/>
    ";
	$catagory = "Billing";
	$module_template = "
		<tr><td ALIGN=\"RIGHT\">
        <b>#name#</b> : 
        </td>
        <td>
        <a HREF=\"module_loader.php?module=#class#&patient=$patient\"
         >"._("Menu")."</a>
        </td>
		</tr>";
    // modules list
    $module_list = CreateObject('PHP.module_list', PACKAGENAME);
    $display_buffer .= "<div ALIGN=\"CENTER\"><table>\n";
    $display_buffer .= $module_list->generate_list($catagory, 0, $module_template);
    $display_buffer .= "</table></div>\n";
	$catagory = "X12";
	$module_template = "
		<tr><td ALIGN=\"RIGHT\">
        <b>#name#</b> : 
        </td>
        <td>
        <a HREF=\"module_loader.php?module=#class#&patient=$patient\"
         >"._("Menu")."</a>
        </td>
		</tr>";
    // modules list
    //$module_list2 = CreateObject('PHP.module_list', PACKAGENAME);
    $display_buffer .= "<div ALIGN=\"CENTER\"><table>\n";
    $display_buffer .= $module_list->generate_list($catagory, 0, $module_template);
    $display_buffer .= "</table></div>\n";

  } else { 
    $display_buffer .= "
      <p/>
        "._("You don't have access for this menu.")."
      <p/>
    ";
  }

//----- Finish template display
template_display ();

?>
