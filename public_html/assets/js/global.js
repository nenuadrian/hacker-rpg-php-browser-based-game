

function selectText(container) {
      if (document.selection) {
          var range = document.body.createTextRange();
          range.moveToElementText(container);
          range.select();
      } else if (window.getSelection) {
          var range = document.createRange();
          range.selectNode(container);
          window.getSelection().addRange(range);
      }
  }


$(document).ready(function() {
  $('code, .auto-select').css('cursor', 'pointer')
  $('code').click(function() {
    selectText(this)
  })

})
