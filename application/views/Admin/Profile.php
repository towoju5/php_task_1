<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<br/>
<div class="tab-content m-4" id="nav-tabContent">
    <?php if (validation_errors()) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (strlen($error) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (strlen($success) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="success">
                <?php echo $success; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                 <h5 class="primaryHeading2 mb-4 text-md-left pl-3">
                    Edit Profile
                </h5>
                <?= form_open() ?>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Email">Email </label>
					<input type="email" class="form-control" id="form_email" name="email" value="<?php echo set_value('email', $this->_data['view_model']->get_email());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Password">Password </label>
					<input type="password" class="form-control" id="form_password" name="password" value=""/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="First Name">First Name </label>
					<input type="text" class="form-control" id="form_first_name" name="first_name" value="<?php echo set_value('first_name', $this->_data['view_model']->get_first_name());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Last Name">Last Name </label>
					<input type="text" class="form-control" id="form_last_name" name="last_name" value="<?php echo set_value('last_name', $this->_data['view_model']->get_last_name());?>"/>
				</div>
                <div class="form-group col-md-5 col-sm-12">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>