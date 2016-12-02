

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


$(document).ready(function() {
  $('code').css('cursor', 'pointer')
  $('code, .auto-select').on('mouseup touchend', function(e) {  e.preventDefault();})
  $('code, .auto-select').on('click touchstart focus tap', function(e) {
    selectText(this)
    $(this).select();
    $(this).get(0).setSelectionRange(0,9999);

  })


})
