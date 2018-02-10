(function(){
  $(window).scroll(function () {
      var top = $(document).scrollTop();
      $('.splash').css({
        'background-position': '0px -'+(top/3).toFixed(2)+'px'
      });
      if(top > 50)
        $('#home > .navbar').removeClass('navbar-transparent');
      else
        $('#home > .navbar').addClass('navbar-transparent');
  });

  $("a[href='#']").click(function(e) {
    e.preventDefault();
  });

  var $button = $("<div id='source-button' class='btn btn-primary btn-xs'>&lt; &gt;</div>").click(function(){
    var html = $(this).parent().html();
    html = cleanSource(html);
    $("#source-modal pre").text(html);
    $("#source-modal").modal();
  });

  $('.bs-component [data-toggle="popover"]').popover();
  $('.bs-component [data-toggle="tooltip"]').tooltip();

  $(".bs-component").hover(function(){
    $(this).append($button);
    $button.show();
  }, function(){
    $button.hide();
  });

  function cleanSource(html) {
    html = html.replace(/×/g, "&times;")
               .replace(/«/g, "&laquo;")
               .replace(/»/g, "&raquo;")
               .replace(/←/g, "&larr;")
               .replace(/→/g, "&rarr;");

    var lines = html.split(/\n/);

    lines.shift();
    lines.splice(-1, 1);

    var indentSize = lines[0].length - lines[0].trim().length,
        re = new RegExp(" {" + indentSize + "}");

    lines = lines.map(function(line){
      if (line.match(re)) {
        line = line.substring(indentSize);
      }

      return line;
    });

    lines = lines.join("\n");

    return lines;
  }

})();
var token = localStorage.getItem('token');
$.ajaxSetup({
   headers:{'Authorization': 'Bearer '+ token}
})

$('#btnLogMeOut').click(function(){
    swal({
      title: "Confirmation",
      text: "Are you sure you want to logout?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn btn-danger",
      confirmButtonText: "Logout",
      closeOnConfirm: true
    },
    function(){
      $.ajax({
        url:'api/logout',
        type:'get',
        cache:false,
        beforeSend:function(){
          $('.loader').show();
        },
        success:function(data){
          if(data.success == true){
            window.location.reload();
            localStorage.clear();
            sessionStorage.clear();
          }
          else{
            swal({
              title:'Warning',
              text:'Unable to logout, Something went wrong',
              type:'info'
            })
          }
        }
      })
    });
})
