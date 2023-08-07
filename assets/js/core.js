/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
var mkd_events = (function () {
  var topics = {};
  var hOP = topics.hasOwnProperty;

  return {
    subscribe: function (topic, listener) {
      // Create the topic's object if not yet created
      if (!hOP.call(topics, topic)) topics[topic] = [];

      // Add the listener to queue
      var index = topics[topic].push(listener) - 1;

      // Provide handle back for removal of topic
      return {
        remove: function () {
          delete topics[topic][index];
        }
      };
    },
    publish: function (topic, info) {
      // If the topic doesn't exist, or there's no listeners in queue, just leave
      if (!hOP.call(topics, topic)) return;

      // Cycle through topics queue, fire!
      topics[topic].forEach(function (item) {
        item(info != undefined ? info : {});
      });
    }
  };
})();

let image_id_uppload_library = '';
let image_url_uppload_library = '';

jQuery(document).ready(function () {
  jQuery("#sidebarCollapse").on("click", function () {
    jQuery("#sidebar").toggleClass("active");
  });

  //import csv code
  jQuery("#btn-choose-csv").click(function (e) {
    e.preventDefault();
    jQuery("#csv-file").trigger("click");
  });

  jQuery("#csv-file").change(function () {
    jQuery("#import-csv").trigger("submit");
  });

  jQuery("#import-csv").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var url = jQuery(this).attr("action");
    jQuery(this).addClass("d-none");

    jQuery.ajax({
      url: url,
      type: "POST",
      data: formData,
      success: function (res) {
        var html = "";
        if (res.preview == true) {
          var data = res.data;
          for (var i = 0; i < data.length; i++) {
            html += "<tr>";
            for (var x = 0; x < data[i].length; x++) {
              html += "<td>" + data[i][x] + "</td>";
            }
            html += "</tr>";
          }
          jQuery("#csv-table-body").html(html);
          jQuery("#csv-table").removeClass("d-none");
          jQuery("#btn-save-csv").removeClass("d-none");
        }
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  });

  jQuery("#btn-save-csv").click(function (e) {
    e.preventDefault();
    var model = jQuery("#btn-csv-upload-dialog").data("model");
    jQuery("#import-csv").attr("action", "/v1/api/file/import/" + model);
    jQuery("#import-csv").trigger("submit");
  });

  jQuery(".modal-image").click(function () {
    var src = jQuery(this).attr("src");
    jQuery("#modal-image-slot").attr("src", src);
    jQuery("#modal-image-show").modal("show");
  });

  var page = 0;
  var num_page = 0;
  var image_selected = "";
  var field = "";
  // ====== Assets ===========
  window.asset_page = 0;
  window.asset_num_page = 0;
  window.asset_per_page = 0;
  window.asset_num_item = 0;
  window.asset_selected_id = 0;
  window.asset_selected_img = "";

  // ====== CROPPING ===========
  window.crop_object = null;
  window.crop_width = 500;
  window.crop_height = 500;
  window.crop_boundary_width = 500;
  window.crop_boundary_height = 500;
  window.crop_output_image = "output_image";
  window.crop_image_id = 0;
  window.crop_image_url = "";


  jQuery(".mkd-close-modal").click(function () {
    jQuery("#mkd-media-gallery-wrapper").html("");

    window.asset_page = 0;
    window.asset_num_page = 0;
    window.asset_per_page = 0;
    window.asset_num_item = 0;
    window.asset_selected_id = 0;
    window.asset_selected_img = "";

    if (window.crop_object) {
      window.crop_object.destroy();
    }
    window.crop_object = null;
    window.crop_width = 500;
    window.crop_height = 500;
    window.crop_boundary_width = 500;
    window.crop_boundary_height = 500;
    window.crop_output_image = "output_image";
    window.crop_image_id = 0;
    window.crop_image_url = "";
  });
  jQuery("#mkd-media-choose").click(function () {
    if (window.asset_selected_id != 0) {
      jQuery("#" + window.crop_image_id).val(window.asset_selected_id);
      jQuery("#" + window.crop_image_url).val(window.asset_selected_img);
      jQuery("#" + window.crop_output_image).attr("src", window.asset_selected_img);
      jQuery("#mkd-media-gallery").modal("hide");
      jQuery("#mkd-media-upload-container").hide();
      jQuery("#mkd-media-crop-container").hide();
      jQuery("#mkd-media-gallery-container").show();
      jQuery(".mkd-media-panel-1").show();
      jQuery(".mkd-media-panel-2").hide();
      jQuery(".mkd-media-panel-3").hide();
      jQuery("#mkd-media-gallery-wrapper").html("");

      window.asset_page = 0;
      window.asset_num_page = 0;
      window.asset_per_page = 0;
      window.asset_num_item = 0;
      window.asset_selected_id = 0;
      window.asset_selected_img = "";

      window.crop_object = null;
      window.crop_width = 500;
      window.crop_height = 500;
      window.crop_boundary_width = 500;
      window.crop_boundary_height = 500;
      window.crop_output_image = "output_image";
      window.crop_image_id = 0;
      window.crop_image_url = "";
    }
  });
  jQuery("#mkd-load-more").click(function () {
    if (window.asset_page + window.asset_per_page >= window.asset_num_item) {
      jQuery("#mkd-load-more-container").hide();
    }
    jQuery.ajax({
      type: "GET",
      url: "/v1/api/assets/" + window.asset_page
    }).done(function (result) {
      window.asset_page = result.page;
      window.asset_num_page = result.num_page;
      window.asset_num_item = result.num_item;
      window.asset_per_page = result.per_page;
      var items = result.item;
      for (var i = 0; i < items.length; i++) {
        var element = items[i];
        jQuery("#mkd-media-gallery-wrapper").append(
          '<div class="col-md-3 mb-3"><img data-id="' +
          element.id +
          '"src="' +
          element.url +
          '" alt="" class="img-fluid mkd-gallery-image-image"></div>'
        );
      }

      if (window.asset_page + window.asset_per_page >= window.asset_num_item) {
        jQuery("#mkd-load-more-container").hide();
      }
      window.asset_page = window.asset_page + window.asset_per_page;
      jQuery(".mkd-gallery-image-image").click(function () {
        var id = Number(jQuery(this).attr("data-id"));
        jQuery(this).addClass("active");
        window.asset_selected_id = id;
        window.asset_selected_img = jQuery(this).attr("src");
      });
    });
  });

  jQuery(".mkd-choose-image").click(function () {
    var view_width = Number(jQuery(this).attr("data-view-width"));
    var view_height = Number(jQuery(this).attr("data-view-height"));
    var boundary_width = Number(jQuery(this).attr("data-boundary-width"));
    var boundary_height = Number(jQuery(this).attr("data-boundary-height"));
    var image_preview = jQuery(this).attr("data-image-preview");
    var image_id = jQuery(this).attr("data-image-id");
    var image_url = jQuery(this).attr("data-image-url");
    window.crop_output_image = image_preview;
    window.crop_image_id = image_id;
    window.crop_image_url = image_url;

    if (Number.isInteger(view_width)) {
      window.crop_width = Number(view_width);
    }
    if (Number.isInteger(view_height)) {
      window.crop_height = Number(view_height);
    }
    if (Number.isInteger(boundary_width)) {
      window.crop_boundary_width = Number(boundary_width);
    }
    if (Number.isInteger(boundary_height)) {
      window.crop_boundary_height = Number(boundary_height);
    }
    jQuery("#mkd-media-gallery").modal("show");
    jQuery("#mkd-load-more-container").show();

    jQuery.ajax({
      type: "GET",
      url: "/v1/api/assets/0"
    }).done(function (result) {
      window.asset_page = result.page;
      window.asset_num_page = result.num_page;
      window.asset_num_item = result.num_item;
      window.asset_per_page = result.per_page;
      var items = result.item;
      for (var i = 0; i < items.length; i++) {
        var element = items[i];
        jQuery("#mkd-media-gallery-wrapper").append(
          '<div class="col-md-3 mb-3"><img data-id="' +
          element.id +
          '"src="' +
          element.url +
          '" alt="" class="img-fluid mkd-gallery-image-image"></div>'
        );
      }

      if (result.page + result.per_page >= result.num_item) {
        jQuery("#mkd-load-more-container").hide();
      }

      window.asset_page = window.asset_page + window.asset_per_page;

      jQuery(".mkd-gallery-image-image").click(function () {
        var id = Number(jQuery(this).attr("data-id"));
        jQuery(this).addClass("active");
        window.asset_selected_id = id;
        window.asset_selected_img = jQuery(this).attr("src");
      });
    });
  });

  jQuery("#mkd-media-upload").click(function () {
    jQuery("#mkd-media-gallery-container").hide();
    jQuery(".mkd-media-panel-1").hide();
    jQuery(".mkd-media-panel-3").hide();
    jQuery("#mkd-media-upload-container").show();
    jQuery(".mkd-media-panel-2").show();
  });

  mkd_events.subscribe("crop_image", function (e) {
    jQuery("#mkd-media-upload-container").hide();
    jQuery("#mkd-media-crop-container").show();
    jQuery(".mkd-media-panel-1").hide();
    jQuery(".mkd-media-panel-2").hide();
    jQuery(".mkd-media-panel-3").show();

    var el = document.getElementById("mkd-crop-upload-container");
    window.crop_object = new Croppie(el, {
      enableExif: true,
      viewport: {
        width: window.crop_width,
        height: window.crop_height
      },
      boundary: {
        width: window.crop_boundary_width,
        height: window.crop_boundary_height
      }
    });

    window.crop_object.bind({
      url: e.url
    });

    jQuery("#mkd-media-crop").click(function () {
      window.crop_object
        .result({
          type: "base64",
          format: "png"
        })
        .then(function (base64) {
          jQuery.ajax({
            type: "POST",
            url: "/v1/api/image/upload",
            data: {
              image: base64
            }
          })
            .done(function (result) {
              mkd_events.publish("image_uploaded", result);
            })
            .fail(function (jqXHR, textStatus) {
              alert("Image Upload Failed");
              console.log(jqXHR)
            });
        });
    });
  });

  mkd_events.subscribe("file_upload", function (e) {
    var formData = new FormData();
    formData.append("file", e.url, "file");
    jQuery.ajax({
      url: "/v1/api/file/upload",
      type: "post",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function (data) {
        jQuery("#" + e.id).val(data.file);
        jQuery("#" + e.id + "_id").val(data.id);
        jQuery("#" + e.id + "_text").html(data.file);
      }
    });
  });

  mkd_events.subscribe("image_uploaded", function (e) {
    jQuery("#mkd-media-gallery").modal("hide");
    jQuery("#mkd-media-upload-container").hide();
    jQuery("#mkd-media-crop-container").hide();
    jQuery("#mkd-media-gallery-container").show();
    jQuery(".mkd-media-panel-1").show();
    jQuery(".mkd-media-panel-2").hide();
    jQuery(".mkd-media-panel-3").hide();
    jQuery("#" + window.crop_output_image).attr("src", e.image);
    jQuery("#" + window.crop_image_id).val(e.id);
    jQuery("#" + window.crop_image_url).val(e.image);
    jQuery("#mkd-media-gallery-wrapper").html("");

    window.asset_page = 0;
    window.asset_num_page = 0;
    window.asset_num_item = 0;
    window.asset_selected_id = 0;
    window.asset_selected_img = "";

    if (window.crop_object) {
      window.crop_object.destroy();
    }
    window.crop_object = null;
    window.crop_width = 500;
    window.crop_height = 500;
    window.crop_boundary_width = 500;
    window.crop_boundary_height = 500;
    window.crop_output_image = "output_image";
    window.crop_image_id = 0;
    window.crop_image_url = "";
  });

  mkd_events.subscribe("file_import", function (e) {
    var formData = new FormData();
    formData.append("file", e.url, "file");
    jQuery.ajax({
      url: "/v1/api/file/import/" + e.model,
      type: "post",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function (data) {
        alert("Imported Data successfully");
      },
      error: function (error) {
        alert("Error: " + error.responseJSON.message);
      }
    });
  });
  //Spreadsheet ==================
  jQuery("#Spreadsheet_update").submit(function (e) {
    e.preventDefault();
    var id = jQuery("#spreadsheet_id").val();
    var sheet_data = luckysheet.getAllSheets();
    jQuery.ajax({
      type: "POST",
      url: "/v1/api/update_sheet/" + id,
      data: JSON.stringify(sheet_data),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (result) {
        location.replace("/admin/spreadsheet/0");
      },
      error: function (error) {

        location.replace("/admin/spreadsheet/0");
      }
    });
  });
  //Marketing Site
  /**
   *
   * Marketing js function to generate slug
   */
  jQuery(document).on('keyup , paste', '.generate_slug_marketing', function (e) {
    e.preventDefault();
    var title = jQuery(this).val();
    if (title.length > 0) {
      jQuery.ajax({
        url: '/v1/api/get_marketing_slug/' + title,
        timeout: 30000,
        method: 'POST',
        dataType: 'JSON',
        success: function (response) {
          if (response.slug) {
            jQuery('#form_slug_marketing').val(response.slug);
          }

          if (response.error) {
            alert('Something went wrong!');
          }
        },
        error: function () {
          // alert('Connection time out!');
        }
      });
    }
  });
  //SUNEDITOR
  /**
 * Sun editor code
 */

  if (document.getElementsByClassName('sun-editor-component').length > 0) {
    var sun_editor_list = document.getElementsByClassName('sun-editor-component');
    for (let i = 0; i < sun_editor_list.length; i++) {
      var editor_data = SUNEDITOR.create((document.getElementById(sun_editor_list[i].id) || 'sun-editor'), {
        "buttonList": [
          [
            "undo",
            "redo",
            "font",
            "fontSize",
            "formatBlock",
            "paragraphStyle",
            "blockquote",
            "bold",
            "underline",
            "italic",
            "strike",
            "subscript",
            "superscript",
            "fontColor",
            "hiliteColor",
            "textStyle",
            "removeFormat",
            "outdent",
            "indent",
            "align",
            "horizontalRule",
            "list",
            "lineHeight",
            "table",
            "link",
            "image",
            "video",
            "audio",
            "imageGallery",
            "fullScreen",
            "showBlocks",
            "codeView",
            "preview",
            "print",
            "save",
            "template"
          ]
        ],
        height: '800px'
      });
      jQuery(window).click(function () {
        document.getElementById(sun_editor_list[i].id).value = editor_data.getContents();
      });
    }

  }

  //per pages
  jQuery('#change_per_page').change(function () {
    per_page = jQuery('#change_per_page').val();
    jQuery('#form_per_page').val(per_page);
    var url = new URL(window.location.href);
    var url_sort = jQuery(this).attr('data-sorturl');
    url.pathname = url_sort;
    url.searchParams.set('per_page_sort', per_page);
    window.location.href = url.href;
  });
  //uppload
    var picture = new window.uppload_Uppload({
        call: ".uppload-button",
        bind: ".uppload-image",
        lang: window.uppload_en,
        uploader: window.uppload_fetchUploader({
            endpoint: "/v1/api/file/upload",
            responseFunction: json => 
            {
                jQuery("#" + image_url_uppload_library).val(json.file);
                jQuery("#" + image_url_uppload_library + "_id").val(json.id);
                jQuery("#" + image_url_uppload_library + "_text").html(json.file);
                jQuery("#" + image_url_uppload_library + "_complete").text("Upload Complete");
                jQuery("#" + image_url_uppload_library + "_complete").parent().find('.edit-preview-image').attr('src', json.file);
                jQuery("#" + image_url_uppload_library + "_complete").parent().find('.img-delete-close').remove();
                jQuery("#" + image_url_uppload_library + "_complete").parent().find('label').after('<span class="img-delete-close"><i class="fa fa-trash img-wrapper-delete-close"></i></span>');
            }
        })
    });

    jQuery(document).on('click', '.image_id_uppload_library', function () {
        image_id_uppload_library = jQuery(this).attr('data-image-id');
        image_url_uppload_library = jQuery(this).attr('data-image-url'); 
    });


    jQuery(document).on('click','.img-delete-close',function(){
        jQuery(this).parent().find('.edit-preview-image').attr('src',''); 
        jQuery(this).parent().find('.check_change_event').val(''); 
        jQuery(this).parent().find('.feature_image_complete').text(''); 
        jQuery(this).remove(); 
    });

  jQuery(document).on('click', '.media-gallery-upload', function () {

    jQuery.ajax({
      type: "POST",
      url: "/v1/api/image/get_all",
      data: {},
      success: function (response) {

      },
      error: function (response) {

      }
    })
      .done(function (result) {
        mkd_events.publish("image_uploaded", result);
      })
      .fail(function (jqXHR, textStatus) {
        alert("Image Upload Failed");
        console.log(jqXHR)
      });

  });

  picture.use([
    new window.uppload_Local(),
    new window.uppload_Camera(),
    new window.uppload_Instagram(),
    new window.uppload_Facebook(),
    new window.uppload_URL(),
    new window.uppload_Screenshot(),
    new window.uppload_Pinterest(),
    new window.uppload_Flickr(),
    new window.uppload_NineGag(),
    new window.uppload_DeviantArt(),
    new window.uppload_ArtStation(),
    new window.uppload_Twitter(),
    new window.uppload_Flipboard(),
    new window.uppload_Fotki(),
    new window.uppload_LinkedIn(),
    new window.uppload_Reddit(),
    new window.uppload_Tumblr(),
    new window.uppload_WeHeartIt(),
    new window.uppload_Crop(),
    new window.uppload_Brightness(),
    new window.uppload_Rotate(),
    new window.uppload_Flip(),
    new window.uppload_Preview(),
    new window.uppload_Blur(),
    new window.uppload_Contrast(),
    new window.uppload_Grayscale(),
    new window.uppload_HueRotate(),
    new window.uppload_Invert(),
    new window.uppload_Sepia(),
    new window.uppload_Saturate(),
  ]);
});

function onFileSelected(event) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    mkd_events.publish("crop_image", {
      url: e.target.result
    });
  };
  reader.readAsDataURL(selectedFile);
}

function onFileUploaded(event, id) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    mkd_events.publish("file_upload", {
      url: selectedFile,
      id: id
    });
  };
  reader.readAsDataURL(selectedFile);
}


function onFileImport(event, model) {
  alert(
    "Remember to have to the following in CSV: \n1.All field seperate by ;. \n2.ID is first field. \n3.All field wrap around with double quotes.\n4.1 line per row.\n5.No header row."
  );
  var selectedFile = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    mkd_events.publish("file_import", {
      url: selectedFile,
      model: model
    });
  };
  reader.readAsDataURL(selectedFile);
}

function mkd_is_number(evt, obj) {
  var charCode = evt.which ? evt.which : event.keyCode;
  var value = obj.value;
  var dotcontains = value.indexOf(".") != -1;
  if (dotcontains) {
    if (charCode == 46) {
      return false;
    }
  }
  if (charCode == 46) {
    return true;
  }
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

