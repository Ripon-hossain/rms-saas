<div class="form-group text-right">
    <?php if ($this->permission->method('setting', 'create')->access()): ?>
        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i>
            <?php echo "Add Company Setting" ?></button>
    <?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-mg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo "Add Company Setting"; ?></strong>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <!-- <div class="panel-body">
                                    <?php echo form_open('setting/company/create') ?>
                                    <div class="form-group row">
                                        <label for="company_name" class="col-sm-4 col-form-label"><?php echo display('company_name') ?> *</label>
                                        <div class="col-sm-8">
                                            <input name="company_name" class="form-control" type="text" placeholder="Add <?php echo display('company_name') ?>" id="name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company_email" class="col-sm-4 col-form-label"><?php echo display('company_email') ?> *</label>
                                        <div class="col-sm-8">
                                            <input name="company_email" class="form-control" type="text" placeholder="<?php echo display('company_email') ?>" id="company_email" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rate" class="col-sm-4 col-form-label"><?php echo display('company_password') ?> *</label>
                                        <div class="col-sm-8">
                                            <input name="company_password" class="form-control" type="text" placeholder="<?php echo display('company_password') ?>" id="company_password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company_database_name" class="col-sm-4 col-form-label"><?php echo display('company_database_name') ?> *</label>
                                        <div class="col-sm-8">
                                            <input name="company_database_name" class="form-control" type="text" placeholder="<?php echo display('company_database_name') ?>" id="company_database_name" value="">
                                        </div>
                                    </div>
                                  
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                                    </div>
                                    <?php echo form_close() ?>

                                </div> -->

                                <div class="panel-body">
                                    <?php echo form_open_multipart("setting/company/create") ?>

                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 col-form-label"><?php echo display('firstname') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="firstname" class="form-control" type="text" placeholder="<?php echo display('firstname') ?>" id="firstname" value="<?php echo $user->firstname ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 col-form-label"><?php echo display('lastname') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="lastname" class="form-control" type="text" placeholder="<?php echo display('lastname') ?>" id="lastname" value="<?php echo $user->lastname ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email" value="<?php echo $user->email ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="db_name" class="col-sm-3 col-form-label"><?php echo display('db_name') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="db_name" class="form-control" type="text" placeholder="<?php echo display('db_name') ?>" id="db_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="db_username" class="col-sm-3 col-form-label"><?php echo display('db_username') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="db_username" class="form-control" type="text" placeholder="<?php echo display('db_username') ?>" id="db_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="db_password" class="col-sm-3 col-form-label"><?php echo display('db_password') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="db_password" class="form-control" type="text" placeholder="<?php echo display('password') ?>" id="db_password">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="about" class="col-sm-3 col-form-label"><?php echo display('about') ?></label>
                                        <div class="col-sm-9">
                                            <textarea name="about" placeholder="<?php echo display('about') ?>" class="form-control" id="about"><?php echo $user->about ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="istatus" class="col-sm-3 col-form-label"><?php echo display('isdisplaymonitor') ?></label>

                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label"><?php echo display('status') ?> *</label>
                                        <div class="col-sm-9">
                                            <label class="radio-inline">
                                                <?php echo form_radio('status', '1', (($user->status == 1 || $user->status == null) ? true : false), 'id="status"'); ?><?php echo display('active') ?>
                                            </label>
                                            <label class="radio-inline">
                                                <?php echo form_radio('status', '0', (($user->status == "0") ? true : false), 'id="status"'); ?><?php echo display('inactive') ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                                    </div>
                                    <?php echo form_close() ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('currency_edit'); ?></strong>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail">

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo "SL" ?></th>
                            <th><?php echo "fullname" ?></th>
                            <th><?php echo "email" ?></th>
                            <th><?php echo "db_name" ?></th>
                            <th><?php echo "db_username" ?></th>
                            <th><?php echo "status" ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($setting)) { ?>

                            <?php $sl = 1; ?>
                            <?php foreach ($tenants as $tenant) { ?>
                                <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $tenant->fullname; ?></td>
                                    <td><?php echo $tenant->email; ?></td>
                                    <td><?php echo $tenant->db_name; ?></td>
                                    <td><?php echo $tenant->db_username; ?></td>
                                    <td><?php echo (($tenant->status==1)?display('active'):display('inactive')); ?></td>

                                    <td class="center">
                                        <?php if ($this->permission->method('setting', 'update')->access()): ?>
                                            <input name="url" type="hidden" id="url_<?php echo $tenant->id; ?>" value="<?php echo base_url("setting/company/updateintfrm") ?>" />
                                            <a onclick="editinfo('<?php echo $tenant->id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <?php endif;
                                        if ($this->permission->method('setting', 'delete')->access()): ?>
                                            <a href="<?php echo base_url("setting/company/delete/$tenant->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php $sl++; ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table> <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>