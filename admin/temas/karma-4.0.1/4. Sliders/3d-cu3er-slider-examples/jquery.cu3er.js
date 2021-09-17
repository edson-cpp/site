/* ------------------------------------------------------------------------
 CU3ER, jQuery plugin

 Developed By: MADEBYPLAY -> http://madebyplay.com/
 Version: 0.1b
------------------------------------------------------------------------- */
(function($) {
    var userAgent = navigator.userAgent.toLowerCase();

    $.browser = {
        version: (userAgent.match( /.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [0,'0'])[1],
        safari: /webkit/.test( userAgent ),
        opera: /opera/.test( userAgent ),
        msie: /msie/.test( userAgent ) && !/opera/.test( userAgent ),
        mozilla: /mozilla/.test( userAgent ) && !/(compatible|webkit)/.test( userAgent )
    };

})(jQuery);
var CU3ER = new Object();
(function($) {
	$.fn.cu3er = function(options) {
		return this.each(function() {
			var el = $(this);
			var obj = CU3ER[$(el).attr('id')];
			if(typeof CU3ER[$(el).attr('id')] == 'undefined') {
				CU3ER[$(el).attr('id')] = {
					isFlash: true,
					randomDiv: null,
					hasFlash: true,
					embedWidth : 10000,
					embedHeight : 10000,
					el: null,
					swf: null,
					currSlideNo: 1, // for api purpose //
					slidesOrder: new Array(), // for api purpose //
					version: "1.1b", // for api purpose //
					support3d: false,
					delay: null,
					options: null,
					responsiveSlider: true,
					/*
					* General initiative function (checks if should be used flash or javascript)
					* Parametars: options (object)
					*/
					init: function(options) {
						var options = options;
						this.options = options;
						if(typeof options.vars.responsiveSlider != 'undefined') {
							this.responsiveSlider = options.vars.responsiveSlider;
						}
						if(typeof options.vars.responsive_slider != 'undefined') {
							this.responsiveSlider = options.vars.responsive_slider;
						}
						if(typeof options.onSliderInit != 'undefined') {
							this.onSliderInit = options.onSliderInit;
						}

						var swf_version = swfobject.getFlashPlayerVersion();
						if(typeof swf_version.major != 'undefined' && swf_version.major >= 10) {
							CU3ER[$(el).attr('id')].hasFlash = true;
						} else {
							CU3ER[$(el).attr('id')].hasFlash = false;
						}

						$(el).parent().prepend($('<div />').attr({
							'id': 'CU3ER100Perc'
						}).css({
							'width': '100%'
						}));
						if(this.responsiveSlider == true) {
							$(window).resize(function() {
								CU3ER[$(el).attr('id')].responsivelyResizeSlider();
							});
						}

						this.check3DOnly(); 


						if(typeof options.vars.display_js3d_first != 'undefined' && options.vars.display_js3d_first) {
							if(CU3ER[$(el).attr('id')].support3d) {
								options.vars.force_javascript = true;
							}
						}

						if(typeof swf_version.major == 'undefined' || swf_version.major < 10 || options.vars.force_javascript === true || options.vars.force_2d === true || options.vars.force_simple === true) {
							CU3ER[$(el).attr('id')].isFlash = false;
							this.check3D();
						} else {
							CU3ER[$(el).attr('id')].displayVersion = 'Flash';
							if(CU3ER[$(el).attr('id')].responsiveSlider == true) {
								CU3ER[$(el).attr('id')].responsivelyResizeSlider();
							} else {
								CU3ER[$(el).attr('id')].initSWF(options);
							}
						}
			
					},
					initStart:function() {
						CU3ER[$(el).attr('id')].prepareJS(options);
					},
					/*
					* Initiative function that makes all necessary preparations and coordinate thru other functions
					* (generates divs for [holder, background, pre-loader ...], loads xml etc.) for flash
					* Parameters: options (object)
					*/
					initSWF: function(options) {
						setTimeout(function() {
							CU3ER[$(el).attr('id')].onSliderInit();
						}, 100);
						options.params.allowScriptAccess = "always";
						options.vars.id = $(el).attr('id');
						if(typeof swfobject.switchOffAutoHideShow != 'undefined') {
							swfobject.switchOffAutoHideShow();
						}
						var width, height;
						options.params.allowScriptAccess = "always";
						options.vars.id = $(el).attr('id');
						if (String(options.vars.width).indexOf("%") >-1) {
							if($(el).parent().width() == 0) {
								$(el).css({
									'width': options.vars.width
								});
								width = $(el).parent().width();
							} else {
								width = $(el).parent().width() * parseInt(options.vars.width) / 100;
							}
						} else {
							width = parseFloat(options.vars.width);
						}
						if(String(options.vars.height).indexOf("%") >-1) {
							if($(el).parent().height() == 0) {
								$(el).css({
									'height': options.vars.height
								});
								height = $(el).parent().height();
							} else {
								height = $(el).parent().height() * parseInt(options.vars.height) / 100;
							}
						} else {
							height = parseFloat(options.vars.height);
						}
						if(typeof options.vars.width != 'undefined') {
							var tmpWidth = new String(options.vars.width);
							options.vars.width = tmpWidth.split("%").join("p");
						}
						if(typeof options.vars.height != 'undefined') {
							var tmpHeight = new String(options.vars.height);
							options.vars.height = tmpHeight.split("%").join("p");
						}
						this.embedWidth = width;
						this.embedHeight = height;

						swfobject.embedSWF(options.vars.swf_location, $(el).attr('id'), width, height, "10.0.0", "js/expressinstall.swf", options.vars, options.params, {name:$(el).attr('id'),id:$(el).attr('id')});
						/* if(typeof options.left != 'undefined') {
							$('#' + $(el).attr('id')).css({
								'position': 'relative',
								'left': options.left + 'px'
							});
						} */
						if ($.browser.msie) {
							$("body").css('overflow-x', 'hidden');
						}
					},
					/*
					* prepares javascript, loads CU3ERPlayer and extends CU3ER object once it is loaded, and initialise CU3ER js Player
					*/

					prepareJS: function(options) {
						CU3ER[$(el).attr('id')].el = el;
						CU3ER[$(el).attr('id')].id = $(el).attr('id');
						if(typeof CU3ERPlayer == 'undefined') {
							if(typeof options.vars.js_location != 'undefined' && options.vars.js_location != '') {
								newLoc = options.vars.js_location;
							} else {
								var scripts = $('script');
								var regex = new RegExp(/jquery\.cu3er\.js/ig);
								var loc = null;
								scripts.each(function() {
									if(regex.test($(this).attr('src'))) {
										loc = $(this);
									}
								});
								var newLoc = $(loc).attr('src').replace(/jquery\.cu3er\.js/, '') + 'jquery.cu3er.player.js';
							}
							if ($.support.scriptEval) {
								var head = document.getElementsByTagName("head")[0];
								var script = document.createElement('script');
								script.id = 'uploadScript';
								script.type = 'text/javascript';
								script.onload = function() {
									CU3ER[$(el).attr('id')] = $.extend(true, {}, CU3ER[$(el).attr('id')], CU3ERPlayer);
									CU3ER[$(el).attr('id')].initJS(options);
								};
								script.src = newLoc;
								head.appendChild(script);
							} else {
								$.getScript(newLoc, function() {
									CU3ER[$(el).attr('id')] = $.extend(true, {}, CU3ER[$(el).attr('id')], CU3ERPlayer);
									CU3ER[$(el).attr('id')].initJS(options);
								});
							}
						} else {
							CU3ER[$(el).attr('id')] = $.extend(true, {}, CU3ER[$(el).attr('id')], CU3ERPlayer);
							CU3ER[$(el).attr('id')].initJS(options);
						}
					},
					doResize : function() {
						var options = this.options;
						var oldPageWidth = parseInt(options.vars.width);
						var element = $('#' + $(el).attr('id'));
						$(element).css('display', 'block');
						var newPageWidth = jQuery('#CU3ER100Perc').css('width', '0%').css('width', '100%').width();

						if(oldPageWidth <= newPageWidth) {
							var newSliderWidthPerc = 1;
						} else {
							var newSliderWidthPerc = newPageWidth / (oldPageWidth );
						}
						var newOptions = {
							'vars': {}
						};

						if (String(options.vars.width).indexOf("%") >-1) {
							if($(el).parent().width() == 0) {
								$(el).css({
									'width': options.vars.width
								});
								width = $(el).parent().width();
							} else {
								width = $(el).parent().width() * parseInt(options.vars.width) / 100;
							}
						} else {
							width = parseFloat(options.vars.width);
						}
						if(String(options.vars.height).indexOf("%") >-1) {
							if($(el).parent().height() == 0) {
								$(el).css({
									'height': options.vars.height
								});
								height = $(el).parent().height();
							} else {
								height = $(el).parent().height() * parseInt(options.vars.height) / 100;
							}
						} else {
							height = parseFloat(options.vars.height);
						}
						if(typeof options.vars.width != 'undefined') {
							var tmpWidth = new String(options.vars.width);
							options.vars.width = tmpWidth.split("%").join("p");
						}
						if(typeof options.vars.height != 'undefined') {
							var tmpHeight = new String(options.vars.height);
							options.vars.height = tmpHeight.split("%").join("p");
						}
						this.options.vars.width = width;
						this.options.vars.height = height;

						newOptions.vars.width = parseInt(width) * newSliderWidthPerc;
						newOptions.vars.height = parseInt(height) * newSliderWidthPerc;
						if (this.embedWidth == newOptions.vars.width) return;

						var object = $.extend(true, {}, options, newOptions);
						this.embedWidth = width;
						this.embedHeight = height;

						object.left = (newPageWidth - newOptions.vars.width) / 2;
						CU3ER[$(el).attr('id')].initSWF(object);
					},
					responsivelyResizeSlider: function() {
						clearTimeout(this.delay);
						this.delay = setTimeout(function(options) {
							CU3ER[$(el).attr('id')].doResize();
						}, 150);
					},
					/*
					 * Functions for api
					 * onTransition
					 * onSlide
					 * onLoadComplete
					 */
					onTransition: function(slideNo) {

					},

					onSlide: function(slideNo) {

					},

					onLoadComplete: function(slidesOrder) {

					},

					onSliderInit: function() {

					},

					registerFlash: function() {
						if(this.isFlash) {
							if (this.swf == null) {
								this.swf = swfobject.getObjectById($(el).attr('id'));
							}
						}
					},

					play: function() {
						if(this.isFlash) {
							this.registerFlash();
							this.swf.playCU3ER();
						} else {
							this.pause();

						}
					},

					pause: function () {
						this.registerFlash();
						this.swf.pauseCU3ER();
					},

					next: function() {
						this.registerFlash();
						this.swf.next();
					},

					prev: function() {
						this.registerFlash();
						this.swf.prev();
					},

					skipTo: function(no) {
						this.registerFlash();
						this.swf.skipTo(no-1);
					},

					onSlideChangeStart: function(slideNo) {
						if(this.isFlash) {
							this.currSlide = slideNo;
							this.onTransition(slideNo);
						}
					},

					onSlideChange: function(slideNo) {
						if(this.isFlash) {
							this.currSlide = slideNo;
							this.onSlide(slideNo);
						}
					},
					onLoadCompleteFlash: function(slidesOrder) {
						this.slidesOrder = String(slidesOrder).split("|");
						this.onLoadComplete(this.slidesOrder);
					},
					check3DOnly: function() {
						var elm = document.createElement('div'),
						docElement = document.documentElement,
						docHead = document.head || document.getElementsByTagName('head')[0], ret = false;
						if(typeof elm.style.WebkitPerspective != 'undefined' || typeof elm.style.MozPerspective != 'undefined') {
							var st = document.createElement('style'),
							div = document.createElement('div');
							var rnd = new Date().getTime() + Math.floor(Math.random() * 1000);
							div.id = 'cu3er3d_'+rnd;
							userAgent = navigator.userAgent;
							if(typeof elm.style.MozPerspective != 'undefined' || ('WebKitCSSMatrix' in window && 'm11' in new WebKitCSSMatrix()) || ((navigator.platform == "iPhone" || navigator.platform == "iPod" || navigator.platform == "iPad") && (navigator.userAgent.indexOf("OS 5")>-1 && navigator.userAgent.indexOf("OS 6")>-1))) {
								CU3ER[$(el).attr('id')].support3d = true;
								
							}
							
						} 
					},
					check3D: function() {
						this.check3DOnly();
						this.initStart();
					}
				}
				CU3ER[$(el).attr('id')].init(options);
			}
		});
	};
})(jQuery);
