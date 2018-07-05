$(document).ready(function() {

	var $toggleButton = $('.toggle-button'),
    	$menuWrap = $('.menu-wrap'),    	
		$fullLinkSoft = $('#software-menu-main'),
		$fullLinkDoc = $('#doc-menu-main'),		
		$soft = $('#sub-software-main'),
		$doc = $('#sub-doc-main'),
		$mobileLinkSoft = $('#software-menu'),
		$mobileLinkDoc = $('#doc-menu'),
		$mobileSoft = $('#sub-software'),
		$mobileDoc = $('#sub-doc');
		

	// Hamburger button

	$toggleButton.on('click', function() {
		$(this).toggleClass('button-open');
		$menuWrap.toggleClass('menu-show');
	});

	// Dropdown navigation
	$fullLinkSoft.click(function() {
		console.log("fullsoft");
		openMenu($soft);		
	});
	
	$fullLinkDoc.click(function() {
		console.log("fulldoc");
		openMenu($doc);		
	});
		
	$fullLinkSoft.next().click(function() {
		console.log("asoft");
		openMenu($soft);		
	});
	
	$fullLinkDoc.next().click(function() {
		console.log("adoc");
		openMenu($doc);		
	});
	
	// Mobile dropdown navigation
	
	$mobileLinkSoft.click(function() {
		console.log("fullsoft");
		openSubMenu($mobileSoft);		
	});
	
	$mobileLinkDoc.click(function() {
		console.log("fulldoc");
		openSubMenu($mobileDoc);		
	});
		
	$mobileLinkSoft.next().click(function() {
		console.log("asoft");
		openSubMenu($mobileSoft);		
	});
	
	$mobileLinkDoc.next().click(function() {
		console.log("adoc");
		openSubMenu($mobileDoc);		
	});
	
});

function openMenu(node) {		
	if (!node.is(":visible")) {		
		$('.sub-menu-main').slideUp(300, function() { node.slideDown(300); });		
	}	
	else {
		$('.sub-menu-main').slideUp(300);
	}	
}

function openSubMenu(node) {		
	if (!node.is(":visible")) {		
		$('.sub-menu').slideUp(300, function() { node.slideDown(300); });		
	}	
	else {
		$('.sub-menu').slideUp(300);
	}	
}