<?php
 // $Id$
 //
 // Authors:
 // 	Jeff Buchbinder <jeff@freemedsoftware.org>
 //
 // FreeMED Electronic Medical Record and Practice Management System
 // Copyright (C) 1999-2012 FreeMED Software Foundation
 //
 // This program is free software; you can redistribute it and/or modify
 // it under the terms of the GNU General Public License as published by
 // the Free Software Foundation; either version 2 of the License, or
 // (at your option) any later version.
 //
 // This program is distributed in the hope that it will be useful,
 // but WITHOUT ANY WARRANTY; without even the implied warranty of
 // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 // GNU General Public License for more details.
 //
 // You should have received a copy of the GNU General Public License
 // along with this program; if not, write to the Free Software
 // Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

LoadObjectDependency('org.freemedsoftware.core.SupportModule');

class BillKey extends SupportModule {

	var $MODULE_NAME = "Bill Keys";
	var $MODULE_VERSION = "0.6.3";
	var $MODULE_FILE = __FILE__;
	var $MODULE_UID = "54e71fb9-8197-44a8-be8b-7233c459ac81";
	var $MODULE_HIDDEN = true;

	var $PACKAGE_MINIMUM_VERSION = '0.8.0';

	var $table_name = "billkey";
	var $variables = array (	
	    'billkeydate',
	    'billkey',
	    'bkprocs'
	);
	
	public function __construct () {
		// Call parent constructor
		parent::__construct();
	} // end constructor 

} // end module BillKey

register_module('BillKey');

?>
