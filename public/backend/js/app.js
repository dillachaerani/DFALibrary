/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/css/app.scss":
/*!********************************!*\
  !*** ./resources/css/app.scss ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

// require('./bootstrap');
// Check All Checkbox
checkall('todoAll', 'todochkbox');
$('[data-toggle="tooltip"]').tooltip();
$(function () {
  _init();
});

function _init() {
  _jsonView(); // const $setSelect2 = document.getElementsByClassName("set-select2");
  // for (let i = 0; i < $setSelect2.length; i++) {
  //     let $data = $($setSelect2[i]).data();
  //     let $id = $($setSelect2[i]).val();
  //     setSelect2($data, $id);
  // }

}

function _jsonView() {
  var $jsonView = document.getElementsByClassName("json-view");

  for (var i = 0; i < $jsonView.length; i++) {
    $jsonView[i].innerHTML = JSON.stringify($($jsonView[i]).data('json'), null, 4);
  }
} // Check all item


$(document).on('change', '.check-all-item', function (event) {
  $('.' + $(this).data('child')).prop('checked', this.checked);

  if ($(this).is(":checked")) {
    $('.' + $(this).data('child')).closest('tr').css("background-color", "#080d38");
  } else $('.' + $(this).data('child')).closest('tr').css("background-color", "#060818");
}); // Scroll on top

function _scrollOnTop() {
  $('html, body').animate({
    scrollTop: 0
  }, 'slow');
} // Convert string to slug


$(document).on('change, click, keypress', '.text-slug', function (event) {
  $(this).val(convertToSlug($(this).val()));
}); // Function convert string to slug 

function convertToSlug(Text) {
  return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
} // Unblock loading animation


function unblockUI_($timeFade, $timeout) {
  $.blockUI({
    message: '',
    fadeOut: $timeFade,
    timeout: $timeout,
    //unblock after 2 seconds
    overlayCSS: {
      backgroundColor: '#1b2024',
      opacity: 0.8,
      zIndex: 1200,
      cursor: 'wait'
    },
    css: {
      border: 0,
      color: '#fff',
      zIndex: 1201,
      padding: 0,
      backgroundColor: 'transparent'
    }
  });
} // Block UI


function blockUI_($timeFade, $loadingText) {
  $.blockUI({
    message: '<span class="text-semibold"><div id="time-loading"></div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; <div id="status-loading">' + $loadingText + '</div></span>',
    fadeIn: $timeFade,
    overlayCSS: {
      backgroundColor: '#1b2024',
      opacity: 0.8,
      zIndex: 1200,
      cursor: 'wait'
    },
    css: {
      border: 0,
      color: '#fff',
      zIndex: 1201,
      padding: 0,
      backgroundColor: 'transparent'
    }
  });
} // Select Input Direct To URL


$(".table-show-item").change(function () {
  var $data = $(this).find(":selected").data();
  window.location = $data.href;
}); // Form search on table

$(".table-form-search").submit(function (event) {
  event.preventDefault();
  var $keyword = $(this).find(':input[name=q]').val();
  var $url = new URL($(this).attr('action'));
  var $searchParams = $url.searchParams;
  $searchParams.set('q', $keyword);
  $url.search = $searchParams.toString();
  window.location = $url.toString();
}); // Bulk action on table

$(".table-bulk-action").submit(function (event) {
  event.preventDefault();
  var $el = $(this);
  var $action = $el.find(':input[name=b_action]').find(":selected").data();
  var $data = [];
  var selected_params = "";
  var i = 0;
  $('.' + $el.data('child') + ':checkbox:checked').each(function () {
    $data.push($(this).val());

    if ($action.redirect) {
      selected_params += 'id[]=' + $(this).val();
      if (i != $('.' + $el.data('child') + ':checkbox:checked').length - 1) selected_params += '&';
      i++;
    }
  });

  if ($data.length > 0) {
    if ($action.redirect) {
      if ($action.url.includes("?")) return window.open($action.url + '&' + encodeURI(selected_params), '_blank');else return window.open($action.url + '?' + encodeURI(selected_params), '_blank');
    }

    var $msg = $data.length + ' ' + $action.alert;
    swal({
      title: $action.alert_title,
      text: $msg,
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel',
      padding: '2em'
    }).then(function (result) {
      if (result.value) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        blockUI_(800, $action.loading_text);
        $.ajax({
          type: "POST",
          url: $action.url,
          data: {
            id: $data
          }
        }).done(function (data) {
          if (data.success && data.data) {
            unblockUI_(100, 500);
            location.reload();
          } else if (data.data) {
            unblockUI_(100, 500);
            location.reload();
          } else {
            unblockUI_(100, 500);
            location.reload();
          }
        }).fail(function (data) {
          unblockUI_(100, 300);
          swal({
            title: 'Failed!',
            text: 'Data failed to process',
            type: 'error',
            padding: '2em'
          });
        });
      }
    });
  } else {
    swal({
      title: 'Failed!',
      text: 'No data selected',
      type: 'error',
      padding: '2em'
    });
  }
}); // Sweet alert confirm

function _confirmActionSA($title, $msg, $action) {
  swal({
    title: $title,
    text: $msg,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
    padding: '2em'
  }).then(function (result) {
    if (result.value) {
      blockUI_(800, "Processing ...");
      document.getElementById($action).submit();
    }
  });
} // Form confirmation


$(document).on('click', '.btn-js-confirm', function (event) {
  event.preventDefault();
  var $data = $(this).data();

  _confirmActionSA($data.alert_title, $data.alert_msg, $data.action);
});
$(document).on('click', '.btn-js-confirm-get', function (event) {
  event.preventDefault();
  var $el = $(this);
  var $data = $(this).data();
  swal({
    title: $data.alert_title,
    text: $data.alert_msg,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
    padding: '2em'
  }).then(function (result) {
    if (result.value) {
      blockUI_(800, "Processing ...");
      window.location = $el.attr('href');
    }
  });
});
$(document).on('click', '.remove-dropify', function (event) {
  event.preventDefault();
  var $el = $(this);
  var $data = $(this).data();
  swal({
    title: $data.alert_title,
    text: $data.alert_msg,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
    padding: '2em'
  }).then(function (result) {
    if (result.value) {
      blockUI_(800, "Processing ...");
      $.get($el.attr('href'), function (response) {
        unblockUI_(100, 500);

        if (response.success) {
          var drEvent = $("#" + $data.input_id).dropify();
          drEvent = drEvent.data('dropify');
          drEvent.resetPreview();
          swal({
            title: 'Success!',
            text: response.message,
            type: 'success',
            padding: '2em'
          });
          $("#" + $data.action_id).remove();
        } else {
          swal({
            title: 'Failed!',
            text: response.message,
            type: 'error',
            padding: '2em'
          });
        }
      }).fail(function () {
        unblockUI_(100, 500);
        swal({
          title: 'Oops...',
          text: 'Something went wrong!',
          type: 'error',
          padding: '2em'
        });
      });
    }
  });
});
$(".form-set-permissions").submit(function (event) {
  event.preventDefault();
  var $el = $(this);
  var $data = [];
  $('.' + $el.data('child') + ':checkbox:checked').each(function () {
    $data.push($(this).val());
  });

  if ($data.length > 0) {
    var $msg = $data.length + ' ' + $el.data('alert');
    swal({
      title: $el.data('alert_title'),
      text: $msg,
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel',
      padding: '2em'
    }).then(function (result) {
      if (result.value) {
        console.log($el.attr('action'));
        blockUI_(800, $el.data('loading-text'));
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: $el.attr('action'),
          data: {
            id: $data
          }
        }).done(function (data) {
          console.log(data);

          if (data.success && data.data) {
            unblockUI_(100, 500);
            location.reload();
          } else if (data.data) {
            unblockUI_(100, 500);
            location.reload();
          } else {
            unblockUI_(100, 100);
            swal({
              title: 'Failed!',
              text: 'Permission failed to grant',
              type: 'error',
              padding: '2em'
            });
          }
        }).fail(function (data) {
          unblockUI_(100, 300);
          swal({
            title: 'Failed!',
            text: 'Permission failed to grant',
            type: 'error',
            padding: '2em'
          });
        });
      }
    });
  } else {
    swal({
      title: 'Failed!',
      text: 'No data selected',
      type: 'error',
      padding: '2em'
    });
  }
}); // Validate Upload Image

$(".upload-image-validate").change(function () {
  var file = this.files[0];
  var extension = file.name.substr(file.name.lastIndexOf('.') + 1);
  var file_size = Math.round(file.size / 1024);
  var filesize_max = $(this).data('filesize_max');

  if (file_size > filesize_max) {
    Swal.fire('Failed', 'Size file max ' + filesize_max + 'KB', 'error');
    $(this).val("");
  } else {
    var require_extention = ['jpg', 'jpeg', 'png'];

    if (!require_extention.includes(extension)) {
      Swal.fire('Failed', 'Type file must ' + require_extention.join(', '), 'error');
      $(this).val("");
    }
  }
});
$(".dropify-validate-custom").change(function () {
  var file = this.files[0];
  var extension = file.name.substr(file.name.lastIndexOf('.') + 1);
  var file_size = Math.round(file.size / 1024);
  var upload_filesize_max = $(this).data('upload_filesize_max');
  var upload_extention = $(this).data('upload_extention');

  if (file_size > upload_filesize_max) {
    Swal.fire('Failed', 'Size file max ' + upload_filesize_max + 'KB', 'error');
    $(this).val("");
  } else {
    var require_extention = upload_extention.split(",");

    if (!require_extention.includes(extension)) {
      Swal.fire('Failed', 'Format file must ' + require_extention.join(', '), 'error');
      $(this).val("");
    }
  }
});
$(".image-preview-validate-custom").change(function () {
  var file = this.files[0];
  var extension = file.name.substr(file.name.lastIndexOf('.') + 1);
  var file_size = Math.round(file.size / 1024);
  var upload_filesize_max = $(this).data('upload_filesize_max');
  var upload_extention = $(this).data('upload_extention');

  if (file_size > upload_filesize_max) {
    Swal.fire('Failed', 'Size file max ' + upload_filesize_max + 'KB', 'error');
    $(this).val("");
    new FileUploadWithPreview($(this).data('upload_id'));
  } else {
    var require_extention = upload_extention.split(",");

    if (!require_extention.includes(extension)) {
      Swal.fire('Failed', 'Type file must ' + require_extention.join(', '), 'error');
      $(this).val("");
      new FileUploadWithPreview($(this).data('upload_id'));
    }
  }
}); // Validate Upload Excel

$(".upload-excel-validate").change(function () {
  var file = this.files[0];
  var extension = file.name.substr(file.name.lastIndexOf('.') + 1);
  var file_size = Math.round(file.size / 1024);
  var filesize_max = $(this).data('filesize_max');

  if (file_size > filesize_max) {
    Swal.fire('Failed', 'Size file max ' + filesize_max + 'KB', 'error');
    $(this).val("");
  } else {
    var require_extention = ['xlsx', 'xls'];

    if (!require_extention.includes(extension)) {
      Swal.fire('Failed', 'Type file must ' + require_extention.join(', '), 'error');
      $(this).val("");
    }
  }
});
$(".table-config-trash").change(function () {
  var is_trash;
  var $data = $(this).data();

  if ($(this).is(":checked")) {
    is_trash = 1;
  } else is_trash = 0;

  blockUI_(800, "Processing ...");
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: "POST",
    url: $data.href,
    data: {
      'key': $data.key,
      'is_trash': is_trash
    }
  }).done(function (data) {
    if (data.success) {
      unblockUI_(100, 100);
      location.reload();
    }
  }).fail(function (data) {
    unblockUI_(100, 100);
    swal({
      title: 'Failed!',
      text: 'Data failed to process',
      type: 'error',
      padding: '2em'
    });
  });
});

function _blockUI($timeFade, $loadingText) {
  var $area = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

  if ($area) {
    $area.block({
      message: '<span class="text-semibold"><div id="time-loading"></div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; <div id="status-loading">' + $loadingText + '</div></span>',
      fadeIn: $timeFade,
      overlayCSS: {
        backgroundColor: '#1b2024',
        opacity: 0.8,
        cursor: 'wait'
      },
      css: {
        margin: 0,
        width: '100%',
        border: 0,
        color: '#fff',
        backgroundColor: '#transparent'
      }
    });
  } else {
    $.blockUI({
      message: '<span class="text-semibold"><div id="time-loading"></div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; <div id="status-loading">' + $loadingText + '</div></span>',
      fadeIn: $timeFade,
      overlayCSS: {
        backgroundColor: '#1b2024',
        opacity: 0.8,
        zIndex: 1200,
        cursor: 'wait'
      },
      css: {
        border: 0,
        color: '#fff',
        zIndex: 1201,
        padding: 0,
        backgroundColor: 'transparent'
      }
    });
  }
}

function _unblockUI($timeFade, $timeout) {
  var $area = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

  if ($area) {
    $area.block({
      message: '',
      fadeOut: $timeFade,
      timeout: $timeout,
      //unblock after 2 seconds
      overlayCSS: {
        backgroundColor: '#1b2024',
        opacity: 0.8,
        cursor: 'wait'
      },
      css: {
        margin: 0,
        width: '100%',
        border: 0,
        color: '#fff',
        backgroundColor: '#transparent'
      }
    });
  } else {
    $.blockUI({
      message: '',
      fadeOut: $timeFade,
      timeout: $timeout,
      //unblock after 2 seconds
      overlayCSS: {
        backgroundColor: '#1b2024',
        opacity: 0.8,
        zIndex: 1200,
        cursor: 'wait'
      },
      css: {
        border: 0,
        color: '#fff',
        zIndex: 1201,
        padding: 0,
        backgroundColor: 'transparent'
      }
    });
  }
}

jQuery.fn.single_double_click = function (single_click_callback, double_click_callback, timeout) {
  return this.each(function () {
    var clicks = 0,
        self = this;
    jQuery(this).click(function (event) {
      clicks++;

      if (clicks == 1) {
        setTimeout(function () {
          if (clicks == 1) {
            single_click_callback.call(self, event);
          } else {
            double_click_callback.call(self, event);
          }

          clicks = 0;
        }, timeout || 300);
      }
    });
  });
};

$("tr.tr-show").find('td:not(.td-disable)').single_double_click(function () {
  var $data = $(this).parent().data();

  if ($data.href) {
    var $modal = $($data.target);

    _blockUI(800, 'Processing', $modal.find('.modal-content'));

    $.ajax({
      url: $data.href,
      dataType: 'html',
      success: function success(result) {
        _unblockUI(100, 500, $modal.find('.modal-content'));

        $modal.find('.modal-content').html(result);
        $modal.modal('show');
        feather.replace();

        _jsonView();
      }
    });
  }
}, function () {
  var $data = $(this).parent().data();

  if ($data.href) {
    if ($data.new_tab == true) window.open($data.href);else window.location = $data.href;
  }
});
$(".show-modal-custom").click(function () {
  var $data = $(this).data();

  if ($data.href) {
    var $modal = $($data.target);

    _blockUI(800, 'Processing', $modal.find('.modal-content'));

    $.ajax({
      url: $data.href,
      dataType: 'html',
      success: function success(result) {
        _unblockUI(100, 500, $modal.find('.modal-content'));

        $modal.find('.modal-content').html(result);
        $modal.modal('show');
        feather.replace();
      }
    });
  }
});
$(".btn-sheet-download").click(function (event) {
  event.preventDefault();
  var $el = $(this);
  var $data = $(this).data();
  swal({
    title: $data.alert_title,
    text: $data.alert_msg,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
    padding: '2em'
  }).then(function (result) {
    if (result.value) {
      blockUI_(800, "Downloading ...");
      $.get($el.attr('href'), function (response) {
        if (response.success) {
          window.open(response.data.link_download, '_blank');
          unblockUI_(100, 500);
        } else {
          unblockUI_(100, 500);
          swal({
            title: 'Failed!',
            text: response.message,
            type: 'error',
            padding: '2em'
          });
        }
      }).fail(function () {
        unblockUI_(100, 500);
        swal({
          title: 'Oops...',
          text: 'Something went wrong!',
          type: 'error',
          padding: '2em'
        });
      });
    }
  });
});
$('.table-responsive').on('show.bs.dropdown', function () {
  $('.table-responsive').css("overflow", "inherit");
  $('.table-responsive').css("overflow-x", "auto");
});
$('.table-responsive').on('hide.bs.dropdown', function () {
  $('.table-responsive').css("overflow", "auto");
});
$(".checkbox-tr").change(function () {
  if ($(this).is(":checked")) {
    $(this).closest('tr').css("background-color", "#080d38");
  } else $(this).closest('tr').css("background-color", "#060818");
});
$(".btn-view-image").click(function () {
  var $file = $(this).data('file');
  var $file_original = $(this).data('file_original');
  var $filename = $(this).data('filename');
  var filename_split = $filename.split(".");
  var extension = filename_split[1];
  var require_extention = ['jpg', 'jpeg', 'png', 'ico'];
  $("#modal_view_file").empty();

  if (require_extention.includes(extension)) {
    var img = $('<img class="img-fluid" alt="' + $filename + '">');
    img.attr('src', $file);
    img.appendTo('#modal_view_file');
  }

  $(".modal_view_file_name").text($filename);
  $(".modal_view_file_link_txt").text($file_original);
  $(".modal_view_file_link").attr('href', $file_original);
  $("#modalViewFile").modal('show');
});
$(".set-select2").change(function () {
  var $data = $(this).data();
  var $id = $(this).val();
  if ($id) setSelect2($data, $id);
});

function setSelect2(data, id) {
  $.get(data.url + '/' + id, function (response) {
    if (response.success) {
      $("#" + data.target).empty().select2({
        allowClear: true,
        data: response.data,
        placeholder: data.target_placeholder
      });
    }
  }).fail(function () {
    unblockUI_(100, 500);
    swal({
      title: 'Oops...',
      text: 'Something went wrong!',
      type: 'error',
      padding: '2em'
    });
  });
}

/***/ }),

/***/ "./resources/sass/assets/apps/contacts.scss":
/*!**************************************************!*\
  !*** ./resources/sass/assets/apps/contacts.scss ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/apps/invoice.scss":
/*!*************************************************!*\
  !*** ./resources/sass/assets/apps/invoice.scss ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/apps/mailbox.scss":
/*!*************************************************!*\
  !*** ./resources/sass/assets/apps/mailbox.scss ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/apps/mailing-chat.scss":
/*!******************************************************!*\
  !*** ./resources/sass/assets/apps/mailing-chat.scss ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/apps/notes.scss":
/*!***********************************************!*\
  !*** ./resources/sass/assets/apps/notes.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/apps/scrumboard.scss":
/*!****************************************************!*\
  !*** ./resources/sass/assets/apps/scrumboard.scss ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/apps/todolist.scss":
/*!**************************************************!*\
  !*** ./resources/sass/assets/apps/todolist.scss ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/authentication/form-1.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/authentication/form-1.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/authentication/form-2.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/authentication/form-2.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/cards/card.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/components/cards/card.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-carousel.scss":
/*!***************************************************************!*\
  !*** ./resources/sass/assets/components/custom-carousel.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-countdown.scss":
/*!****************************************************************!*\
  !*** ./resources/sass/assets/components/custom-countdown.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-counter.scss":
/*!**************************************************************!*\
  !*** ./resources/sass/assets/components/custom-counter.scss ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-list-group.scss":
/*!*****************************************************************!*\
  !*** ./resources/sass/assets/components/custom-list-group.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-media_object.scss":
/*!*******************************************************************!*\
  !*** ./resources/sass/assets/components/custom-media_object.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-modal.scss":
/*!************************************************************!*\
  !*** ./resources/sass/assets/components/custom-modal.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/custom-sweetalert.scss":
/*!*****************************************************************!*\
  !*** ./resources/sass/assets/components/custom-sweetalert.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/tabs-accordian/custom-accordions.scss":
/*!********************************************************************************!*\
  !*** ./resources/sass/assets/components/tabs-accordian/custom-accordions.scss ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/tabs-accordian/custom-tabs.scss":
/*!**************************************************************************!*\
  !*** ./resources/sass/assets/components/tabs-accordian/custom-tabs.scss ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/components/timeline/custom-timeline.scss":
/*!************************************************************************!*\
  !*** ./resources/sass/assets/components/timeline/custom-timeline.scss ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/alert.scss":
/*!***************************************************!*\
  !*** ./resources/sass/assets/elements/alert.scss ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/avatar.scss":
/*!****************************************************!*\
  !*** ./resources/sass/assets/elements/avatar.scss ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/breadcrumb.scss":
/*!********************************************************!*\
  !*** ./resources/sass/assets/elements/breadcrumb.scss ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/custom-pagination.scss":
/*!***************************************************************!*\
  !*** ./resources/sass/assets/elements/custom-pagination.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/custom-tree_view.scss":
/*!**************************************************************!*\
  !*** ./resources/sass/assets/elements/custom-tree_view.scss ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/infobox.scss":
/*!*****************************************************!*\
  !*** ./resources/sass/assets/elements/infobox.scss ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/miscellaneous.scss":
/*!***********************************************************!*\
  !*** ./resources/sass/assets/elements/miscellaneous.scss ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/popover.scss":
/*!*****************************************************!*\
  !*** ./resources/sass/assets/elements/popover.scss ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/search.scss":
/*!****************************************************!*\
  !*** ./resources/sass/assets/elements/search.scss ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/elements/tooltip.scss":
/*!*****************************************************!*\
  !*** ./resources/sass/assets/elements/tooltip.scss ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/forms/bootstrap-form.scss":
/*!*********************************************************!*\
  !*** ./resources/sass/assets/forms/bootstrap-form.scss ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/forms/custom-clipboard.scss":
/*!***********************************************************!*\
  !*** ./resources/sass/assets/forms/custom-clipboard.scss ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/forms/switches.scss":
/*!***************************************************!*\
  !*** ./resources/sass/assets/forms/switches.scss ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/forms/theme-checkbox-radio.scss":
/*!***************************************************************!*\
  !*** ./resources/sass/assets/forms/theme-checkbox-radio.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/loader.scss":
/*!*******************************************!*\
  !*** ./resources/sass/assets/loader.scss ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/main.scss":
/*!*****************************************!*\
  !*** ./resources/sass/assets/main.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/coming-soon/style.scss":
/*!************************************************************!*\
  !*** ./resources/sass/assets/pages/coming-soon/style.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/contact_us.scss":
/*!*****************************************************!*\
  !*** ./resources/sass/assets/pages/contact_us.scss ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/error/style-400.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/pages/error/style-400.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/error/style-500.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/pages/error/style-500.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/error/style-503.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/pages/error/style-503.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/error/style-maintanence.scss":
/*!******************************************************************!*\
  !*** ./resources/sass/assets/pages/error/style-maintanence.scss ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/faq/faq.scss":
/*!**************************************************!*\
  !*** ./resources/sass/assets/pages/faq/faq.scss ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/faq/faq2.scss":
/*!***************************************************!*\
  !*** ./resources/sass/assets/pages/faq/faq2.scss ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/helpdesk.scss":
/*!***************************************************!*\
  !*** ./resources/sass/assets/pages/helpdesk.scss ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/pages/privacy/privacy.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/pages/privacy/privacy.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/scrollspyNav.scss":
/*!*************************************************!*\
  !*** ./resources/sass/assets/scrollspyNav.scss ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/structure.scss":
/*!**********************************************!*\
  !*** ./resources/sass/assets/structure.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/tables/table-basic.scss":
/*!*******************************************************!*\
  !*** ./resources/sass/assets/tables/table-basic.scss ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/users/account-setting.scss":
/*!**********************************************************!*\
  !*** ./resources/sass/assets/users/account-setting.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/users/user-profile.scss":
/*!*******************************************************!*\
  !*** ./resources/sass/assets/users/user-profile.scss ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/assets/widgets/modules-widgets.scss":
/*!************************************************************!*\
  !*** ./resources/sass/assets/widgets/modules-widgets.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/animate/animate.scss":
/*!*****************************************************!*\
  !*** ./resources/sass/plugins/animate/animate.scss ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/autocomplete/autocomplete.scss":
/*!***************************************************************!*\
  !*** ./resources/sass/plugins/autocomplete/autocomplete.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/bootstrap-range-Slider/bootstrap-slider.scss":
/*!*****************************************************************************!*\
  !*** ./resources/sass/plugins/bootstrap-range-Slider/bootstrap-slider.scss ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss":
/*!***************************************************************************!*\
  !*** ./resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.scss":
/*!****************************************************************************************!*\
  !*** ./resources/sass/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.scss ***!
  \****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/drag-and-drop/dragula/dragula.scss":
/*!*******************************************************************!*\
  !*** ./resources/sass/plugins/drag-and-drop/dragula/dragula.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/drag-and-drop/dragula/example.scss":
/*!*******************************************************************!*\
  !*** ./resources/sass/plugins/drag-and-drop/dragula/example.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/dropify/dropify.min.scss":
/*!*********************************************************!*\
  !*** ./resources/sass/plugins/dropify/dropify.min.scss ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/editors/markdown/simplemde.min.scss":
/*!********************************************************************!*\
  !*** ./resources/sass/plugins/editors/markdown/simplemde.min.scss ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/editors/quill/quill.bubble.scss":
/*!****************************************************************!*\
  !*** ./resources/sass/plugins/editors/quill/quill.bubble.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/editors/quill/quill.snow.scss":
/*!**************************************************************!*\
  !*** ./resources/sass/plugins/editors/quill/quill.snow.scss ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/file-upload/file-upload-with-preview.min.scss":
/*!******************************************************************************!*\
  !*** ./resources/sass/plugins/file-upload/file-upload-with-preview.min.scss ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/flatpickr/custom-flatpickr.scss":
/*!****************************************************************!*\
  !*** ./resources/sass/plugins/flatpickr/custom-flatpickr.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/fullcalendar/custom-fullcalendar.advance.scss":
/*!******************************************************************************!*\
  !*** ./resources/sass/plugins/fullcalendar/custom-fullcalendar.advance.scss ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/fullcalendar/fullcalendar.min.scss":
/*!*******************************************************************!*\
  !*** ./resources/sass/plugins/fullcalendar/fullcalendar.min.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/fullcalendar/fullcalendar.scss":
/*!***************************************************************!*\
  !*** ./resources/sass/plugins/fullcalendar/fullcalendar.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/jquery-step/jquery.steps.scss":
/*!**************************************************************!*\
  !*** ./resources/sass/plugins/jquery-step/jquery.steps.scss ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/jvector/jquery-jvectormap-2.0.3.scss":
/*!*********************************************************************!*\
  !*** ./resources/sass/plugins/jvector/jquery-jvectormap-2.0.3.scss ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/lightbox/custom-photswipe.scss":
/*!***************************************************************!*\
  !*** ./resources/sass/plugins/lightbox/custom-photswipe.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/lightbox/photoswipe.scss":
/*!*********************************************************!*\
  !*** ./resources/sass/plugins/lightbox/photoswipe.scss ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/loaders/custom-loader.scss":
/*!***********************************************************!*\
  !*** ./resources/sass/plugins/loaders/custom-loader.scss ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/noUiSlider/custom-nouiSlider.scss":
/*!******************************************************************!*\
  !*** ./resources/sass/plugins/noUiSlider/custom-nouiSlider.scss ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/perfect-scrollbar/perfect-scrollbar.scss":
/*!*************************************************************************!*\
  !*** ./resources/sass/plugins/perfect-scrollbar/perfect-scrollbar.scss ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/pricing-table/css/component.scss":
/*!*****************************************************************!*\
  !*** ./resources/sass/plugins/pricing-table/css/component.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/select2/select2.min.scss":
/*!*********************************************************!*\
  !*** ./resources/sass/plugins/select2/select2.min.scss ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/sweetalerts/sweetalert.scss":
/*!************************************************************!*\
  !*** ./resources/sass/plugins/sweetalerts/sweetalert.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/sweetalerts/sweetalert2.min.scss":
/*!*****************************************************************!*\
  !*** ./resources/sass/plugins/sweetalerts/sweetalert2.min.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/custom_dt_custom.scss":
/*!**********************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/custom_dt_custom.scss ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/custom_dt_html5.scss":
/*!*********************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/custom_dt_html5.scss ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/custom_dt_miscellaneous.scss":
/*!*****************************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/custom_dt_miscellaneous.scss ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/custom_dt_multiple_tables.scss":
/*!*******************************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/custom_dt_multiple_tables.scss ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/datatables-light.scss":
/*!**********************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/datatables-light.scss ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/datatables.scss":
/*!****************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/datatables.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/dt-global_style-light.scss":
/*!***************************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/dt-global_style-light.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/table/datatable/dt-global_style.scss":
/*!*********************************************************************!*\
  !*** ./resources/sass/plugins/table/datatable/dt-global_style.scss ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/plugins/tagInput/tags-input.scss":
/*!*********************************************************!*\
  !*** ./resources/sass/plugins/tagInput/tags-input.scss ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/assets/structure.scss ./resources/sass/assets/loader.scss ./resources/sass/assets/main.scss ./resources/sass/assets/scrollspyNav.scss ./resources/sass/assets/apps/contacts.scss ./resources/sass/assets/apps/invoice.scss ./resources/sass/assets/apps/mailbox.scss ./resources/sass/assets/apps/mailing-chat.scss ./resources/sass/assets/apps/notes.scss ./resources/sass/assets/apps/scrumboard.scss ./resources/sass/assets/apps/todolist.scss ./resources/sass/assets/authentication/form-1.scss ./resources/sass/assets/authentication/form-2.scss ./resources/sass/assets/components/custom-carousel.scss ./resources/sass/assets/components/custom-countdown.scss ./resources/sass/assets/components/custom-counter.scss ./resources/sass/assets/components/custom-list-group.scss ./resources/sass/assets/components/custom-media_object.scss ./resources/sass/assets/components/custom-modal.scss ./resources/sass/assets/components/custom-sweetalert.scss ./resources/sass/assets/components/cards/card.scss ./resources/sass/assets/components/tabs-accordian/custom-accordions.scss ./resources/sass/assets/components/tabs-accordian/custom-tabs.scss ./resources/sass/assets/components/timeline/custom-timeline.scss ./resources/sass/assets/elements/alert.scss ./resources/sass/assets/elements/avatar.scss ./resources/sass/assets/elements/breadcrumb.scss ./resources/sass/assets/elements/custom-pagination.scss ./resources/sass/assets/elements/custom-tree_view.scss ./resources/sass/assets/elements/infobox.scss ./resources/sass/assets/elements/miscellaneous.scss ./resources/sass/assets/elements/popover.scss ./resources/sass/assets/elements/search.scss ./resources/sass/assets/elements/tooltip.scss ./resources/sass/assets/forms/bootstrap-form.scss ./resources/sass/assets/forms/custom-clipboard.scss ./resources/sass/assets/forms/switches.scss ./resources/sass/assets/forms/theme-checkbox-radio.scss ./resources/sass/assets/pages/coming-soon/style.scss ./resources/sass/assets/pages/error/style-400.scss ./resources/sass/assets/pages/error/style-500.scss ./resources/sass/assets/pages/error/style-503.scss ./resources/sass/assets/pages/error/style-maintanence.scss ./resources/sass/assets/pages/faq/faq.scss ./resources/sass/assets/pages/faq/faq2.scss ./resources/sass/assets/pages/privacy/privacy.scss ./resources/sass/assets/pages/contact_us.scss ./resources/sass/assets/pages/helpdesk.scss ./resources/sass/assets/tables/table-basic.scss ./resources/sass/assets/users/account-setting.scss ./resources/sass/assets/users/user-profile.scss ./resources/sass/assets/widgets/modules-widgets.scss ./resources/sass/plugins/animate/animate.scss ./resources/sass/plugins/autocomplete/autocomplete.scss ./resources/sass/plugins/bootstrap-range-Slider/bootstrap-slider.scss ./resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss ./resources/sass/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.scss ./resources/sass/plugins/drag-and-drop/dragula/dragula.scss ./resources/sass/plugins/drag-and-drop/dragula/example.scss ./resources/sass/plugins/dropify/dropify.min.scss ./resources/sass/plugins/editors/markdown/simplemde.min.scss ./resources/sass/plugins/editors/quill/quill.bubble.scss ./resources/sass/plugins/editors/quill/quill.snow.scss ./resources/sass/plugins/file-upload/file-upload-with-preview.min.scss ./resources/sass/plugins/flatpickr/custom-flatpickr.scss ./resources/sass/plugins/fullcalendar/custom-fullcalendar.advance.scss ./resources/sass/plugins/fullcalendar/fullcalendar.min.scss ./resources/sass/plugins/fullcalendar/fullcalendar.scss ./resources/sass/plugins/jquery-step/jquery.steps.scss ./resources/sass/plugins/jvector/jquery-jvectormap-2.0.3.scss ./resources/sass/plugins/lightbox/custom-photswipe.scss ./resources/sass/plugins/lightbox/photoswipe.scss ./resources/sass/plugins/loaders/custom-loader.scss ./resources/sass/plugins/noUiSlider/custom-nouiSlider.scss ./resources/sass/plugins/perfect-scrollbar/perfect-scrollbar.scss ./resources/sass/plugins/pricing-table/css/component.scss ./resources/sass/plugins/select2/select2.min.scss ./resources/sass/plugins/sweetalerts/sweetalert.scss ./resources/sass/plugins/sweetalerts/sweetalert2.min.scss ./resources/sass/plugins/table/datatable/custom_dt_custom.scss ./resources/sass/plugins/table/datatable/custom_dt_html5.scss ./resources/sass/plugins/table/datatable/custom_dt_miscellaneous.scss ./resources/sass/plugins/table/datatable/custom_dt_multiple_tables.scss ./resources/sass/plugins/table/datatable/datatables.scss ./resources/sass/plugins/table/datatable/datatables-light.scss ./resources/sass/plugins/table/datatable/dt-global_style.scss ./resources/sass/plugins/table/datatable/dt-global_style-light.scss ./resources/sass/plugins/tagInput/tags-input.scss ./resources/css/app.scss ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\structure.scss */"./resources/sass/assets/structure.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\loader.scss */"./resources/sass/assets/loader.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\main.scss */"./resources/sass/assets/main.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\scrollspyNav.scss */"./resources/sass/assets/scrollspyNav.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\contacts.scss */"./resources/sass/assets/apps/contacts.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\invoice.scss */"./resources/sass/assets/apps/invoice.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\mailbox.scss */"./resources/sass/assets/apps/mailbox.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\mailing-chat.scss */"./resources/sass/assets/apps/mailing-chat.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\notes.scss */"./resources/sass/assets/apps/notes.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\scrumboard.scss */"./resources/sass/assets/apps/scrumboard.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\apps\todolist.scss */"./resources/sass/assets/apps/todolist.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\authentication\form-1.scss */"./resources/sass/assets/authentication/form-1.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\authentication\form-2.scss */"./resources/sass/assets/authentication/form-2.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-carousel.scss */"./resources/sass/assets/components/custom-carousel.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-countdown.scss */"./resources/sass/assets/components/custom-countdown.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-counter.scss */"./resources/sass/assets/components/custom-counter.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-list-group.scss */"./resources/sass/assets/components/custom-list-group.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-media_object.scss */"./resources/sass/assets/components/custom-media_object.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-modal.scss */"./resources/sass/assets/components/custom-modal.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\custom-sweetalert.scss */"./resources/sass/assets/components/custom-sweetalert.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\cards\card.scss */"./resources/sass/assets/components/cards/card.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\tabs-accordian\custom-accordions.scss */"./resources/sass/assets/components/tabs-accordian/custom-accordions.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\tabs-accordian\custom-tabs.scss */"./resources/sass/assets/components/tabs-accordian/custom-tabs.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\components\timeline\custom-timeline.scss */"./resources/sass/assets/components/timeline/custom-timeline.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\alert.scss */"./resources/sass/assets/elements/alert.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\avatar.scss */"./resources/sass/assets/elements/avatar.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\breadcrumb.scss */"./resources/sass/assets/elements/breadcrumb.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\custom-pagination.scss */"./resources/sass/assets/elements/custom-pagination.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\custom-tree_view.scss */"./resources/sass/assets/elements/custom-tree_view.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\infobox.scss */"./resources/sass/assets/elements/infobox.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\miscellaneous.scss */"./resources/sass/assets/elements/miscellaneous.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\popover.scss */"./resources/sass/assets/elements/popover.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\search.scss */"./resources/sass/assets/elements/search.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\elements\tooltip.scss */"./resources/sass/assets/elements/tooltip.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\forms\bootstrap-form.scss */"./resources/sass/assets/forms/bootstrap-form.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\forms\custom-clipboard.scss */"./resources/sass/assets/forms/custom-clipboard.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\forms\switches.scss */"./resources/sass/assets/forms/switches.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\forms\theme-checkbox-radio.scss */"./resources/sass/assets/forms/theme-checkbox-radio.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\coming-soon\style.scss */"./resources/sass/assets/pages/coming-soon/style.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\error\style-400.scss */"./resources/sass/assets/pages/error/style-400.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\error\style-500.scss */"./resources/sass/assets/pages/error/style-500.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\error\style-503.scss */"./resources/sass/assets/pages/error/style-503.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\error\style-maintanence.scss */"./resources/sass/assets/pages/error/style-maintanence.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\faq\faq.scss */"./resources/sass/assets/pages/faq/faq.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\faq\faq2.scss */"./resources/sass/assets/pages/faq/faq2.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\privacy\privacy.scss */"./resources/sass/assets/pages/privacy/privacy.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\contact_us.scss */"./resources/sass/assets/pages/contact_us.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\pages\helpdesk.scss */"./resources/sass/assets/pages/helpdesk.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\tables\table-basic.scss */"./resources/sass/assets/tables/table-basic.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\users\account-setting.scss */"./resources/sass/assets/users/account-setting.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\users\user-profile.scss */"./resources/sass/assets/users/user-profile.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\assets\widgets\modules-widgets.scss */"./resources/sass/assets/widgets/modules-widgets.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\animate\animate.scss */"./resources/sass/plugins/animate/animate.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\autocomplete\autocomplete.scss */"./resources/sass/plugins/autocomplete/autocomplete.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\bootstrap-range-Slider\bootstrap-slider.scss */"./resources/sass/plugins/bootstrap-range-Slider/bootstrap-slider.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\bootstrap-select\bootstrap-select.min.scss */"./resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\bootstrap-touchspin\jquery.bootstrap-touchspin.min.scss */"./resources/sass/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\drag-and-drop\dragula\dragula.scss */"./resources/sass/plugins/drag-and-drop/dragula/dragula.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\drag-and-drop\dragula\example.scss */"./resources/sass/plugins/drag-and-drop/dragula/example.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\dropify\dropify.min.scss */"./resources/sass/plugins/dropify/dropify.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\editors\markdown\simplemde.min.scss */"./resources/sass/plugins/editors/markdown/simplemde.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\editors\quill\quill.bubble.scss */"./resources/sass/plugins/editors/quill/quill.bubble.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\editors\quill\quill.snow.scss */"./resources/sass/plugins/editors/quill/quill.snow.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\file-upload\file-upload-with-preview.min.scss */"./resources/sass/plugins/file-upload/file-upload-with-preview.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\flatpickr\custom-flatpickr.scss */"./resources/sass/plugins/flatpickr/custom-flatpickr.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\fullcalendar\custom-fullcalendar.advance.scss */"./resources/sass/plugins/fullcalendar/custom-fullcalendar.advance.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\fullcalendar\fullcalendar.min.scss */"./resources/sass/plugins/fullcalendar/fullcalendar.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\fullcalendar\fullcalendar.scss */"./resources/sass/plugins/fullcalendar/fullcalendar.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\jquery-step\jquery.steps.scss */"./resources/sass/plugins/jquery-step/jquery.steps.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\jvector\jquery-jvectormap-2.0.3.scss */"./resources/sass/plugins/jvector/jquery-jvectormap-2.0.3.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\lightbox\custom-photswipe.scss */"./resources/sass/plugins/lightbox/custom-photswipe.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\lightbox\photoswipe.scss */"./resources/sass/plugins/lightbox/photoswipe.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\loaders\custom-loader.scss */"./resources/sass/plugins/loaders/custom-loader.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\noUiSlider\custom-nouiSlider.scss */"./resources/sass/plugins/noUiSlider/custom-nouiSlider.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\perfect-scrollbar\perfect-scrollbar.scss */"./resources/sass/plugins/perfect-scrollbar/perfect-scrollbar.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\pricing-table\css\component.scss */"./resources/sass/plugins/pricing-table/css/component.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\select2\select2.min.scss */"./resources/sass/plugins/select2/select2.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\sweetalerts\sweetalert.scss */"./resources/sass/plugins/sweetalerts/sweetalert.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\sweetalerts\sweetalert2.min.scss */"./resources/sass/plugins/sweetalerts/sweetalert2.min.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\custom_dt_custom.scss */"./resources/sass/plugins/table/datatable/custom_dt_custom.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\custom_dt_html5.scss */"./resources/sass/plugins/table/datatable/custom_dt_html5.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\custom_dt_miscellaneous.scss */"./resources/sass/plugins/table/datatable/custom_dt_miscellaneous.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\custom_dt_multiple_tables.scss */"./resources/sass/plugins/table/datatable/custom_dt_multiple_tables.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\datatables.scss */"./resources/sass/plugins/table/datatable/datatables.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\datatables-light.scss */"./resources/sass/plugins/table/datatable/datatables-light.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\dt-global_style.scss */"./resources/sass/plugins/table/datatable/dt-global_style.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\table\datatable\dt-global_style-light.scss */"./resources/sass/plugins/table/datatable/dt-global_style-light.scss");
__webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\sass\plugins\tagInput\tags-input.scss */"./resources/sass/plugins/tagInput/tags-input.scss");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\css\app.scss */"./resources/css/app.scss");


/***/ })

/******/ });