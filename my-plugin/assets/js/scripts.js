var theId = 0
$( function() {
    theId =  document.querySelectorAll('.ui-state-default').length;
    loadSortOrder();
  } );



function loadSortOrder(){
  var data = $('#sortable').sortable('toArray');
  $("#elements-order").text(data.toString());
}
$("#sortable").sortable({
  cancel: ".fixed",
  stop: function(s,e){loadSortOrder();}
});

$('#add').click(function () {
  var id = ++theId;
    var $li = `<li id="${id}" class="ui-state-default">
                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                <input name="list[]" type="text" onclick="this.focus()" />
                <button onclick="deleteIteme(this)">Delete</button>
             </li>`;
    
    $('#sortable').append($li);
    loadSortOrder();
});


function deleteIteme (x) {
    $(x).parent().remove();
    loadSortOrder();
}