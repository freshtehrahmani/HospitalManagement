
<div class="page-title">
  <div class="title_left">
  <h3><?php echo $lang['title']; ?></h3>
  </div>

  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <form action="" method="get">
        <div class="input-group">
          <input type="text" class="form-control" name="s" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="x_panel">
  <div class="x_title">
    <h2><?=$lang['title_header']?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <table class="table table-striped">
      <thead>
        <tr>
          <th><?=$lang['th_name']?></th>
          <th><?=$lang['th_phone']?></th>
          <th><?=$lang['th_description']?></th>
          <th style="width:25%"><?=$lang['th_action']?></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($patients as $key => $value) {
          ?>
          <tr>
            <td><?php echo $value->name; ?></td>
            <th scope="row"><?php echo $value->phone; ?></th>
            <td><?php echo $value->descriptions; ?></td>
            <td>
              <a href="<?php echo base_url(); ?>patient/about/<?php echo $value->id; ?>" class="btn btn-xs btn-success"><i class="fa fa-eye fa-2" aria-hidden="true"></i> <?=$lang['btn_details']?></a>
              <a href="<?php echo base_url(); ?>patient/update/<?php echo $value->id; ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o fa-2" aria-hidden="true"></i> <?=$lang['btn_edit']?></a>
              <a href="<?php echo base_url(); ?>patient/delete/<?php echo $value->id; ?>" class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i> <?=$lang['btn_remove']?></a>
            </td>
          </tr>
          <?php
          }
        ?>

      </tbody>
      <tfoot>
      <?=$links?>
      </tfoot>
    </table>

  </div>
</div>

