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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/import.js":
/*!********************************!*\
  !*** ./resources/js/import.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// INITIALIZATION
var $import_iteration = 0,
    $import_total = 0,
    $import_percentage = 0,
    $import_run = 0,
    $import_data = [],
    $import_timeout_delay,
    $import_timeout,
    $import_url_store,
    $import_new_data = 0,
    $import_update_data = 0,
    $import_failed_data = 0; // SCROLL ON TOP

function _scrollOnTop() {
  $('html, body').animate({
    scrollTop: 0
  }, 'slow');
} // UNBLOCK PAGE


function _unblockUI($timeFade, $timeout) {
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
} // BLOCK PAGE


function _blockUI($timeFade, $loadingText) {
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

function _importCount() {
  var $recent_data = $import_data[$import_iteration]; // ITERATION

  $('#import-iteration').text($import_iteration + 1); // PROGRESS BAR

  $import_percentage = (($import_iteration + 1) / $import_total * 100).toFixed(1);
  $('#import-progressbar').css('width', $import_percentage + "%");
  $('#import-progressbar').attr('aria-valuenow', $import_percentage);
  $('#import-progressbar-percentage').text($import_percentage); // STORE DATA

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: "POST",
    url: $import_url_store,
    data: $recent_data
  }).done(function (result) {
    // console.log(result);
    if (result.success) {
      var $result = result.data; // RESULT

      var $msg = '[LINE ' + ($result.line + $import_iteration) + '] ' + $result.name;

      if ($result.status == "new") {
        // RESULT (NEW DATA)
        $import_new_data++;
        $("#import-result-new-data").val($("#import-result-new-data").val() + $msg + '\n');
        $("#import-result-new-data").scrollTop($("#import-result-new-data")[0].scrollHeight - $("#import-result-new-data").height());
      } else if ($result.status == "update") {
        // RESULT (UPDATE DATA)
        $import_update_data++;
        $("#import-result-update-data").val($("#import-result-update-data").val() + $msg + '\n');
        $("#import-result-update-data").scrollTop($("#import-result-update-data")[0].scrollHeight - $("#import-result-update-data").height());
      } else if ($result.status == "failed") {
        // RESULT (FAILED DATA)
        $import_failed_data++;
        $("#import-result-failed-data").val($("#import-result-failed-data").val() + $msg + '\n');
        $("#import-result-failed-data").val($("#import-result-failed-data").val() + '- error : ' + $result.message + '\n');
        $("#import-result-failed-data").scrollTop($("#import-result-failed-data")[0].scrollHeight - $("#import-result-failed-data").height());
      } // REPEAT IMPORT


      $import_iteration++;

      if ($import_run && $import_iteration < $import_total) {
        $import_timeout = setTimeout(_importCount, $import_timeout_delay);
      } else {
        if ($import_iteration < $import_total) {
          $("#import-btn-play").show();
          $("#import-btn-refresh").show();
          $("#import-group-form").show();
        } else {
          // HIDE ELEMENT
          $("#import-btn-play").hide();
          $("#import-btn-pause").hide();
          $("#import-btn-refresh").hide(); // SHOW ELEMENT

          $("#import-group-form").show(); // REPORT IMPORT

          $('#import-report-total').text($import_total);
          $('#import-report-new').text($import_new_data);
          $('#import-report-update').text($import_update_data);
          $('#import-report-failed').text($import_failed_data);
          $("#import-report").show();
        }
      }
    }
  }).fail(function (data) {});
}

$("#import-btn-pause").click(function () {
  console.log('pause'); // PAUSE IMPORT

  clearTimeout($import_timeout);
  $import_run = 0; // SHOW ELEMENT

  $("#import-btn-play").show();
  $("#import-btn-refresh").show();
  $("#import-group-form").show(); // HIDE ELEMENT

  $("#import-btn-pause").hide();
});
$("#import-btn-play").click(function () {
  console.log('resume');

  if (!$import_run && $import_iteration < $import_total) {
    // HIDE ELEMENT
    $("#import-btn-play").hide();
    $("#import-btn-refresh").hide();
    $("#import-group-form").hide(); // SHOW ELEMENT

    $("#import-btn-pause").show(); // RESUME IMPORT

    $import_run = 1;

    _importCount();
  }
});
$(".form-import").submit(function (event) {
  event.preventDefault();
  var $el = $(this);
  var $fd = new FormData();
  var $file = $el.find(':input[type=file]')[0].files;

  if ($file.length > 0) {
    $fd.append('file', $file[0]);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: $el.attr("method"),
      url: $el.attr("action"),
      data: $fd,
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        _blockUI(800, 'Uploading File ...');
      },
      success: function success(result) {
        _unblockUI(100, 500);

        console.log(result);

        if (result.success) {
          var $data = result.data; // INITIALIZATION

          $import_iteration = $import_total = $import_percentage = $import_run = $import_new_data = $import_update_data = $import_failed_data = 0;
          $import_data = [];
          $("#import-result-new-data").val('');
          $("#import-result-update-data").val('');
          $("#import-result-failed-data").val('');

          _scrollOnTop(); // HIDE ELEMENT


          $("#import-btn-play").hide();
          $("#import-btn-refresh").hide();
          $("#import-btn-pause").hide();
          $("#import-report").hide(); // SHOW ELEMENT

          $('#import-progress').show(); // INFO FILE

          $('#import-filename').text($data.filename);
          $('#import-entries').text($data.total); // ITERATION

          var $iteration = 0;
          $('#import-iteration').text($iteration); // PROGRESS BAR

          var $percentage = 0;
          $('#import-progressbar').css('width', $percentage + "%");
          $('#import-progressbar').attr('aria-valuenow', $percentage);
          $('#import-progressbar-percentage').text($percentage);

          if ($data.total > 0) {
            // HIDE ELEMENT
            $("#import-group-form").hide(); // START IMPORT

            $import_total = $data.total;
            $import_data = $data.items;
            $import_url_store = $el.data('url_store');
            $import_timeout_delay = $el.data('delay_time');

            if ($import_total && $import_data && $import_url_store && $import_timeout_delay) {
              $import_run = 1;
              $("#import-btn-pause").show();

              _importCount();
            }
          } else {
            swal({
              title: 'Failed!',
              text: 'No data!',
              type: 'error',
              padding: '2em'
            });
          }
        } else {
          swal({
            title: 'Failed!',
            text: 'Data failed to import',
            type: 'error',
            padding: '2em'
          });
        }
      }
    }).fail(function (data) {
      _unblockUI(100, 500);

      swal({
        title: 'Failed!',
        text: 'Data failed to import',
        type: 'error',
        padding: '2em'
      });
    });
    ;
  } else {
    alert("Upload the file first.");
  }
});

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/import.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\dfa-library\resources\js\import.js */"./resources/js/import.js");


/***/ })

/******/ });