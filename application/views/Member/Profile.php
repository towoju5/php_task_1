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
            <div class="card-body pb-3 pl-3 pr-3">
                <h5 class="primaryHeading2 mb-4 text-md-left pl-3 mt-1">
                    Edit Profile
                </h5>
                <?= form_open() ?>
                  <!-- <div class="form-group col-md-5 col-sm-12">
                    <label for="Username">Username </label>
                    <input type="text" class="form-control" id="form_username" name="username" value="<?php echo set_value('username', $this->_data['username'] );?>"/>
                  </div> -->

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
                    <label for="Phone">Phone (Optional) </label>
                    <input type="text" class="form-control" id="form_phone" name="phone" value="<?php echo set_value('phone', (($this->_data['phone']) ? $this->_data['phone'] : ''));?>"/>
                  </div>

                  <div class="form-group col-md-5 col-sm-12">
                    <label for="form_category_id">School (Optional) </label>
                    <select id="form_category_id" name="school_id" class="form-control data-input select2">
                      <option value="">--Select--</option>
                      <?php foreach ( $this->_data['schools'] as $key)
                      {
                        echo "<option value='{$key->id}' " . (($this->_data['school_id']  == $key->id && $this->_data['school_id']  != '') ? 'selected' : '') . "> {$key->name} </option>";
                      } ?>
                    </select>
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
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
$('.select2').select2();
</script>