(function(window,undefined){

	// Prepare our Variables
	var
		History = window.History,
		$ = window.jQuery,
		document = window.document;

	// Check to see if History.js is enabled for our Browser
	if ( !History.enabled ) return false;

	// Wait for Document
	$(function(){
		// Prepare Variables
		var
			// Application Specific Variables 
			contentSelector = '#' + container_id,
			$content = $(contentSelector),
			contentNode = $content.get(0),
			$menu = $('.' + mcdc),
			activeClass = current_menu_class,
			activeSelector = '.' + current_menu_class,
			menuChildrenSelector = '> li,> ul > li',
			// Application Generic Variables 
			$body = $(document.body),
			scrollOptions = {
				duration: 800,
				easing:'swing'
			};

		// Ensure Content
		if ( $content.length === 0 ) $content = $body;

		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack){
			// Prepare
			var
				$this = $(obj),
				url = $this.attr('href')||'',
				isInternalLink;

			// Check link
			isInternalLink = url.substring(0,rootUrl.length) === rootUrl || url.indexOf(':') === -1;

			// Ignore or Keep
			return isInternalLink;
		};

		// HTML Helper
		var documentHtml = function(html){
			// Prepare
			var result = String(html).replace(/<\!DOCTYPE[^>]*>/i, '')
									 .replace(/<(html|head|body|title|script)([\s\>])/gi,'<div id="document-$1"$2')
									 .replace(/<\/(html|head|body|title|script)\>/gi,'</div>');
			// Return
			return result;
		};

		// Ajaxify Helper
		$.fn.ajaxify = function(){
			// Prepare
			var $this = $(this);

			// Ajaxify
			$this.find('a:internal:not(.no-ajaxy,[href^="#"],[href*="wp-login"],[href*="wp-admin"])').live('click', function(event){
				// Prepare
				var
					$this	= $(this),
					url		= $this.attr('href'),
					title 	= $this.attr('title') || null;

				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) return true;

				// Ajaxify this link
				History.pushState(null,title,url);
				event.preventDefault();
				return false;
			});
			// Chain
			return $this;
		};

		// Ajaxify our Internal Links
		$body.ajaxify();

		// Hook into State Changes
		$(window).bind('statechange',function(){
			// Prepare Variables
			var
			State 		= History.getState(),
			url			= State.url,
			relativeUrl = url.replace(rootUrl,'');

			// Set Loading
			$body.addClass('loading');
			
			// Start Fade Out
			// Animating to opacity to 0 still keeps the element's height intact
			// Which prevents that annoying pop bang issue when loading in new content
			$content.animate({opacity:0.7},800);

			// Ajax Request the Traditional Page
			$.ajax({
				url: url,
				success: function(data, textStatus, jqXHR){
					
					// Prepare
					var
						$data 			= $(documentHtml(data)),
						$dataBody		= $data.find('#document-body:first ' + contentSelector),
						bodyClasses 	= $data.find('#document-body:first').attr('class'),
						$menuChildren, contentHtml, $scripts;

					//Add classes to body
					jQuery('body').attr('class', bodyClasses);
					
					// Fetch the scripts
					$scripts = $dataBody.find('#document-script');
					if ( $scripts.length ) $scripts.detach();

					// Fetch the content
					contentHtml = $dataBody.html()||$data.html();

					if ( !contentHtml ) {
						document.location.href = url;
						return false;
					}

					// Update the menu
					$menuChildren = $menu.find(menuChildrenSelector);
					$menuChildren.filter(activeSelector).removeClass(activeClass);
					$menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"],a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]');
					if ( $menuChildren.length === 1 ) $menuChildren.addClass(activeClass);

					// Update the content
					$content.stop(true,true);
					$content.html(contentHtml)
							.ajaxify()
							.css('text-align', '')
							.animate({opacity: 0, visibility: "visible"}).animate({opacity: 1},800);
							
					//Adding no-ajaxy class to a tags present under ids provided
					$(ids).each(function(){
						jQuery(this).addClass('no-ajaxy');
					});
					
					// Update the title
					document.title = $data.find('#document-title:first').text();
					try {
						document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;').replace('>','&gt;').replace(' & ',' &amp; ');
					}
					catch ( Exception ) { }

					// Add the scripts
					$scripts.each(function(){
						var $script = $(this), 
							scriptText = $script.html(), 
							scriptNode = document.createElement('script');
						try {
							// doesn't work on ie...
							scriptNode.appendChild(document.createTextNode(scriptText));
							contentNode.appendChild(scriptNode);
						} catch(e) {
							// IE has funky script nodes
							scriptNode.text = scriptText;
							contentNode.appendChild(scriptNode);
						}
						if($(this).attr('src') != null) {
							scriptNode.setAttribute('src', ($(this).attr('src')));
						}
					});
					// Update meta tags
					$metas = $data.find('meta');
					jQuery('head meta').each(function(){
						jQuery(this).remove();
					});
					$metas.each(function(){
						jQuery('head').append(jQuery(this));
					});

					// Complete the change
					if ( $body.ScrollTo||false ) $body.ScrollTo(scrollOptions);
					
					$body.removeClass('loading');

					// Inform Google Analytics of the change
					if ( typeof window.pageTracker !== 'undefined' ) window.pageTracker._trackPageview(relativeUrl);

					// Inform ReInvigorate of a state change
					if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' )
						reinvigorate.ajax_track(url);// ^ we use the full url here as that is what reinvigorate supports
				},
				error: function(jqXHR, textStatus, errorThrown){
					document.location.href = url;
					return false;
				}

			}); // end ajax

		}); // end onStateChange

	}); // end onDomLoad
 
})(window); // end closure

jQuery(document).ready(function(){
	
	//Adding no-ajaxy class to a tags present under ids provided
	jQuery(ids).each(function(){
		jQuery(this).addClass('no-ajaxy');
	});
	
	//append anchor tag to DOM to make the search in site ajaxify.
	var searchButtonHtml = '<span id="ajax-search" style="display:none;"><a href=""></a></span>'
	jQuery("body").prepend(searchButtonHtml);
	
	//Make the link ajaxify.
	jQuery("#ajax-search").ajaxify();
	
	//After submitting the search form search the post without refresing the browser.
	jQuery("#searchform").live('submit',
		function(d){
			d.preventDefault();
			var host = rootUrl + "?s=";
			jQuery("#ajax-search a").attr("href", host + jQuery(this).find("#s").val());
			jQuery("#ajax-search a").trigger("click");
		}
	);
	
});
