/*
 * $Id$
 *
 * Authors:
 *      Jeff Buchbinder <jeff@freemedsoftware.org>
 *
 * FreeMED Electronic Medical Record and Practice Management System
 * Copyright (C) 1999-2009 FreeMED Software Foundation
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

package org.freemedsoftware.gwt.client.widget;

import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.HashMap;

import org.freemedsoftware.gwt.client.HashSetter;
import org.freemedsoftware.gwt.client.JsonUtil;

import com.google.gwt.i18n.client.DateTimeFormat;
import com.google.gwt.user.datepicker.client.DateBox;

public class CustomDatePicker extends DateBox implements HashSetter,
		DateBox.Format {

	protected String hashMapping = null;

	protected DateTimeFormat dateFormat = DateTimeFormat
			.getFormat("yyyy-MM-dd");

	public CustomDatePicker() {
		try{
			this.setFormat(this);
		}catch(Exception e){}
	}

	public CustomDatePicker(Date date)
	{
		this.setValue(date);
		this.setFormat(this);
	}
	
	
	public void setValue(String s) {
		if (s == null || s.equalsIgnoreCase("")) {
			setValue(new Date(), true);
		} else {
			Date dt = importSqlDate(s);
			setValue(dt);
		}
	}

	public void setHashMapping(String hm) {
		hashMapping = hm;
	}

	public String getHashMapping() {
		return hashMapping;
	}

	public String getStoredValue() {
		return dateFormat.format(getValue());
	}

	public void setFromHash(HashMap<String, String> data) {
		Date dt = importSqlDate(data.get(hashMapping));
		setValue(dt);
	}

	public Date importSqlDate(String date) {
		if (date == null) {
			return new Date();
		} else if (date == "") {
			return new Date();
		} else {
			Calendar calendar = new GregorianCalendar();
			calendar.set(Calendar.YEAR, Integer.parseInt(date.substring(0, 4)));
			calendar.set(Calendar.MONTH,
					Integer.parseInt(date.substring(5, 7)) - 1);
			calendar
					.set(Calendar.DATE, Integer.parseInt(date.substring(8, 10)));

			calendar.set(Calendar.HOUR, 1);
			calendar.set(Calendar.MINUTE, 0);
			calendar.set(Calendar.SECOND, 0);
			calendar.set(Calendar.MILLISECOND, 0);

			return new Date(calendar.getTime().getTime());
		}
	}

	@Override
	public String format(DateBox dateBox, Date date) {
		try {
			return dateFormat.format(date);
		} catch (Exception ex) {
			JsonUtil.debug(ex.toString());
			return new DateBox.DefaultFormat().format(dateBox, date);
		}
	}

	@Override
	public Date parse(DateBox dateBox, String text, boolean reportError) {
		// Try default parser
		DateBox.Format f = new DateBox.DefaultFormat();
		Date p = f.parse(dateBox, text, false);
		if (p == null) {
			return importSqlDate(text);
		} else {
			return p;
		}
	}

	@Override
	public void reset(DateBox dateBox, boolean abandon) {
		// Just do whatever the superclass would do
		try {
			DateBox.Format f = new DateBox.DefaultFormat();
			f.reset(dateBox, abandon);
		} catch (Exception ex) {
			JsonUtil.debug(ex.toString());
		}
	}

}
