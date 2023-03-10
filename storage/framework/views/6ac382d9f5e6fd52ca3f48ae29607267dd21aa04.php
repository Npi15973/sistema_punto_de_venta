 <?php $__env->startSection('content'); ?>
<?php
$general_setting= DB::table('general_settings')->latest()->first();
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<?php echo e(Form::open(['route' => 'report.bestSellerByWarehouse', 'method' => 'post', 'id' => 'report-form'])); ?>

			<input type="hidden" name="warehouse_id_hidden" value="<?php echo e($warehouse_id); ?>">
            <h4 class="text-center mt-3"><?php echo e(trans('file.Best Seller')); ?> <?php echo e(trans('file.From')); ?> <?php echo e($start_month.' - '.date("F Y")); ?> &nbsp;&nbsp;
            <select class="selectpicker" id="warehouse_id" name="warehouse_id">
				<option value="0"><?php echo e(trans('file.All Warehouse')); ?></option>
				<?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
            </h4>
            <?php echo e(Form::close()); ?>

            <?php if(isset($product[3])): ?>
            <div>
                <div class="alert alert-success text-center">
                    <h1><?php echo e($product[3]); ?></h1>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="card-body">
            	<?php
            		if($general_setting->theme == 'default.css'){
            			$color = '#733686';
                        $color_rgba = 'rgba(115, 54, 134, 0.8)';
            		}
            		elseif($general_setting->theme == 'green.css'){
                        $color = '#2ecc71';
                        $color_rgba = 'rgba(46, 204, 113, 0.8)';
                    }
                    elseif($general_setting->theme == 'blue.css'){
                        $color = '#3498db';
                        $color_rgba = 'rgba(52, 152, 219, 0.8)';
                    }
                    elseif($general_setting->theme == 'dark.css'){
                        $color = '#34495e';
                        $color_rgba = 'rgba(52, 73, 94, 0.8)';
                    }
                 ?>
              	<canvas id="bestSeller" data-color="<?php echo e($color); ?>" data-color_rgba="<?php echo e($color_rgba); ?>" data-product = "<?php echo e(json_encode($product)); ?>" data-sold_qty="<?php echo e(json_encode($sold_qty)); ?>" ></canvas>
            </div>
            
        </div>
	</div>
</div>

<script type="text/javascript">

	$("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #best-seller-report-menu").addClass("active");

	$('#warehouse_id').val($('input[name="warehouse_id_hidden"]').val());
	$('.selectpicker').selectpicker('refresh');

	$('#warehouse_id').on("change", function(){
		$('#report-form').submit();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>