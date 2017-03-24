(function () {

	var listeners = { };	
	
	/**
	 * Create a new TreeViewClass instance
	 * @function
	 * @memberof CSTruter.Elements
	 * @param {string} id - Element id.
	 * @param {string} strategy - What JavaScript strategy to use for this element.
	 * @return {CSTruter.Elements.ITreeViewStrategy}
	 */
	CSTruter.Elements.TreeView = function(id, strategy) { 
		if (strategy === '') {
			return new CSTruter.Elements.TreeView.Strategy.Normal(id);
		}
		var strategyClass = CSTruter.Elements.TreeView.Strategy[strategy];
		if (strategyClass === undefined) {
			throw 'TreeView strategy "' + strategy + '" not implemented';
		}
		return new strategyClass(id);
	};
	
	/**
	* @namespace CSTruter.Elements.TreeView.Strategy
	*/
	CSTruter.Elements.TreeView.Strategy = {};
	
	/**
	 * ITreeViewStrategy interface
	 * @constructor
	 * @param {string} id - Element id.
	 */	
	CSTruter.Elements.ITreeViewStrategy = function(id) {

		/**
		* Attach default tree events
		*/
		this.AttachTreeViewEvents = function() { }
		
		/**
		* Attach a callback that will be fired when the user changes the selection
		*/
		this.OnChange = function(listener) { }
	}
	
	/**
	 * TreeView Normal Strategy
	 * @constructor
	 * @param {string} id - Element id.
	 * @return {CSTruter.Elements.ITreeViewStrategy}
	 */	
	CSTruter.Elements.TreeView.Strategy.Normal = function(id) {
	
		var prefix = 'cstruter-tree';
		var tree = $('#' + id + '_tree.' + prefix);
		var formField = $('#' + id);

		this.AttachTreeViewEvents = function() {
			if (!tree.hasClass(prefix + '-disabled')) {
				tree.find('li.' + prefix + '-parent span').on('click', onClick);
			}
		}
		
		this.OnChange = function(listener) {
			listeners[id + '_change'] = listener;
		}
	
		function setValue(node) {
			var	value = $(node).data('value');
			if (listeners[id + '_change'] !== undefined) {
				listeners[id + '_change'](value);
			}
			formField.val(value);
		}

		function onClick(e) {
			var self = $(this);
			var container = self.parent();
			if (container.hasClass(prefix + '-collapsed')) {
				container.removeClass(prefix + '-collapsed');
			} else {
				container.addClass(prefix + '-collapsed');
			}
			if (container.hasClass(prefix + '-item-disabled')) {
				return;
			}
			tree.find('span.' + prefix + '-selected').removeClass(prefix + '-selected');
			self.addClass(prefix + '-selected');
			setValue(self);
		}		
		
	}
	
	/**
	 * TreeView Responsive Strategy
	 * @constructor
	 * @param {string} id - Element id.
	 * @return {CSTruter.Elements.ITreeViewStrategy}
	 */	
	CSTruter.Elements.TreeView.Strategy.Responsive = function(id) {
		
		var prefix = 'cstruter-tree-responsive';
		var tree = $('#' + id + '_tree.' + prefix);
		var formField = $('#' + id);
		var selectedParent;
		
		this.AttachTreeViewEvents = function() {
			if (tree.find('span.' + prefix + '-selected').length == 1) {
				tree.find('li span').addClass(prefix + '-obscure');
				var siblings = tree.find('span.' + prefix + '-selected').parent().find('span');
				siblings.removeClass(prefix + '-obscure');
			}
			setParent(id);
			tree.show();
			if (!tree.hasClass(prefix + '-disabled')) {
				tree.find('li.' + prefix + '-parent span').on('click', onClick);
			}
		}

		this.OnChange = function(listener) {
			listeners[id + '_change'] = listener;
		}
		
		function onClick(e) {
			var self = $(this);
			var container = self.parent();
			var parent = self.closest('ul');
			if (self.hasClass(prefix + '-parent-selected')) {
				tree.find('span.' + prefix + '-selected').removeClass(prefix + '-selected');
				parent.find('span').removeClass(prefix + '-obscure');
				parent.find('li').addClass(prefix + '-collapsed');
				self.removeClass(prefix + '-parent-selected');
				setParent(parent.prev());
				setValue(self, '');
				return;
			}
			if (container.hasClass(prefix + '-collapsed')) {
				container.removeClass(prefix + '-collapsed');
			} else {
				container.addClass(prefix + '-collapsed');
			}
			if (container.hasClass(prefix + '-item-disabled')) {
				return;
			}
			if (selectedParent != undefined) {
				selectedParent.addClass(prefix + '-obscure');
				selectedParent.removeClass(prefix + '-parent-selected');	
			}
			var siblings = parent.children('li');
			var topNode = container.closest('ul').prev();
			if (self.hasClass(prefix + '-selected')) {
				siblings.find('span').removeClass(prefix + '-obscure');
				if (topNode.length > 0) {
					topNode.removeClass(prefix + '-obscure');
					topNode.addClass(prefix + '-selected');
					setValue(topNode);
				} else {
					setValue(container, '');
				}
				self.removeClass(prefix + '-selected');
			}
			else {
				tree.find('span.' + prefix + '-selected').removeClass(prefix + '-selected');
				self.addClass(prefix + '-selected');
				siblings.find('span').addClass(prefix + '-obscure');
				container.find('span').removeClass(prefix + '-obscure');
				if (topNode.length > 0) {
					topNode.addClass(prefix + '-obscure');
				}
				setValue(self);
			}
			setParent(id);
		}
		
		function setParent(selected) {
			if (typeof selected === 'string') {
				selected = $('#' + selected + '_tree.' + prefix + ' li span.' + prefix + '-selected').closest('ul').prev();
			}
			if (selected !== undefined) {
				selected.removeClass(prefix + '-obscure');
				selected.addClass(prefix + '-parent-selected');
			}
			selectedParent = selected;
		}
	
		function setValue(node, value) {
			if (value == undefined) {
				value = $(node).data('value');
			}
			if (listeners[id + '_change'] !== undefined) {
				listeners[id + '_change'](value);
			}
			formField.val(value);
		}
	
	}
	
})();