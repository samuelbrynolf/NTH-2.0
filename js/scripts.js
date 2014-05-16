//ADD JQUERY CONC-FILE

// TOC
//==============================================================================================================

// 1. TAPPY 									(plugin)
// 2. GLOBAL VARS 						(function)
// 3. CUSTOM TRAVERSIONS			(function)
// 4. NAVIGATION 							(functions)
// 5. EDITABLE ASIDE					(function)
// 6. SIDEBAR LOGIC						(function)
// 7. FUNCTIONS CALLS

//==============================================================================================================

// 1 -----------------------------------------------------------------------------------------------------------

(function(b,d,e){var c=function(f){return f.each(function(){var o=d(this),n,k,m,g=15,h;function j(p){p.preventDefault();d(p.target).trigger("tap",[p])}function i(){m=b.document.body.scrollTop;if(o.is("a")){h=o[0].href;o[0].href="#"}}function l(p){p.preventDefault();if(n&&n!==p.type){return false}n=p.type;clearTimeout(k);k=setTimeout(function(){n=null},1000);if(p.type==="touchend"&&Math.abs(b.document.body.scrollTop-m)>g){return false}if(h){o[0].href=h}h=null;j(p)}o.bind("touchstart",i).bind("touchend",l).bind("click",l)})};var a=d.fn.bind;d.fn.bind=function(f,g){if(/(^| )tap( |$)/.test(f)){c(this)}return a.apply(this,[f,g])}}(this,jQuery));

(function() {
	$('html').removeClass('no-js');

// 2 -----------------------------------------------------------------------------------------------------------
  if(window.getComputedStyle){
  	var size = window.getComputedStyle(document.body,':after').getPropertyValue('content');
  }
  
  // alternativ: https://gist.github.com/emilbjorklund/2481019
  // http://brettjankord.com/projects/media-query-sync/js/mqsync.js
  
// 3 -----------------------------------------------------------------------------------------------------------

	function moveNavigation(){
		var nav = $('#m-global-nav');
		if(nav.length > 0){
			nav.insertAfter('#global-header').addClass('s-is-moved s-is-hidden');
		}
	}


// 4 -----------------------------------------------------------------------------------------------------------

 	function toggledNav(){
 		var navButton = $('#menu-button');
 		
 		navButton.removeClass('jumper');
	 	navButton.bind('tap', function(d){ 
	 		
	 		// overlay
			var overlayDiv = $("<div />", {
				"id": "overlay",
				"class": "s-is-active"
			});
			
			var overlay = $('#overlay');
			if(overlay.length){
				overlay.toggleClass('s-is-active');
			} else {
				overlayDiv.insertBefore('#global-header');
			}
			
			// show/hide-logic
	 		var $this = $(this);
	 		//$this.parent().parent().toggleClass('s-is-active');
	 		$this.toggleClass('s-is-flipped');
	 		$('#m-global-nav').toggleClass('s-is-hidden');
		
	 		d.preventDefault();
	 	});
 	} // end toggledNav()
  
  function navigation(){
	 
	 	function toggleSubNav(){
	 		$('<p class="back"><span class="visuallyhidden">St&auml;ng</span></p>').appendTo('#menu-button');
			
		 	$('#menu-global-nav .parent > a').bind('tap', function(e){ 
		 		var $this = $(this);
		 		
		 		$this.parent('.parent').toggleClass('s-is-active').toggleClass('s-is-passive');
		 		$this.next('.sub-menu').toggle();
		 		e.preventDefault();
		 	});
	 	} // end toggleSubNav()
	 	
	 	function currentMenuItem(){
	 		var subParent = $('.parent');
	 		
			if($('#set-current-menuItem').length || subParent.is('.current-menu-ancestor')){
		 	
		 		$('#menu-global-nav a').each(function(){
					var categoryName = $('.m-article-meta a').first().text();
					var menuItem = $(this);
			 		
					if(categoryName == menuItem.text()){
		      	menuItem.parent().addClass('current-menu-item');
		    	}
		 		});
		 		
		 		subParent.children('.sub-menu').show();
		 		subParent.removeClass('s-is-passive').addClass('s-is-active');
		 	}
	 	} // end currentMenuItem()
	 	
	 	function smoothScroll(){
	  	$('.jumper').bind('tap', function(e){
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
	    	&& location.hostname == this.hostname) {
	      	var jQuerytarget = $(this.hash);
	        jQuerytarget = jQuerytarget.length && jQuerytarget || jQuery('[name=' + this.hash.slice(1) +']');
	        if (jQuerytarget.length) {
	        	var targetOffset = jQuerytarget.offset().top - 24 ;
	          $('html,body').animate({scrollTop: targetOffset}, 400);
	          e.preventDefault();
	         } 
	       }
		 	});	
	 	} // end smoothScroll()
	 	
	 	function tappyItems(){
	 		$('#searchsubmit').bind('tap', function(f){
	 			$('#searchform').submit();
	 		});
	 		
	 		$('a.tappilyTap, a.nextpostslink, a.prevoiuspostslink').bind('tap', function(){
	 			window.location=$(this).attr('href');
	 		});
	 	} // end tappyItems()
	 	
	 	toggleSubNav();
	 	currentMenuItem();
	 	smoothScroll();
	 	tappyItems();
  
  } // end navigation()
    
// 5 -----------------------------------------------------------------------------------------------------------
  
  function editableAside(){
  	
  	$('<li class="menu-item menu-item-toggle-aside"><a class="toggle-editable-aside" href="#">Bokm&auml;rken</a></li>').insertBefore('#menu-global-nav .is-last');
  	
  	function toggleEditableAside(){
  		$('.toggle-editable-aside').on('click', function(toggle) {
  			$('#editableAside').toggleClass('s-is-hidden');
  			toggle.preventDefault();
  		});
  	}
  	
  	function eraseStorage(trigger, storedItem,list,listItem){
  		$(trigger).on('click', function(){
  			if (localStorage.getItem(storedItem)){
	  			localStorage.removeItem(storedItem);
					$(list).children().remove();
					$(listItem).appendTo($(list));
				}
			});
		}
  	
  	function userBookmarks(){
  		var myBookmarks = document.getElementById('editable-bookmarks');
  		var myBookmarksID = $(myBookmarks).attr('id');
  		var bookmark = document.getElementById('addBookmark');
  		var currentBookmark = $(bookmark).attr('class');
  		var editableAside = $('#editableAside');
  		
  		if (localStorage.getItem('storedBookmarks')){
				myBookmarks.innerHTML = localStorage.getItem('storedBookmarks');
				$('#'+myBookmarksID+' a').each(function(){
  				if($(this).hasClass(currentBookmark)){
  					$(bookmark).addClass('s-is-passive');
  				}
  			});
			}
			
  		$(bookmark).on('click', function(a){
  		
  			if ($(window).scrollTop() > 60) {
					$('html, body').animate({ scrollTop: 0 }, 250);
				}
				
  			if(!$(bookmark).is('.s-is-passive')){
  				$('#placeholderBookmarks').remove();
  				$(bookmark).clone().appendTo($(myBookmarks)).wrap('<li></li>');
  				$(bookmark).addClass('s-is-passive');
					localStorage.setItem('storedBookmarks', myBookmarks.innerHTML);
					editableAside.removeClass('s-is-hidden');
				} else {
					editableAside.toggleClass('s-is-hidden');
				}
			
				$('#'+myBookmarksID+' .'+currentBookmark).fadeOut().fadeIn();
				a.preventDefault();
			});
			
			$('#erase-editable-bookmarks').on('click', function(){
				$(bookmark).removeClass('s-is-passive');
			});
			
			eraseStorage('#erase-editable-bookmarks', 'storedBookmarks', myBookmarks, '<li id="placeholderBookmarks">Du har inga sparade bokm&auml;rken.</li>');
  	} // end userBookmarks
				
  	function userNotes(){
			var myNotes = document.getElementById('editable-notes');
			
			if (localStorage.getItem('storedNotes')){
			 myNotes.innerHTML = localStorage.getItem('storedNotes'); 
			}
			
			$(myNotes).blur(function() {
			 localStorage.setItem('storedNotes', this.innerHTML);
			});
		
			eraseStorage('#erase-editable-notes', 'storedNotes', myNotes, '<li>B&ouml;rja anteckna.</li>');
  	} // end userNotes()
  	
  	toggleEditableAside();
  	userBookmarks();
  	userNotes();

  }; // end editable aside()
  
// 6 -----------------------------------------------------------------------------------------------------------

	function footerDisplayLogic(){
		
		var viewport = $(window);
		var footer = $('#global-footer');
		var footerWrapper = $('#footerWrapper');
		var documentHeight = $(document).innerHeight();
		var browserHeight = viewport.innerHeight();
		var footerHeight = footerWrapper.innerHeight();
		var hasVScroll = document.body.scrollHeight > document.body.clientHeight;
		
		var showFooter = function(){
			footerWrapper.show();
			if(viewport.scrollTop() + 144 > documentHeight - viewport.height()){
				footerWrapper.removeClass('s-is-hidden');
				viewport.off('scroll', showFooter);
			}
		};
		
		if(footerHeight > browserHeight || hasVScroll){
			footerWrapper.show();
			footer.addClass('s-overflow-auto');
		} else {
			footerWrapper.addClass('s-is-hidden s-is-fixed');
			viewport.on('scroll', showFooter);
		}
	}
  
// 7 -----------------------------------------------------------------------------------------------------------
	
	if(window.getComputedStyle){
		if (size.indexOf("alphascreen") !=-1 || size.indexOf("betascreen") !=-1 || size.indexOf("charliescreen") !=-1){
			moveNavigation();
	 		toggledNav();
	 	}

		if (size.indexOf("charliescreen") !=-1) {
	  	footerDisplayLogic();
	  }
	  
	  // when echo exists...if ((size.indexOf("deltascreen") !=-1 && window.localStorage) || (size.indexOf("echoscreen") !=-1 && window.localStorage)){
	  if (size.indexOf("deltascreen") !=-1 && window.localStorage){
	  	editableAside();
	  }
	}
  
  navigation();
  
  //$(window).on('mqchange:aq', alphaFunction);
	//$(window).on('mqchange:bq', betaFunctions);
	//$(window).on('mqchange:cq', charlieFunctions);
	//$(window).on('mqchange:dq', deltaFunctions);
	//$(window).on('mqchange:eq', echoFunctions);
	
})();