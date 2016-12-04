

function selectText(container) {
  //  container.selectionStart = 0; container.selectionEnd = container.innerText.length;
  if (document.createTextRange) {
      var range = document.body.createTextRange();
      range.moveToElementText(container);
      range.select();

  }
  if (window.getSelection) {
      var range = document.createRange();
      var sel = window.getSelection()
      range.selectNodeContents(container);
      sel.removeAllRanges();
      sel.addRange(range);
      sel.setBaseAndExtent(container, 0, container, 1);
  }
  if (container.setSelectionRange)
    container.setSelectionRange(0, 9999)
}

function aiSpeak(command_name) {
  $(window).on('load', function() {
    if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.interOp) {
      window.webkit.messageHandlers.interOp.postMessage({ action: "speak", voice: command_name })
    } else if (typeof Android !== 'undefined' && Android.playSound) {
      setTimeout(Android.playSound(command_name),100)
    } else {
      var x = document.getElementById("voice")
      x.autoplay = true
      x.load()
    }
  });
}

function googleAnalytics(user_id) {
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			if (user_id) {
				ga('create', 'UA-88039088-1', 'auto', {
				  userId: user_id
				});
			} else {
		  	ga('create', 'UA-88039088-1', 'auto');
			}
		  ga('send', 'pageview');
}


$(window).on('load', function() {
  if (typeof Android !== 'undefined' && Android.pageLoaded) {
    setTimeout(function() { Android.pageLoaded() }, 500)
  }

  $('code').css('cursor', 'pointer')
  $('code, .auto-select').on('mouseup touchend', function(e) {  e.preventDefault();})
  $('code, .auto-select').on('click touchstart focus tap', function(e) {
    selectText(this)
    $(this).select();
    $(this).get(0).setSelectionRange(0,9999);

  })

})
