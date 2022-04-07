<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection('content'); ?>
    <h3 class="page-title"><?php echo app('translator')->getFromJson('quickadmin.expense.title'); ?></h3>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_create')): ?>
    <p>
        <a href="<?php echo e(route('admin.expenses.create')); ?>" class="btn btn-success"><?php echo app('translator')->getFromJson('quickadmin.qa_add_new'); ?></a>
        
        <?php if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id): ?>
            <?php if(Session::get('Expense.filter', 'all') == 'my'): ?>
                <a href="?filter=all" class="btn btn-default">Show all records</a>
            <?php else: ?>
                <a href="?filter=my" class="btn btn-default">Filter my records</a>
            <?php endif; ?>
        <?php endif; ?>
    </p>
    <?php endif; ?>

    

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('quickadmin.qa_list'); ?>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped <?php echo e(count($expenses) > 0 ? 'datatable' : ''); ?> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_delete')): ?> dt-select <?php endif; ?>">
                <thead>
                    <tr>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_delete')): ?>
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <?php endif; ?>

                        <th><?php echo app('translator')->getFromJson('quickadmin.expense.fields.expense-category'); ?></th>
                        <th><?php echo app('translator')->getFromJson('quickadmin.expense.fields.entry-date'); ?></th>
                        <th><?php echo app('translator')->getFromJson('quickadmin.expense.fields.amount'); ?></th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    <?php if(count($expenses) > 0): ?>
                        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($expense->id); ?>">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_delete')): ?>
                                    <td></td>
                                <?php endif; ?>

                                <td field-key='expense_category'><?php echo e(isset($expense->expense_category->name) ? $expense->expense_category->name : ''); ?></td>
                                <td field-key='entry_date'><?php echo e($expense->entry_date); ?></td>
                                <td field-key='amount'><?php echo e($expense->expense_currency->symbol  . ' ' . number_format($expense->amount, 2, $expense->expense_currency->money_format_decimal, $expense->expense_currency->money_format_thousands)); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_view')): ?>
                                    <a href="<?php echo e(route('admin.expenses.show',[$expense->id])); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('quickadmin.qa_view'); ?></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_edit')): ?>
                                    <a href="<?php echo e(route('admin.expenses.edit',[$expense->id])); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('quickadmin.qa_edit'); ?></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_delete')): ?>
<?php echo Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.expenses.destroy', $expense->id])); ?>

                                    <?php echo Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')); ?>

                                    <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9"><?php echo app('translator')->getFromJson('quickadmin.qa_no_entries_in_table'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?> 
    <script>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_delete')): ?>
            window.route_mass_crud_entries_destroy = '<?php echo e(route('admin.expenses.mass_destroy')); ?>';
        <?php endif; ?>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>