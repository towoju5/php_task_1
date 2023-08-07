    </div>
</div>
<?php if (!$layout_clean_mode) { ?>
<div class="modal fade" id="mkd-media-gallery" tabindex="-1" role="dialog" aria-labelledby="media-gallery" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="media-gallery">Media Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid" id="mkd-media-gallery-container" style="height: 500px;overflow-y: scroll;">
            <div class="row" id="mkd-media-gallery-wrapper">
                <?php
                  if(!empty($images)) { ?>
                     <?php foreach($images as $value) {
                    ?>
                      <div class="col-md-3 mb-3">
                      <img class="img-fluid mkd-gallery-image-image" src="<?php echo $value->url; ?>" value="<?php echo $value->url; ?>" alt="<?php echo $value->caption; ?>">
                      </div>

                <?php } ?>

                <?php }
                ?>
            </div>
            <div class="text-center" id="mkd-load-more-container">
                <button class="btn btn-primary" id="mkd-load-more">Load More</button>
            </div>
          </div>
        <div class="container-fluid" id="mkd-media-upload-container">
            <div class="row" id="mkd-media-upload-wrapper">
              <div class="mkd-upload-btn-wrapper">
                <button class="mkd-upload-btn">Upload a file</button>
                <input type="file" name="imagefile" onchange="onFileSelected(event)"/>
              </div>
            </div>
        </div>
        <div class="container-fluid" id="mkd-media-crop-container">
            <div class="row" id="mkd-media-crop-wrapper">
              <div id="mkd-crop-upload-container-wrapper">
                <div id="mkd-crop-upload-container">
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer mkd-media-panel-1">
          <button type="button" class="btn btn-primary" id="mkd-media-upload">Upload</button>
          <button type="button" class="btn btn-dark" id="mkd-media-choose">Choose</button>
          <button type="button" class="btn btn-warning mkd-close-modal" data-dismiss="modal">Close</button>
        </div>
        <div class="modal-footer mkd-media-panel-2">
          <button type="button" class="btn btn-warning mkd-close-modal" data-dismiss="modal">Close</button>
        </div>
        <div class="modal-footer mkd-media-panel-3">
          <button type="button" class="btn btn-primary js-crop" id="mkd-media-crop">Crop & Upload</button>
          <button type="button" class="btn btn-warning mkd-close-modal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade " id="mkd-csv-import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document" style='min-height:50vh;'>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style='max-height: 300px; overflow-y:scroll;'>
          <form action="/v1/api/preview_csv/" enctype='multipart/form-data' id='import-csv'>
              <input type="file" name='file' class='d-none' id='csv-file'  accept=".csv,.xlsx,.xlsm,.xls">
              <a href="#" class='btn btn-primary' id='btn-choose-csv'>Choose file</a>
          </form>
          <table id='csv-table' class='table-responsive d-none table-bordered' style='width:100%;'>
              <thead id='csv-table-head'></thead>
              <tbody id='csv-table-body'></tbody>
          </table>
      </div>
      <div class="modal-footer">
          <a href="#" id='btn-save-csv' class='btn btn-primary d-none' >Save Data</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-image-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body justify-content-center p1 text-center">
          <img id='modal-image-slot' src="" alt="">
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php if(isset($gallery_images))
{?>
<div id="image_gallery" data-image_url_field="" data-image_id_field="" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="image_gallery" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 1395px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-9">
        <table id="image_table_view" class="datatable" width="100%" style="zoom: 90%;">
            <thead class=''>
                <tr>
                    <td>URL</td>
                    <td>Width</td>
                    <td>Height</td>
                    <td>Image Type</td>
                    <td>Created at</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gallery_images as $key => $image) { ?>
                    <tr class="image-row" data-image_id='<?php echo $image->id ?>' data-image_url='<?php echo $image->url ?>' style="cursor: pointer;" title="View Image">
                        <td><?php echo $image->show_url ?></td>
                        <td><?php echo $image->width ?></td>
                        <td><?php echo $image->height ?></td>
                        <td><?php echo $image->type ?></td>
                        <td><?php echo $image->created_at ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <div class="col-md-3">
            <h5 style="text-align: center;">Image Viewer</h5>
            <hr>
            <img id="image_viewer" src="" style="max-width: 150px;margin-left: 89px;">
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="select_image">Select Image</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


<script src="/assets/js/select2.js"></script>
<script src="/assets/js/vendor_full.js"></script>
<script src="/assets/js/core.js"></script>
<script src="/assets/js/image_gallery.js"></script> 
<script src="/assets/js/custom_select2.js" ></script>
<!-- Our JS -->

</body>

</html>