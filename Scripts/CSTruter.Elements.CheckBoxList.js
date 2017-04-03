(function () {

	/**
	 * Create a new CheckBoxListClass instance
	 * @function
	 * @memberof CSTruter.Elements
	 * @param {string} id - Element id.
	 * @return {CSTruter.Elements.CheckBoxListClass}
	 */
	CSTruter.Elements.CheckBoxList = function(id) { 
		return new CSTruter.Elements.CheckBoxListClass(id);
	};
	
	/**
	 * DropDownList Class
	 * @constructor
	 * @param {string} id - Element id.
	 */
	CSTruter.Elements.CheckBoxListClass = function(id) {
		
		/**
		* jQuery DOM object
		*/
		var element = $('#' + id);
		var emptyText = element.find('.cstruter-dropdown-container-button').text();
		setText();
		
		this.AttachDropDownContainerEvents = function() {
			element.find('input').click(function() { 
				setText(); 
			});
		};
		
		function getText() {
			return $.map(element.find('label'), function(label) {
				if ($(label).find('input:checked').length > 0) {
					return $(label).text();
				}
			});
		}
		
		function setText() {
			var value = getText();
			if (value.length === 0) {
				value = emptyText;
			}
			element.find('.cstruter-dropdown-container-button').text(value);
		}
		
	}
	
})();