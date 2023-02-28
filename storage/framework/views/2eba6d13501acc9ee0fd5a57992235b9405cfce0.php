 <?php $__env->startSection('content'); ?>


<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_header" class="modal-title"></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label><strong><?php echo e(trans('file.Quantity')); ?></strong></label>
                        <input type="number" name="edit_qty" class="form-control" step="any">
                    </div>
                    <div class="form-group">
                        <label><strong><?php echo e(trans('file.Unit Discount')); ?></strong></label>
                        <input type="number" name="edit_discount" class="form-control" step="any">
                    </div>
                    <div class="form-group">
                        <label><strong><?php echo e(trans('file.Unit Price')); ?></strong></label>
                        <input type="number" name="edit_unit_price" class="form-control" step="any">
                    </div>
                    <?php
            $tax_name_all[] = 'No Tax';
            $tax_rate_all[] = 0;
            foreach($lims_tax_list as $tax) {
                $tax_name_all[] = $tax->name;
                $tax_rate_all[] = $tax->rate;
            }
        ?>
                        <div class="form-group">
                            <label><strong><?php echo e(trans('file.Tax Rate')); ?></strong></label>
                            <select name="edit_tax_rate" class="form-control">
                                <?php $__currentLoopData = $tax_name_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div id="edit_unit" class="form-group">
                            <label><strong><?php echo e(trans('file.Product Unit')); ?></strong></label>
                            <select name="edit_unit" class="form-control">
                            </select>
                        </div>
                        <button type="button" name="update_btn" class="btn btn-primary"><?php echo e(trans('file.update')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="AddMotivo">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detalle Nota Débito</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Razón modificación</th>
                        <th>Valor modificación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        <td><input type="text"  class="form-control btn-sm" id="razon" > </td>
                        <td> <input type="text" size="5" class="form-control btn-sm"  id="valor"> </td>

                    </tr>
                </tbody>
            </table>
          </div>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="AgregarData();">Agregar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
        </div>
  
      </div>
    </div>
  </div>
    <section>
        <?php echo Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']); ?>

            <div class="row">
                <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Emisor: </th>
                                                            <td><?php echo e($emisor->razon_social); ?></td>
                                                            <th>Ruc: </th>
                                                            <td><?php echo e($emisor->ruc); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ambiente: </th>
                                                            <?php if($emisor->ambiente=="1"): ?>
                                                                 <td><span class="badge badge-secondary">Pruebas</span></td>
                                                            <?php else: ?>
                                                                <td><span class="badge badge-primary">Producción</span></td>
                                                            <?php endif; ?>
                                                            <th>Fecha Emisión: </th>
                                                            <td><input type="date" class="form-control" name="fecha_emision" id="fecha_emision"></td>    
                                                        </tr> 
                                                    </table>
                                                </div>
                                                
                                            </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                </div>
                    
             </div>
             <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Comprobante Modificado</h5>
                                    <hr>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Tipo Documento *</strong></label>
                                        <select required name="tipo_documento" id="tipo_documento" class="form-control"  title="Seleccione tipo documento...">
                                            <option value="">..Seleccione..</option>
                                            <option value="01">Factura</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Fecha emisión documento *</strong></label>
                                        <input type="date" class="form-control" name="fecha_emision" id="fecha_emision_documento">  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Número documento *</strong></label>
                                        <input type="text"  class="form-control" name="numero_comprobante" id="numero_comprobante" placeholder="001-001-000000001">   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Warehouse')); ?> *</strong></label>
                                        <select required name="warehouse_id" id="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Seleccione un establecimiento...">
                                            <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.customer')); ?> *</strong></label>
                                        <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Seleccione un cliente...">
                                            <?php $deposit = []; ?>
                                            <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $deposit[$customer->id] = $customer->deposit - $customer->expense; ?>
                                            <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name . ' (' . $customer->tax_no . ')'); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                
                                    <button type="button" onclick="AbrirModalMotivos();" class="btn btn-default btn-sm">Agrgar Motivo</button>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h5><?php echo e(trans('file.Order Table')); ?> *</h5>
                                    <div class="table-responsive mt-3" id="Contenedor">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                              <a class="nav-link active" data-toggle="tab" href="#home">Totales</a>
                                            </li>
                                            
                                          </ul>
                                          
                                          <!-- Tab panes -->
                                          <div class="tab-content">
                                            <div class="tab-pane container active" id="home">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:20%">Subtotal Sin Impuestos:</th>
                                                                <td><input readonly type="text" name="subtotalSinImpuestos" id="subtotalSinImpuestos" value="0.00"> </td> 
                                                             </tr>
                                                            <tr>
                                                               <th style="width:20%">Subtotal 12%:</th>
                                                               <td><input readonly type="text" name="subtotal12" id="subtotal12" value="0.00"> </td> 
                                                            </tr>
                                                            <tr>
                                                                <th>Subtotal 0%:</th>
                                                                <td><input readonly type="text" name="subtotal0" id="subtotal0" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>Subtotal no Objeto de Iva:	</th>
                                                                <td><input readonly type="text" name="subtotalnoiva" id="subtotalnoiva" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>Subtotal Exento de Iva:	</th>
                                                                <td><input readonly type="text" name="subtotalexentoiva" id="subtotalexentoiva" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>Total Descuento:	</th>
                                                                <td><input readonly type="text" name="totaldescuento" id="totaldescuento" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>	IVA 12%:	</th>
                                                                <td><input readonly type="text" name="iva12" id="iva12" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>	Valor Ice:	</th>
                                                                <td><input readonly type="text" name="valorice" id="valorice" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>	Valor Irbpnr:	</th>
                                                                <td><input readonly type="text" name="valorIrbpnr" id="valorIrbpnr" value="0.00"> </td> 
                                                             </tr>
                                                             <tr>
                                                                <th>		Valor Total:	</th>
                                                                <td><input readonly type="text" name="valortotal" id="valortotal" value="0.00"> </td> 
                                                             </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                            <button type="button" onclick="GuardarDocumento();" class="btn btn-primary btn-sm">GUARDAR DOCUMENTO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane container fade" id="menu1">
                                                <h2>Pendiente</h2>
                                            </div>
                                          </div>
                                    </div>
                            </div>
                       
                    </div>
                <?php echo Form::close(); ?>

                </section>
      




<?php $__env->startSection('scripts'); ?>
<script>
    
    
    $("ul#facturacion").siblings('a').attr('aria-expanded','true');
    $("ul#facturacion").addClass("show");
    $("ul#facturacion #nota-debito-create-menu").addClass("active");

    
    function AbrirModalMotivos(){
        $("#AddMotivo").modal('show');
    }
    function AgregarData(){
        
        if(isNaN($("#valor").val())){
            swal("Mensaje!", "ingrese un valor numérico en el camoo valor!", "warning", {
                button: "OK!",
              });
            
             return;
        }
        if($("#valor").val()==""){
            swal("Mensaje!", "ingrese una razón!", "warning", {
                button: "OK!",
              });
             return;
        }
        var  parametros={
            '_token':$('input[name=_token]').val(),
            'razon':$("#razon").val(),
            'valor':$("#valor").val(),
          }

          $.ajax({
            url: "agregar",
            type: 'POST',
            data: parametros,
        }).done(function (respuesta) {

            $("#Contenedor").html("");
            $("#Contenedor").append(respuesta);
            $("#AddMotivo").modal('hide');
            CalcularTotales();
        });
    }

    function EliminarLinea(indice){
        //alert(indice);
        var  parametros={
            '_token':$('input[name=_token]').val(),
            'indice':indice,
          }
        $.ajax({
            url: "eliminar",
            type: 'POST',
            data: parametros,
        }).done(function (respuesta) {

            $("#Contenedor").html("");
            $("#Contenedor").append(respuesta);
            //$("#AddMotivo").modal('hide');
           CalcularTotales();
        });
    }
    function CalcularTotales(){

        var razonCl = $('.razon');
        var valorCl = $(".valor");
     

        var valor=0.00;
 

        valorCl.each(function()
          {
            valor =valor + parseFloat($(this).val());   
          }); 
         
            $("#subtotalSinImpuestos").val(parseFloat(valor).toFixed(2));
            $("#subtotal12").val(parseFloat(0.00).toFixed(2));
            $("#subtotal0").val(parseFloat(0.00).toFixed(2));
            $("#subtotalnoiva").val(parseFloat(0.00).toFixed(2));
            $("#subtotalexentoiva").val(parseFloat(0.00).toFixed(2));
            $("#totaldescuento").val(parseFloat(0.00).toFixed(2));
            $("#iva12").val(parseFloat(0.00).toFixed(2));
            $("#valorice").val(parseFloat(0.00).toFixed(2));
            $("#valorIrbpnr").val(parseFloat(0.00).toFixed(2));
            total = parseFloat(valor);
            $("#valortotal").val(parseFloat(total).toFixed(2));
        }

    function eliminarItem(id){
        $("#"+id).remove();
        CalcularTotales();
    }


     function GuardarDocumento(){
        var warehouse_id = $("#warehouse_id").val();
        var fecha_emision_documento = $("#fecha_emision_documento").val();
        var tipo_documento= $("#tipo_documento").val(); 
        var customer_id= $("#customer_id").val(); 
        
        var numero_comprobante= $("#numero_comprobante").val();

        var fecha_emision = $("#fecha_emision").val();

        var subtotalSinImpuestos =$("#subtotalSinImpuestos").val();
        var subtotal12 =$("#subtotal12").val();
        var subtotal0 =$("#subtotal0").val();
        var subtotalnoiva =$("#subtotalnoiva").val();
        var subtotalexentoiva =$("#subtotalexentoiva").val();
        var totaldescuento =$("#totaldescuento").val();
        var iva12 =$("#iva12").val();
        var valorice =$("#valorice").val();
        var valorIrbpnr =$("#valorIrbpnr").val();
        var valortotal =$("#valortotal").val();

     
        if(fecha_emision==""){
            swal("Mensaje!", "Ingrese fecha de emisión!", "warning", {
                button: "OK!",
              });
              return;
        }
        if(fecha_emision_documento==""){
            swal("Mensaje!", "Ingrese fecha de emisión del comprobante modificado!", "warning", {
                button: "OK!",
              });
              return;
        }
        
        if(customer_id==""){
            swal("Mensaje!", "Cliente es obligatorio!", "warning", {
                button: "OK!",
              });
              return;
        }
        
        if(warehouse_id==""){
            swal("Mensaje!", "Seleccione Almacén!", "warning", {
                button: "OK!",
              });
              return;
        }


        var parametros={
            '_token':$('input[name=_token]').val(),
            'warehouse_id':warehouse_id,
            'fecha_emision_documento':fecha_emision_documento,
            'tipo_documento':tipo_documento,
        
            'customer_id':customer_id,
            'numero_comprobante':numero_comprobante,
            'fecha_emision':fecha_emision,
            'subtotalSinImpuestos':subtotalSinImpuestos,
            'subtotal12':subtotal12,
            'subtotal0':subtotal0,
            'subtotalnoiva':subtotalnoiva,
            'subtotalexentoiva':subtotalexentoiva,
            'totaldescuento':totaldescuento,
            'iva12':iva12,
            'valorice':valorice,
            'valorIrbpnr':valorIrbpnr,
            'valortotal':valortotal
        };

        $.ajax({
            url: "insert",
            type: 'POST',
            data: parametros,
        }).done(function (respuesta) {
            //alert(respuesta);
            console.log(respuesta);
            window.location.href = "/nota/debito";
        });
     }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>