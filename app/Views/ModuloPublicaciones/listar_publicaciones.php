<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title"><b>Lista de Publicaciones Activas</b></h2>
                <div class="d-grid d-md-flex  justify-content-md-end">
                  <a class=" btn btn-danger mr-4" href="<?php echo base_url('ModuloPublicaciones/PublicacionesInactivas')?>"><i class="far fa-newspaper"></i>
                  Publicaciones Inactivas</a>
                </div>
              </div>
              <div class="card-body" id="actualizar">
                <table id="publicaciones" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Imagen</th>
                    <th>Titulo</th>
                    <th>Tipo</th>
                    <th>Vendedor</th>
                    <th>Fecha de publicación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="lista" >

                    <?php foreach ($datos as $dato ): ?>
                      <tr>
                        <td class="id"><?php echo $dato['id_publicacion'] ?></td>
                        <td class="text-center"><img src="<?php echo base_url('public/dist/img/publicaciones/').'/publicacion'.$dato['id_publicacion'].'/'.$dato['imagen'] ?>" class="rounded img-size-50 mr-2"></td>
                        <td><?php echo $dato['titulo'] ?></td>
                        <td><?php echo $dato['tipo_publicacion'] ?></td>
                        <td><?php echo $dato['nombre_usuario'] ?></td>
                        <td><?php echo $dato['fecha_publicacion'] ?></td>
                        <td><?php echo $dato['estado_publicacion'] ?></td>
                        <td>
                          <a type='button' href='<?php echo base_url('/ModuloPublicaciones/ConsultaDetalle?file=').$dato['id_publicacion'] ?>' class='btn btn-success detalle'>
                            <i class='far fa-eye'></i>
                          </a>
                          <?php if($_SESSION['tipo_usuario']!="ADMINISTRADOR") { ?>
                          <a type='button' href='<?php echo base_url('/ModuloPublicaciones/EditarPublicacion?id=').$dato['id_publicacion'] ?>' class='btn btn-warning editar ml-1'>
                            <i class='far fa-edit'></i>
                          </a>
                          <?php } ?>
                          <button class='btn btn-danger eliminar ml-1'> 
                            <i class='far fa-trash-alt'></i>
                          </button>
                          
                        </td>
                      </tr>
                    <?php endforeach ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
  </div>

  <script >
    $(document).ready(iniciar);
  
    function iniciar() {
      $('#publicaciones').DataTable({
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"},
        "responsive": true, "autoWidth": false,
         "ordering":true,
         "aoColumnDefs": [
           { 'bSortable': false, 'aTargets': [ 1 ] },
           { 'bSortable': false, 'aTargets': [ 6 ] },
           { 'bSortable': false, 'aTargets': [ 7 ] }
        ],
      });
      $('.eliminar').click(eliminardatos);
      $('.editar').click(editardatos);
    }

    function eliminardatos() {

      $(this).parents('tr').attr('id', 'por_eliminar');
      var id = $(this).parents("tr").find(".id").text();
      rowId = $(this).parents("tr").attr('id');
      $.ajax({
        url: '<?php echo base_url('/ModuloPublicaciones/EliminarPublicacion');?>',
        type: 'POST',
        dataType: 'text',
        data: {id: id},
      }).done(function(data) {
        
        if (data=="Eliminado") {
          Swal.fire({
            title: 'Desea eliminar este registro?',
            showCancelButton: true,
            confirmButtonText: `Aceptar`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              Swal.fire('Eliminado!', '', 'success');
              $("#publicaciones").DataTable().rows($("#"+rowId)).remove();
              $("#publicaciones").DataTable().search("").columns().search("").draw();
            } 
          })
          
        }else{
          alert("No se pudo eliminar el registro");
        }

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

    };

    function editardatos() {

      var id = $(this).parents("tr").find(".id").text();

      $('#editar_modal').modal();

      $.ajax({
        url: '<?php echo base_url('/ModuloPublicaciones/ConsultaIndividual');?>',
        type: 'POST',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {

        for (var i = 0; i < data.length; i++) {
          $('#titulo').val(data[i].titulo);
          $('#descripcion').val(data[i].descripcion);
          $('#stock').val(data[i].stock);
          $('#precio').val(data[i].precio);
          $('#precio_envio').val(data[i].precio_envio);
          $('#descuento').val(data[i].descuento);
         
        }

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


      $.ajax({
        url: '<?php echo base_url('/ModuloPublicaciones/ConsultaImagenes');?>',
        type: 'POST',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {

        $.each(data, function( index, value ) {
           $( ".Brand" ).append( "<img src='"+this+"' > class='imagen'" );
        });

       for (var i = 0; i < data.length; i++) {
          var img = "<img src='<?php echo base_url('public/dist/img/publicaciones/')?>"+'/'+data[i].imagen+"' class='rounded img-size-50 mr-2'>";
          $('.dvPreview').append(img);
          
        }
 
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


      
    }

  </script>

  