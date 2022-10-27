
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-primary">
              
              <div class="card-header">
                <h3 class="card-title">ASISTENCIA DE LOS ALUMNOS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button  type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                
                
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                               
     



              
  
                            ?>  



                  
               


                  <div class="table-responsive">        
                        <table id="asistenciaAlumnoFinal" class="table table-sm table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                
                                <th>ID</th>
     
                                <th>APELLIDO Y NOMBRE</th> 
                                 <th>DNI</th>
                                <th>BOTON</th> 
                                                    
                              
                            </tr>
                        </thead>
                         <tbody>
                            <?php  
                             $colorFinal='';

                            $contadorColores=0;                          
                             foreach($data as $dat) {
                                    
                                    $idAlumnos=$dat['idAlumnos'];
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                      
  
                                                        
                             if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='primary';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                            $colorFinal='info';
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='success';
                             }




                         
                            ?>
                            <tr class="table-<?php echo $colorFinal; ?>">
                             
                                <td><?php echo $idAlumnos; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                        

                                <td><button class="btn btn-outline-primary glyphicon glyphicon-pencil btnEditar_ASISTENCIA_alumno" title="ASISTENCIA"><i class="fas fa-sign-in-alt"></i></button></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                        
                       </table>  

               
              </div>




 <script type="text/javascript">
$(document).ready(function(){

  $('#imagenProceso').hide();



     asistenciaAlumno();



 var fila; //capturar la fila para editar o borrar el registro
    
//botón AISTENCIA    
$(document).on("click", ".btnEditar_ASISTENCIA_alumno", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());


  $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } });

        
   $.ajax({
          url: "modulos/gestionAcademicaAlumno/asistencia/elementos/seccionCicloInasistenciaAlumno.php",
          type: "POST",
          data: {id:id},
          success: function(r){  

                
         $.unblockUI();



    ret=`<select class="form-control" id="cicloLectivoFina">
              
                `+r+`
                </select></div>`;
     

      Swal.fire({
              title: 'AÑO LECTIVO',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  cicloLectivoFina = document.getElementById('cicloLectivoFina').value;
              
       

                  inasistenciaDocenteFinalAlu(cicloLectivoFina,id);
                                  
                }
        });




   }        
      });






    
});
  




}); 





function asistenciaAlumno() {
      asistenciaAlumnoFinal=$('#asistenciaAlumnoFinal').DataTable({ 


     "destroy":true,
  

   
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
      
    });
}





function inasistenciaDocenteFinalAlu(cicloLectivoFina,id){


  $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } });

         
        

     $.ajax({
        url: "modulos/gestionAcademicaAlumno/asistencia/elementos/alumno.php",
        type: "POST",
        dataType: "json",
        data: {id:id, cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').html('');
            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/asistencia/asistenciaAlumno_Tabla.php');
            $('#buscarTablaInstitucional').show();

             
              
        }        
    });
}


 $.unblockUI();
</script>





                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


