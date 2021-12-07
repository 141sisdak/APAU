$(function(){


    // I - Datatable

    var tablaAdoptante = $("#tablaAdoptante").DataTable({
      
        dom:"<'row filtrosAdoptante'<'col-sm-12 col-md-2 'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      
      
        "language": {
            "lengthMenu": "Registos por página _MENU_ ",
            "search":         "Buscar:",
            "zeroRecords": "Cargando",
            "info": "Total registros: _TOTAL_",
            "infoEmpty": "No hay registros",
            "thousands": " ",
            "infoFiltered": "(de un total de _MAX_ registros)",
            "paginate": {
                "first":      "Primera",
                "last":       "Última",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        'info': true,
            "ajax":{
                "method": "GET",
                "url":"../app/Ajax/adoptanteAjax.php",
                "dataSrc": ""
            
            },
            "columns":[
                {"data":"id"},
                {"data":"nombre"},
                {"data":"apellidos"},
                {"data":"telefono1"},
                {"data":"telefono2"},
                {"data":"email"},
                {"data":"direccion"},
                {"data":"provincia"},
                {"data":"localidad"},
                {"data":"dni"},
                {"data":"num_mascotas"},
                null,
                null
            ],
            "columnDefs":[
                {
                  "targets": -2,
                  "data":null,
                  "defaultContent":' <button type="button" class="btn_icono_tabla btnModAdoptante" data-toggle="modal"  data-target="#modficarAdoptante"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":'<button type="button" class="btn_icono_tabla btnEliminarRegistro adoptante" ><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
                    "orderable":false
                },
                {
                    "targets":0,
                    "data":"id",
                    "searchable": false,
                    "className":"idOculto"
                },
                {
                    "targets":[3,4,5,6,9],
                    "orderable":false,
                    
                }
                ]
    });

   

        $('#busquedaAdoptante').on('keyup change clear', function() {
            tablaAdoptante.search(this.value).draw();
           });
        

        // F - Datatable

    $('#btnNuevoAdoptante').click(function(){

        $("#formNuevoAdoptante .errorValidacion").remove();

      
        comprobarObligatorios($("#formNuevoAdoptante .obligatorio"));
        validarSoloLetras($('#nombreAdop'));
        validarSoloLetras($('#apellidosAdop'));
        validarTelf($('#telf1Adop'));
        validarTelf($('#telf2Adop'));
        validarEmail($('#emailAdop'));
        validarSoloLetras($('#provinciaAdop'));
        validarDni($('#dniAdop'));
        comprobarDniRep("#dniAdop");


        setTimeout(function() {
            if (!$("#formNuevoAdoptante .errorValidacion").length > 0) {
                $('#formNuevoAdoptante').submit();
            } 
        }, 1000);


    })

    tablaAdoptante.on("click", ".btnModAdoptante", function(){

        $(".errorValidacion").remove();

        var id = $(this).parent().parent().find("td:first").text();
        
        var modal = $(document).find("#formModAdoptante");

        $.ajax({
            type: "get",
            url: "../app/Ajax/adoptanteAjax.php",
            dataType: 'json',
            cache: false,
            data: {
                idMod: id
            },
            success: function(response) {
                if (response) {

                    $(modal).find($("#idAdoptante").val(id));
                    $(modal).find($("#nombreModAdop").val(response.nombre));
                    $(modal).find($("#apellidosModAdop").val(response.apellidos));
                    $(modal).find($("#telf1ModAdop").val(response.telefono1));
                    $(modal).find($("#telf2ModAdop").val(response.telefono2));
                    $(modal).find($("#comentariosModAdop").val(response.comentarios));
                    $(modal).find($("#emailModAdop").val(response.email));
                    $(modal).find($("#direccionModAdop").val(response.direccion));
                    $(modal).find($("#provinciaModAdop").val(response.provincia));
                    $(modal).find($("#selLocalidadModAdop").val(response.localidad));
                    $(modal).find($("#dniModAdop").val(response.dni));
                    $(modal).find($("#numMascotasModAdop").val(response.num_mascotas));

                    localStorage.setItem("dniAnterior", response.dni);
  
                }
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

       $('#btnEnviarModAdop').click(function(e){

        $(".errorValidacion").remove();

        comprobarObligatorios($(".obligatorioMod"));
        validarSoloLetras($('#nombreModAdop'));
        validarSoloLetras($('#apellidosModAdop'));
        validarTelf($('#telf1ModAdop'));
        validarTelf($('#telf2ModAdop'));
        validarEmail($('#emailModAdop'));
        validarSoloLetras($('#provinciaModAdop'));
        validarDni($('#dniModAdop'));
        
        if(localStorage.getItem("dniAnterior")!=null && $('#dniModAdop').val()!=localStorage.getItem("dniAnterior")){
            
            comprobarDniRep($('#dniModAdop'));
            localStorage.removeItem("dniAnterior");
            
        }
      
        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {
               
                e.stopPropagation();
              
            } else {
                e.stopPropagation();
                $('#formModAdoptante').submit();
            }
        }, 1000);
  
    });
       
      });

    

});