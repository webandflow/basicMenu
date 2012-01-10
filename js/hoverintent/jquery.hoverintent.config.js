/* Hover Intent Menu Script */
var basicmenu = (function(){
		return {
			speedIn: 200,
			speedOut: 150,
			open: function() {
				var menuContainer	= $(this);
				// Menu
				menuContainer.children('.dropdown_menu').fadeIn(basicmenu.speedIn);
				
				// Tab
				var tab = menuContainer.find('.mainmenulink');
				
/* 				tab.addClass('active_menuitem'); */
				tab.clone().prependTo(menuContainer).addClass('clone').addClass('active_menuitem').hide().fadeIn(basicmenu.speedIn);
				
			},
			close: function() {
				var menuContainer	= $(this);
				
				// Menu
				menuContainer.children('.dropdown_menu').fadeOut(basicmenu.speedOut);
				
				// Tab
				menuContainer.removeClass('active_menuitem',basicmenu.speedOut);
				menuContainer.find('.clone').fadeOut(basicmenu.speedOut, function(){
					$(this).remove();
				});
				
			},
			init: function() {
			
				// default behaviour
				$('.menuitem').hoverIntent({
					interval: 120,
					out: basicmenu.close,
					over: basicmenu.open,
					sensitivity: 7,
					timeout: 200
				});
			}	
		};	
}());
/* End basicmenu */

basicmenu.init();
