/**
 * @Name         Theme Joomla Chimera Template Framework
 * @URL          http://www.themejoomla.com
 * @package      Joomla (1.5.x)
 * @subpackage   Chimera Template Framework
 * @copyright    Copyright (C) 2008-2020 Theme Joomla. All rights reserved. E & OE
 */

jQuery(document).ready(function() {
	//When page loads...

	var third = jQuery("fieldset:first").replaceWith(jQuery("fieldset:last"));
	jQuery(".col").replaceWith( jQuery("table.paramlist") );
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
});