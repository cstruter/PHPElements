(function () {

	/**
	 * Create a new DropDownListClass instance
	 * @function
	 * @memberof CSTruter.Elements
	 * @param {string} id - Element id.
	 * @return {CSTruter.Elements.DropDownListClass}
	 */
	CSTruter.Elements.DropDownList = function(id) { 
		return new CSTruter.Elements.DropDownListClass(id);
	};
	
	/**
	 * Drop-Down List Class
	 * @constructor
	 * @param {string} id - Element id.
	 */
	CSTruter.Elements.DropDownListClass = function(id) {
		
		/**
		* jQuery DOM object
		*/
		var element = $('#' + id);
		
		/**
		* When the user changes a selection, the form will be submitted to the server
		*/
		this.AttachAutoPostBack = function() {
			if (element[0].form === null) {
				throw 'Element ' + id + ' parent form not found, element likely not contained within a form';
			}
			element.on('change', function(e) {
				var form = e.target.form;
				if (form === null) {
					throw 'Element ' + id + ' parent form not found, context of element likely changed';
				}
				form.submit();
			});
		}

		/**
		* Remove all options from the drop-down list
		*/
		this.Clear = function() {
			element.length = 0;
		}
		
		/**
		* Attach an event to be triggered when the user changes the selection
		* @param {function} listener callback to be fired
		*/
		this.OnChange = function(listener) {
			element.on('change', listener);
		}
	}
	
})();