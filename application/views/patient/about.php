<div class="clearfix"></div>
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo $patient[0]->name; ?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <table class="table">
          <?php
            $fields = array(
                'name' => $lang['lbl_patient_name'],
                'phone' => $lang['lbl_patient_phone'],
                'blood_group' => $lang['lbl_patient_bg'],
                'department' => $lang['lbl_patient_department'],
                'birth_date' => $lang['lbl_patient_bdate'],
                'age' => $lang['lbl_patient_age'],
                'sex' => $lang['lbl_patient_gender'],
                'email' => $lang['lbl_patient_email'],
                'county' => $lang['lbl_patient_country'],
                'city' => $lang['lbl_patient_city'],
                'address' => $lang['lbl_patient_address'],
                'about' => $lang['lbl_patient_about']
              );
            foreach ($fields as $key => $value) {
              ?>
              <tr>
                <td><strong><?php echo $value; ?></strong></td>
                <td><?php echo $patient[0]->{$key}; ?></td>
              </tr>
              <?php
            }
          ?>
        </table>
      </div>
      <div class="col-xs-12 col-sm-6">
        <table class="table">
          <?php
            $fields = array(
                'guardian_name' => $lang['lbl_patient_gname'],
                'guardian_phone' => $lang['lbl_patient_gphone'],
                'guardian_details' => $lang['lbl_patient_gdetails'],
                'bad_no' => $lang['lbl_patient_badno'],
                'referred_by' => $lang['lbl_patient_referedby'],
                'reg_date' => $lang['lbl_patient_admitdate'],
                'descriptions' => $lang['lbl_patient_description'],
              );
            foreach ($fields as $key => $value) {
              ?>
              <tr>
                <td><strong><?php echo $value; ?></strong></td>
                <td><?php echo $patient[0]->{$key}; ?></td>
              </tr>
              <?php
            }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

