$.fn.equalHeights = function() {
	this.each(function(){
		var sizeTo = 0;
		$(this).find('.eq').each(function(){
			$(this).height('auto')
			if ($(this).height() > sizeTo) { 
				sizeTo = $(this).height();
			}
		});
		$(this).find('.eq').height(sizeTo);
	});
	return this;
};