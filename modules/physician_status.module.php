<?php
 // $Id$
 // note: physician status db functions
 // lic : GPL

if (!defined("__PHYSICIAN_STATUS_MODULE_PHP__")) {

define(__PHYSICIAN_STATUS_MODULE_PHP__, true);

include ("lib/freemed.php");
include ("lib/API.php");

class physicianStatusMaintenance extends freemedMaintenanceModule {

	var $MODULE_NAME    = "Physician Status";
	var $MODULE_VERSION = "0.1";

	var $record_name    = "Physician Status";
	var $table_name     = "phystatus";

	function add () {
		reset ($GLOBALS);
		while (list($k,$v)=each($GLOBALS)) global $$k;
		echo "
			<P><CENTER>
			<$STDFONT_B>"._("Adding")." ... \n";

		$query = "INSERT INTO $this->table_name VALUES ( ".
			"'".addslashes($phystatus)."',   NULL ) ";

		$result = fdb_query($query);

		if ($result) { echo "<B>"._("done").".</B>"; }
		 else        { echo "<B>"._("ERROR")."</B>"; }
	} // end function physicianStatusMaintenance->add()

	function form () {
		reset ($GLOBALS);
		while (list($k,$v)=each($GLOBALS)) global $$k;

  $r = freemed_get_link_rec ($id, $this->table_name);
  extract ($r);

  echo "
    <P>
    <FORM ACTION=\"$this->page_name\" METHOD=POST>
    <INPUT TYPE=HIDDEN NAME=\"action\" VALUE=\"mod\"> 
    <INPUT TYPE=HIDDEN NAME=\"module\" VALUE=\"".prepare($GLOBAL["module"])."\"> 
    <INPUT TYPE=HIDDEN NAME=\"id\"   VALUE=\"".prepare($id)."\"  >

    ".form_table ( array (
      _("Status") =>
     "<INPUT TYPE=TEXT NAME=\"phystatus\" SIZE=20 MAXLENGTH=20
       VALUE=\"".prepare($phystatus)."\">"
    ) )."

    <P>
    <CENTER>
    <INPUT TYPE=SUBMIT VALUE=\" "._("Modify")." \">
    <INPUT TYPE=RESET  VALUE=\""._("Clear")."\">
    </CENTER></FORM>
  ";


  echo "
    <P>
    <CENTER>
    <A HREF=\"$this->page_name?$_auth&module=$module\"
     >"._("Abandon Modification")."</A>
    </CENTER>
  ";
	} // end function physicianStatusMaintenance->form()

	function mod () {
		reset ($GLOBALS);
		while (list($k,$v)=each($GLOBALS)) global $$k;
		echo "<P><CENTER><$STDFONT_B>"._("Modifying")." ...  ";

		$query = "UPDATE $this->table_name ".
			"SET phystatus = '".addslashes($phystatus)."' ". 
			"WHERE id='".addslashes($id)."'";

		$result = fdb_query($query);

		if ($result) { echo "<B>"._("done").".</B>"; }
		 else        { echo "<B>"._("ERROR")."</B>"; }

	} // end function physicianStatusMaintenance->mod()

	function delete () {
		reset ($GLOBALS);
		while (list($k,$v)=each($GLOBALS)) global $$k;
		$result = fdb_query("DELETE FROM $this->table_name WHERE id='".addslashes($id)."'");

		echo "
    <P><CENTER>
    <I>"._($record_name)." <B>$id</B> "._("Deleted")."<I>.
    </CENTER>
    <P>
    <CENTER>
    <A HREF=\"$this->page_name?$_auth&module=$module&action=view\"
     >"._("back")."</A></CENTER>
		";
	} // end function physicianStatusMaintenance->delete()

	function view () {
		reset ($GLOBALS);
		while (list($k,$v)=each($GLOBALS)) global $$k;
  		echo freemed_display_itemlist (
			fdb_query("SELECT phystatus,id FROM $this->table_name ".
				"ORDER BY phystatus"),
			$this->page_name,
			array (
				_("Status") => "phystatus" 
 			),
			array (
				""
			)
		);
    
		echo "
    <TABLE WIDTH=100% CELLSPACING=0 CELLPADDING=3>
    <TR BGCOLOR=\"".
      ($_alternate = freemed_bar_alternate_color ($_alternate))
    ."\" VALIGN=CENTER>
    <TD VALIGN=CENTER><FORM ACTION=\"$this->page_name\">
		<INPUT TYPE=HIDDEN NAME=\"action\" VALUE=\"add\">
		<INPUT TYPE=HIDDEN NAME=\"module\" VALUE=\"".prepare($GLOBALS["module"])."\">
    	<INPUT NAME=\"phystatus\" LENGTH=20 MAXLENGTH=30></TD>
    <TD VALIGN=CENTER><INPUT TYPE=SUBMIT VALUE=\""._("Add")."\"></FORM></TD>
    </TR></TABLE>

    <P>
		";
	} // end function physicianStatusMaintenance->view()

} // end class physicianStatusMaintenance

register_module ("physicianStatusMaintenance");

} // end if defined

?>
