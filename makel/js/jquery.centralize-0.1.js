function centralize(selectorPai, selectorFilhos) {

	$(selectorFilhos + ' img').load(function() {
		var totalWidth = $(selectorPai).width();
		
		var totalCount = $(selectorFilhos).length;
		var sumWidth = 0;
		$(selectorFilhos).each(function() {
			$(this).css('float', 'left');
			sumWidth += $(this).outerWidth();
		});
		
		var averageWidth = Math.floor(sumWidth / totalCount);
		
		var maxCountByLine = Math.floor(totalWidth / averageWidth);
		var count = totalCount > maxCountByLine ? maxCountByLine : totalCount;
		
		var margin = Math.floor((totalWidth - (count * averageWidth)) / (count + 1));
		
		$(selectorFilhos).css('margin-left', margin + 'px');
		
	}).each(function() {
		if(this.complete || ($.browser.msie && parseInt($.browser.version) == 6)) {
			$(this).trigger("load");
		}
	});
}

//
//jQuery.fn.extend({
//	centralize: function() {
//		children = this;
//		parent = children.parent();
//		children.find('img').load(function() {
//			var totalWidth = parent.width();
//
//			var totalCount = children.length;
//			var sumWidth = 0;
//			children.each(function() {
//				$(this).css('float', 'left');
//				sumWidth += $(this).outerWidth();
//			});
//
//			var averageWidth = Math.floor(sumWidth / totalCount);
//
//			var maxCountByLine = Math.floor(totalWidth / averageWidth);
//			var count = totalCount > maxCountByLine ? maxCountByLine : totalCount;
//
//			var margin = Math.floor((totalWidth - (count * averageWidth)) / (count + 1));
//
//			children.css('margin-left', margin + 'px');
//
//		}).each(function() {
//			if(this.complete || ($.browser.msie && parseInt($.browser.version) == 6)) {
//				$(this).trigger("load");
//			}
//		});
//	}
//});