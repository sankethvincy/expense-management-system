<?php $__env->startSection('content'); ?>

    <h3 class="page-title">Monthly Report</h3>

    <?php echo Form::open(['method' => 'get']); ?>

        <div class="row">
            <div class="col-xs-1 col-md-1 form-group">
                <?php echo Form::label('year','Year',['class' => 'control-label']); ?>

                <?php echo Form::select('y', array_combine(range(date("Y"), 1900), range(date("Y"), 1900)), old('y', Request::get('y', date('Y'))), ['class' => 'form-control']); ?>

            </div>
            <div class="col-xs-2 col-md-2 form-group">
                <?php echo Form::label('month','Month',['class' => 'control-label']); ?>

                <?php echo Form::select('m', cal_info(0)['months'], old('m', Request::get('m', date('m'))), ['class' => 'form-control']); ?>

            </div>
            <div class="col-xs-4">
                <label class="control-label">&nbsp;</label><br>
                <?php echo Form::submit('Select month',['class' => 'btn btn-primary']); ?>

            </div>
        </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Report
        </div>
        <?php echo Form::close(); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Income</th>
                            <td><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($inc_total, 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></td>
                        </tr>
                        <tr>
                            <th>Expenses</th>
                            <td><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($exp_total, 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></td>
                        </tr>
                        <tr>
                            <th>Profit</th>
                            <td><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($profit, 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Income by category</th>
                            <th><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($inc_total, 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></th>
                        </tr>
                    <?php $__currentLoopData = $inc_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($inc['name']); ?></th>
                            <td><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($inc['amount'], 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Expenses by category</th>
                            <th><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($exp_total, 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></th>
                        </tr>
                    <?php $__currentLoopData = $exp_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($inc['name']); ?></th>
                            <td><?php echo e(auth()->user()->currency->symbol . ' ' . number_format($inc['amount'], 2, auth()->user()->currency->money_format_decimal, auth()->user()->currency->money_format_thousands)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>