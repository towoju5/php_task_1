<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2020*/
if ($layout_clean_mode) {
    echo '<style>#content{padding:0px !important;}</style>';
}
?>

<div class="tab-content mx-4 mt-3" id="nav-tabContent">
<!-- Bread Crumb -->
<div aria-label="breadcrumb">
    <ol class="breadcrumb pl-0 mb-1 bg-background d-flex justify-content-center justify-content-md-start">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/member/user_card/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Add
        </li>
    </ol>
</div>

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
<div class="row mb-5">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="primaryHeading2 mb-4 text-md-left pl-3">
                    Add <?php echo $view_model->get_heading();?>
                </h5>
                <?= form_open() ?>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="card_name">Card Name </label>
                    <input type="text" class="form-control data-input" id="card_name" name="card_name" value="<?php echo set_value('card_name'); ?>"/>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="card_number">Card Number </label>
                    <input type="text" class="form-control data-input" id="card_number" name="card_number" value="<?php echo set_value('card_number'); ?>"/>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Expire month">Expire month </label>
                    <select name="exp_month" id="exp_month" class="form-control data-input" required>
                      <option value="">Select Month</option>
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Expire year">Expire year </label>
                    <?php
                    $year  = Date('Y');
                    $limit = $year + 25;
                    ?>
                    <select name="exp_year" id="exp_year" class="form-control data-input" required="true">
                      <option value="">Select Year</option>
                      <?php
                      for ($i = $year; $i <= $limit; $i++)
                      {
                        echo "<option value='" . $i . "' > " . $i . " </option>";
                      } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="cvc" class="required">CVC</label>
                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;"
                      name="cvc" id="cvc" placeholder="Enter CVC" class="form-control" max-length="4" min-length="3"
                      required="true" />
                  </div>

                  <div class="form-group col-md-5 col-sm-12">
                    <input type="hidden" name="is_default" value="1">
                    <input type="submit" class="btn btn-primary text-white mr-4 my-4" value="Submit">
                  </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>