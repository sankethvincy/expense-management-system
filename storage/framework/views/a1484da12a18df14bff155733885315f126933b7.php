<?php $__env->startSection('content'); ?>
    <h3 class="page-title"><?php echo app('translator')->getFromJson('quickadmin.income.title'); ?></h3>
    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.incomes.store'], 'id' => 'income']); ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('quickadmin.qa_create'); ?>
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <?php echo Form::label('income_category_id', trans('quickadmin.income.fields.income-category').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::select('income_category_id', $income_categories, old('income_category_id'), ['class' => 'form-control select2', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('income_category_id')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('income_category_id')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <?php echo Form::label('entry_date', trans('quickadmin.income.fields.entry-date').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('entry_date')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('entry_date')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <?php echo Form::label('amount', trans('quickadmin.income.fields.amount').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::text('amount', old('amount'), ['class' => 'form-control', 'id' => 'moneyFormat', 'placeholder' => '', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('amount')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('amount')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>

    <?php echo Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']); ?>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    ##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "<?php echo e(config('app.date_format_js')); ?>"
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>