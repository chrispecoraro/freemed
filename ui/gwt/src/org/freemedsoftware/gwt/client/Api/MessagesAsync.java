/*
 * $Id$
 *
 * Authors:
 *      Jeff Buchbinder <jeff@freemedsoftware.org>
 *
 * FreeMED Electronic Medical Record and Practice Management System
 * Copyright (C) 1999-2008 FreeMED Software Foundation
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 */

package org.freemedsoftware.gwt.client.Api;

import com.google.gwt.user.client.rpc.AsyncCallback;
import java.util.HashMap;

public interface MessagesAsync {
	public void Get ( Integer message, AsyncCallback callback );
	public void RecipientsToText ( String id, AsyncCallback callback );
	public void Remove ( Integer messageId, AsyncCallback callback );
	public void ListOfUsers ( AsyncCallback callback );
	public void Send ( HashMap message, AsyncCallback callback );
	public void TagModify ( Integer message, String tag, AsyncCallback callback );
	public void ViewPerPatient ( Integer patientId, Boolean unreadOnly, AsyncCallback callback );
	public void ViewPerUser ( Boolean unreadOnly, AsyncCallback callback );
}
