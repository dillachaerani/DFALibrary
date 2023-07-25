// require('./bootstrap');

// Check All Checkbox
checkall('todoAll', 'todochkbox');
$('[data-toggle="tooltip"]').tooltip()

$(function () {
    _init();
});

function _init() {
    _jsonView();
    // const $setSelect2 = document.getElementsByClassName("set-select2");
    // for (let i = 0; i < $setSelect2.length; i++) {
    //     let $data = $($setSelect2[i]).data();
    //     let $id = $($setSelect2[i]).val();
    //     setSelect2($data, $id);
    // }
}

function _jsonView() {
    const $jsonView = document.getElementsByClassName("json-view");
    for (let i = 0; i < $jsonView.length; i++) {
        $jsonView[i].innerHTML = JSON.stringify($($jsonView[i]).data('json'), null, 4);
    }
}

// Check all item
$(document).on('change', '.check-all-item', function (event) {
    $('.' + $(this).data('child')).prop('checked', this.checked);
    if ($(this).is(":checked")) {
        $('.' + $(this).data('child')).closest('tr').css("background-color", "#080d38");
    } else
        $('.' + $(this).data('child')).closest('tr').css("background-color", "#060818");
});

// Scroll on top
function _scrollOnTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
}

// Convert string to slug
$(document).on('change, click, keypress', '.text-slug', function (event) {
    $(this).val(convertToSlug($(this).val()));
});

// Function convert string to slug 
function convertToSlug(Text) {
    return Text
        .toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
}

// Unblock loading animation
function unblockUI_($timeFade, $timeout) {
    $.blockUI({
        message: '',
        fadeOut: $timeFade,
        timeout: $timeout, //unblock after 2 seconds
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
// Block UI
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
}

// Select Input Direct To URL
$(".table-show-item").change(function () {
    const $data = $(this).find(":selected").data();
    window.location = $data.href;
})

// Form search on table
$(".table-form-search").submit(function (event) {
    event.preventDefault();
    var $keyword = $(this).find(':input[name=q]').val();
    var $url = new URL($(this).attr('action'));
    var $searchParams = $url.searchParams;
    $searchParams.set('q', $keyword);
    $url.search = $searchParams.toString();
    window.location = $url.toString();
});

// Bulk action on table
$(".table-bulk-action").submit(function (event) {
    event.preventDefault();
    var $el = $(this);
    var $action = $el.find(':input[name=b_action]').find(":selected").data();
    const $data = [];
    var selected_params = "";
    var i = 0;
    $('.' + $el.data('child') + ':checkbox:checked').each(function () {
        $data.push($(this).val());
        if ($action.redirect) {
            selected_params += 'id[]=' + $(this).val();
            if (i != $('.' + $el.data('child') + ':checkbox:checked').length - 1)
                selected_params += '&';
            i++;
        }
    });
    if ($data.length > 0) {
        if ($action.redirect) {
            if ($action.url.includes("?"))
                return window.open($action.url + '&' + encodeURI(selected_params), '_blank');
            else
                return window.open($action.url + '?' + encodeURI(selected_params), '_blank');
        }
        const $msg = $data.length + ' ' + $action.alert;
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
                        },
                    })
                    .done(function (data) {
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
                    })
                    .fail(function (data) {
                        unblockUI_(100, 300);
                        swal({
                            title: 'Failed!',
                            text: 'Data failed to process',
                            type: 'error',
                            padding: '2em'
                        })
                    });
            }
        })
    } else {
        swal({
            title: 'Failed!',
            text: 'No data selected',
            type: 'error',
            padding: '2em'
        })
    }
});

// Sweet alert confirm
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
    })
}

// Form confirmation
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
    })
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
                    })
                }
            }).fail(function() {
                unblockUI_(100, 500);
                swal({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    type: 'error',
                    padding: '2em'
                })
            });
        }
    })
});

$(".form-set-permissions").submit(function (event) {
    event.preventDefault();
    var $el = $(this);
    const $data = [];
    $('.' + $el.data('child') + ':checkbox:checked').each(function () {
        $data.push($(this).val());
    });
    if ($data.length > 0) {
        const $msg = $data.length + ' ' + $el.data('alert');
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
                console.log($el.attr('action'))
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
                        },
                    })
                    .done(function (data) {
                        console.log(data)
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
                            })
                        }
                    })
                    .fail(function (data) {
                        unblockUI_(100, 300);
                        swal({
                            title: 'Failed!',
                            text: 'Permission failed to grant',
                            type: 'error',
                            padding: '2em'
                        })
                    });
            }
        })
    } else {
        swal({
            title: 'Failed!',
            text: 'No data selected',
            type: 'error',
            padding: '2em'
        })
    }
});

// Validate Upload Image
$(".upload-image-validate").change(function () {
    var file = this.files[0];
    var extension = file.name.substr((file.name.lastIndexOf('.') + 1));
    var file_size = Math.round((file.size / 1024));
    const filesize_max = $(this).data('filesize_max');
    if (file_size > filesize_max) {
        Swal.fire('Failed', 'Size file max ' + filesize_max + 'KB', 'error');
        $(this).val("");
    } else {
        const require_extention = ['jpg', 'jpeg', 'png'];
        if (!require_extention.includes(extension)) {
            Swal.fire('Failed', 'Type file must ' + require_extention.join(', '), 'error');
            $(this).val("");
        }
    }
})
$(".dropify-validate-custom").change(function () {
    var file = this.files[0];
    var extension = file.name.substr((file.name.lastIndexOf('.') + 1));
    var file_size = Math.round((file.size / 1024));
    const upload_filesize_max = $(this).data('upload_filesize_max');
    const upload_extention = $(this).data('upload_extention');
    if (file_size > upload_filesize_max) {
        Swal.fire('Failed', 'Size file max ' + upload_filesize_max + 'KB', 'error');
        $(this).val("");
    } else {
        const require_extention = upload_extention.split(",");
        if (!require_extention.includes(extension)) {
            Swal.fire('Failed', 'Format file must ' + require_extention.join(', '), 'error');
            $(this).val("");
        }
    }
})
$(".image-preview-validate-custom").change(function () {
    var file = this.files[0];
    var extension = file.name.substr((file.name.lastIndexOf('.') + 1));
    var file_size = Math.round((file.size / 1024));
    const upload_filesize_max = $(this).data('upload_filesize_max');
    const upload_extention = $(this).data('upload_extention');
    if (file_size > upload_filesize_max) {
        Swal.fire('Failed', 'Size file max ' + upload_filesize_max + 'KB', 'error');
        $(this).val("");
        new FileUploadWithPreview($(this).data('upload_id'));
    } else {
        const require_extention = upload_extention.split(",");
        if (!require_extention.includes(extension)) {
            Swal.fire('Failed', 'Type file must ' + require_extention.join(', '), 'error');
            $(this).val("");
            new FileUploadWithPreview($(this).data('upload_id'));
        }
    }
})

// Validate Upload Excel
$(".upload-excel-validate").change(function () {
    var file = this.files[0];
    var extension = file.name.substr((file.name.lastIndexOf('.') + 1));
    var file_size = Math.round((file.size / 1024));
    const filesize_max = $(this).data('filesize_max');
    if (file_size > filesize_max) {
        Swal.fire('Failed', 'Size file max ' + filesize_max + 'KB', 'error');
        $(this).val("");
    } else {
        const require_extention = ['xlsx', 'xls'];
        if (!require_extention.includes(extension)) {
            Swal.fire('Failed', 'Type file must ' + require_extention.join(', '), 'error');
            $(this).val("");
        }
    }
})

$(".table-config-trash").change(function () {
    let is_trash;
    const $data = $(this).data();
    if ($(this).is(":checked")) {
        is_trash = 1;
    } else
        is_trash = 0;
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
                'is_trash': is_trash,
            },
        })
        .done(function (data) {
            if (data.success) {
                unblockUI_(100, 100);
                location.reload();
            }
        })
        .fail(function (data) {
            unblockUI_(100, 100);
            swal({
                title: 'Failed!',
                text: 'Data failed to process',
                type: 'error',
                padding: '2em'
            })
        });
});

function _blockUI($timeFade, $loadingText, $area = false) {
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

function _unblockUI($timeFade, $timeout, $area = false) {
    if ($area) {
        $area.block({
            message: '',
            fadeOut: $timeFade,
            timeout: $timeout, //unblock after 2 seconds
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
            timeout: $timeout, //unblock after 2 seconds
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
}

$("tr.tr-show").find('td:not(.td-disable)').single_double_click(function () {
    const $data = $(this).parent().data();
    if ($data.href) {
        const $modal = $($data.target);
        _blockUI(800, 'Processing', $modal.find('.modal-content'));
        $.ajax({
            url: $data.href,
            dataType: 'html',
            success: function (result) {
                _unblockUI(100, 500, $modal.find('.modal-content'))
                $modal.find('.modal-content').html(result);
                $modal.modal('show');
                feather.replace();
                _jsonView();
            },
        });
    }
}, function () {
    const $data = $(this).parent().data();
    if ($data.href) {
        if ($data.new_tab == true)
            window.open($data.href);
        else
            window.location = $data.href;
    }
})

$(".show-modal-custom").click(function () {
    const $data = $(this).data();
    if ($data.href) {
        const $modal = $($data.target);
        _blockUI(800, 'Processing', $modal.find('.modal-content'));
        $.ajax({
            url: $data.href,
            dataType: 'html',
            success: function (result) {
                _unblockUI(100, 500, $modal.find('.modal-content'))
                $modal.find('.modal-content').html(result);
                $modal.modal('show');
                feather.replace();
            },
        });
    }
})

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
                    })
                }
            }).fail(function() {
                unblockUI_(100, 500);
                swal({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    type: 'error',
                    padding: '2em'
                })
            });
        }
    })
})

$('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "inherit");
    $('.table-responsive').css("overflow-x", "auto");
});

$('.table-responsive').on('hide.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "auto");
})

$(".checkbox-tr").change(function () {
    if ($(this).is(":checked")) {
        $(this).closest('tr').css("background-color", "#080d38");
    } else
        $(this).closest('tr').css("background-color", "#060818");
})

$(".btn-view-image").click(function () {
    var $file = $(this).data('file');
    var $file_original = $(this).data('file_original');
    var $filename = $(this).data('filename');
    var filename_split = $filename.split(".");
    var extension = filename_split[1];
    const require_extention = ['jpg', 'jpeg', 'png', 'ico'];
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
    const $data = $(this).data();
    let $id = $(this).val();
    if ($id)
        setSelect2($data, $id);
})

function setSelect2(data, id) {
    $.get(data.url + '/' + id, function (response) {
        if (response.success) {
            $("#" + data.target).empty().select2({
                allowClear: true,
                data: response.data,
                placeholder: data.target_placeholder
            });
        }
    }).fail(function() {
        unblockUI_(100, 500);
        swal({
            title: 'Oops...',
            text: 'Something went wrong!',
            type: 'error',
            padding: '2em'
        })
    });
}
