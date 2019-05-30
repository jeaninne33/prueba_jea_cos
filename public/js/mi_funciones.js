  $(document).on('click', ".deletes", function(e) {
      event.preventDefault();
      var token = $(form).find('input[name="_token"]').val();
      var form = '.deletes';
      var data = $(form).serialize();
      var route = $(this).attr('action');
      var type = $(this).attr('method');
      console.log(token);
      swal({ //se configura el mesaje al usuario con el plugin de SweetAlert.
              title: "Confirmación",
              text: "¿Seguro que desea eliminar el Registro?",
              icon: "warning",

              buttons: true,
              dangerMode: true,
          })
          .then((isConfirm) => {
              // console.log(isConfirm);
              if (isConfirm) { //encaso de confirmar envia peticion ajax a la funcion 
                  $.ajax({
                      type: type,
                      url: route,
                      headers: {
                          'X-CSRF-TOKEN': token
                      },
                      data: data,
                      success: function(data) {
                          $('#container-loading').removeClass("show");
                          $('#messages').show();
                          $('#messages').removeClass("alert alert-danger");
                          $('#messages').addClass("alert alert-success");
                          $('#messages').html('<a class="close" data-hide-closest=".alert">×</a>' + data.msj);
                          $('#lista_usuarios').DataTable().ajax.reload();
                      },
                      error: function(data) {
                          $('#container-loading').removeClass("show");
                          $('#messages').show();
                          $('#messages').removeClass("alert alert-success");
                          $('#messages').addClass("alert alert-danger");
                          $('#messages').html('<a class="close" data-hide-closest=".alert">×</a>' + data.responseJSON.msj);
                      }
                  });
              }
          });

  });

  $(".dinamico").change(function() {
      var id = $(this).val(); //id del valor a buscar
      var target = $(this).attr('target'); //nombre del elemento a llenar
      var url = $(this).attr('url'); //ruta donde se va a buscar la data

      var token = $(form).find('input[name="_token"]').val();
      console.log(target, id, url, token);
      $.ajax({
          data: {
              'id': id,
              '_token': token
          }, //datos que se envian a traves de ajax
          url: url,
          type: 'post', //método de envio
          success: function(data) { //una vez que el archivo recibe el request lo procesa y lo devuelve
              $("#" + target).empty();
              $("#" + target).append(data);
              if (target == 'departamento_id') {
                  $("#municipio_id").empty();
                  $("#municipio_id").append('<option>Seleccione una Opción</option>');
              }
          }
      });
  });
  $(document).on('submit', ".form", function(e) {
      // Stop form from submitting normally
      e.preventDefault();
      var token = $(form).find('input[name="_token"]').val();
      var form = '#' + $(this).attr('id');
      ///  var data = $(form).serialize();
      var route = $(this).attr('action');
      var form = $(this)[0];
      var data = new FormData(form);
      $.ajax({
          url: route,
          type: 'post',
          data: data,
          enctype: 'multipart/form-data',
          processData: false, // Important!
          contentType: false,
          cache: false,
          headers: { 'X-CSRF-TOKEN': token },
          success: function(data) {
              $('#messages').removeClass("alert alert-danger");
              $('#messages').addClass("alert alert-success");
              $('#messages').html(data.msj);
              setTimeout(function() {
                  window.location.href = data.route; //se devuelde a la vista
              }, 1000);

          },
          error: function(data) {
              $('#messages').removeClass("alert alert-success");
              $('#messages').addClass("alert alert-danger");
              $('#messages').html("");
              $(".has-error").removeClass("has-error");
              $.each(data.responseJSON.errors, function(key, value) {
                  jQuery('#messages').append('<p>' + value + '</p>');
                  $("." + key).addClass("has-error");
              });
          }
      });
  });