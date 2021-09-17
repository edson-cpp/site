/*
 * Scroll Watch by Buzu.
 */
;(function($) {
	var w = $(window),
		subscribers = [],
		timeout;

	function checkElement(set) {
		var elem,
			elem_position,
			elem_width,
			elem_height,
			win_width,
			win_height,
			win_scroll_x,
			win_scroll_y,
			elem_x,
			elem_y,
			elem_x2,
			elem_y2,
			hidden_top,
			hidden_right,
			hidden_bottom,
			hidden_left,
			top_percent,
			right_percent,
			bottom_percent,
			left_percent,
			obj;

			elem = set[0];
			elem_position = elem.offset();
			elem_width = parseInt(elem.css('width'));
			elem_height = parseInt(elem.css('height'));
			win_width = $(window).prop('innerWidth');
			win_height = $(window).prop('innerHeight');
			win_scroll_x = $(window).prop('scrollX');
			//http://help.dottoro.com/ljfswxte.php
			if (isNaN(win_scroll_x)) win_scroll_x = $('html').prop('scrollLeft');
			win_scroll_y = $(window).prop('scrollY');
			//http://help.dottoro.com/ljfswxte.php
			if (isNaN(win_scroll_y)) win_scroll_y = $('html').prop('scrollTop');
			win_bottom = win_scroll_y + win_height;
			win_right = win_scroll_x + win_width;
			elem_x = elem_position.left;
			elem_y = elem_position.top;
			elem_x2 = elem_x + elem_width;
			elem_y2 = elem_y + elem_height;
			hidden_top = elem_y - win_scroll_y;
			hidden_right = -elem_x2 + win_right;
			hidden_bottom = -elem_y2 + win_bottom;
			hidden_left = elem_x - win_scroll_x;
			top_percent = (hidden_top * 100)/elem_height;
			right_percent = (hidden_right * 100)/elem_width;
			bottom_percent = (hidden_bottom * 100)/elem_height;
			left_percent = (hidden_left * 100)/elem_width;

			obj = {
				'elem' : elem,
				'elem_position' : elem_position,
				'elem_width' : elem_width,
				'elem_height' : elem_height,
				'win_width' : win_width,
				'win_height' : win_height,
				'win_scroll_x' : win_scroll_x,
				'win_scroll_y' : win_scroll_y,
				'win_bottom' : win_bottom,
				'win_right' : win_right,
				'elem_x' : elem_x,
				'elem_y' : elem_y,
				'elem_x2' : elem_x2,
				'elem_y2' : elem_y2,
				'hidden_top' : hidden_top,
				'hidden_right' : hidden_right,
				'hidden_bottom' : hidden_bottom,
				'hidden_left' : hidden_left,
				'top_percent' : top_percent,
				'right_percent' : right_percent,
				'bottom_percent' : bottom_percent,
				'left_percent' : left_percent
			}

			set[1](obj);


			/*console.log(top_percent);
			console.log(right_percent);
			console.log(bottom_percent);
			console.log(left_percent);
			console.log("==================");*/
	}

	function fireWatch() {
		var i = 0,
			currentSet;
		for (i; currentSet = subscribers[i]; i++) {
			checkElement(currentSet);
		}
	}

	w.scroll(function() {
		if (timeout) {
			clearTimeout(timeout)
		}

		timeout = setTimeout(function() {
			fireWatch();
		}, 20); // don't executy on every scroll, only when scroll has ended.
	});

	$.fn.scrollWatch = function(callback) {
		return this.each(function() {
			// callback is a function that gets passed a report of the current state of the element.
			subscribers.push([$(this), callback]);
		});
	}
})(jQuery);
