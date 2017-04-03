(function () {
	
	var _isAttached = false;
	
	/**
	 * Attach DropDownContainer events
	 * @function
	 * @memberof CSTruter.Elements
	 * @param {string} id - Element id.
	 * @return {CSTruter.Elements.DropDown}
	 */
	CSTruter.Elements.DropDownContainer = function(id) { 
		return new CSTruter.Elements.DropDownContainerClass(id);
	};
	
	/**
	 * DropDownContainer Class
	 * @constructor
	 * @param {string} id - Element id.
	 */
	CSTruter.Elements.DropDownContainerClass = function(id) {
		
		/**
		* jQuery DOM object
		*/
		var element = $('#' + id);
		
		if (!_isAttached) {
			_isAttached = true;
			_attachEvents();
		}
		
	}	
	
	function _attachEvents() {
		
		$(function() {
			
			$('.cstruter-dropdown-container-button').click(function(e) {
				e.stopPropagation();
				$(this).toggleClass('cstruter-dropdown-container-button-active');
				$(this).next().toggle();
			});
			
			$('.cstruter-dropdown-container-content').click(function(e) { 
				e.stopPropagation(); 
			});
			
			$(window).click(function(e) {
				$('.cstruter-dropdown-container-content').hide();
				$('.cstruter-dropdown-container-button').removeClass('cstruter-dropdown-container-button-active');
			});
			
		});
		
	}
	
})();