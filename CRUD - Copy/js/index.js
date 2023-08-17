
$(document).ready(function(){
  $('select').formSelect();
});
      
$(document).ready(function(){
$('.datepicker').datepicker();
});

// document.addEventListener('DOMContentLoaded', function() {
// var elems = document.querySelectorAll('.modal');
// var instances = M.Modal.init(elems);

// var modal = M.Modal.getInstance(document.querySelector('#modal1'));
// modal.open();
// });

$(document).ready(function(){
    $('.modal').modal({
      opacity: 0.8,
      preventScrolling: true,
      dismissible: false,
      inDuration: '500',
      // startingTop: '-5%',
      // endingTop: '5%',
    });
    $('#modal1').modal('open');
  });




      $(document).ready(function(){
    $('.collapsible').collapsible();
  });

  $(document).ready(function(){
    $('.modal').modal();
  });
      
  $(document).ready(function(){
    $('.tooltipped').tooltip();
  });
        
