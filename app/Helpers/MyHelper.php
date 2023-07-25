<?php

namespace App\Helpers;

use Carbon\Carbon;

class MyHelper
{

    /**
     * Function for provide status menu active
     */
    public static function active_class($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    /**
     * Function for provide status submenu show
     */
    public static function active_class_show($path, $active = 'show')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    /**
     * Function for provide status menu true
     */
    public static function active_class_true($path, $active = 'true')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : 'false';
    }

    public static function alt_menu()
    {
        if (in_array(\Route::currentRouteName(), ['apps.calendar', 'apps.chat', 'apps.contacts', 'apps.invoice', 'apps.mailbox', 'apps.notes', 'apps.scrumboard', 'apps.todoList']))
            return 'alt-menu';
    }

    public static function setTitle($page_name, $app_name = true)
    {
        $app_name = $app_name ? " | " . config('app.name') : '';
        return $page_name . $app_name;
    }

    public static function scrollspy($offset)
    {
        echo 'data-target="#navSection" data-spy="scroll" data-offset="' . $offset . '"';
    }

    public static function tab_class_active($name, $active = "active")
    {
        if ($name == request()->tab)
            return $active;
    }

    public static function tab_class_true($name, $active = 'true')
    {
        if ($name == request()->tab)
            return $active;
        else
            return 'false';
    }

    public static function tab_class_active_true($name, $active = true)
    {
        if ($name == request()->tab)
            return $active;
        else
            return false;
    }

    public static function table_generate_th($name, $fieldName = null)
    {
        if (request()->order_by == $fieldName) {
            if (request()->sort_by == 'asc')
                return "<a href='" . route(request()->route()->getName(), request()->except(['page', 'sort_by', 'order_by']) + ['order_by' => $fieldName, 'sort_by' => 'desc']) . "'><u>$name</u> &#9662;</a>";
            else if (request()->sort_by == 'desc')
                return "<a href='" . route(request()->route()->getName(), request()->except(['page', 'sort_by', 'order_by']) + ['order_by' => $fieldName, 'sort_by' => 'asc']) . "'><u>$name</u> &#9652;</a>";
        } else
            return "<a href='" . route(request()->route()->getName(), request()->except(['page', 'sort_by', 'order_by']) + ['order_by' => $fieldName, 'sort_by' => 'asc']) . "'><u>$name</u></a>";
    }

    public static function dt_column_datetime($datetime)
    {
        $timezone           = config('app.region');
        $humanDateTime      = $datetime->diffForHumans();
        $datetime           = explode(' ', $datetime->setTimezone($timezone));
        $date               = $datetime[0];
        $time               = $datetime[1];
        return view('components.dt-column-datetime', [
            'date'          => $date,
            'time'          => $time . ' ' . MyHelper::timezone_short($timezone),
            'humanDateTime' => $humanDateTime
        ]);
    }

    public static function timezone_short($timezone)
    {
        switch ($timezone) {
            case 'Asia/Jakarta':
                return 'WIB';
                break;
            case 'Asia/Makassar':
                return 'WITA';
                break;
            case 'Asia/Jayapura':
                return 'WIT';
                break;
            default:
                return 'WIB';
                break;
        }
    }

    public static function datatable_show_option()
    {
        return ['15' => 15, '50' => 50, '100' => 100, '200' => 200];
    }

    public static function flash_notification($is_error, $message, $items = [])
    {
        return \Session::flash("flash_notification", [
            "is_error"      => $is_error,
            "message"       => $message,
            "items"         => $items,
        ]);
    }
    public static function flash_notification_item($is_error, $message)
    {
        return [
            "is_error"      => $is_error,
            "message"       => $message,
        ];
    }

    public static function query_scope_search($query, $keyword, $fields)
    {
        $keyword = preg_replace('/\s+/', '%', $keyword);
        $keyword = "%{$keyword}%";
        $query->where(function ($query) use ($keyword, $fields) {
            foreach ($fields as $field) {
                $query->orWhere($field, 'like', $keyword);
            };
        });
        return $query;
    }

    public static function generate_ph($type, $name)
    {
        if ($type == "text") {
            $msg = __('Type ') . strtolower($name) . __(' in here');
        } elseif ($type == "select") {
            $msg = __('Choose ') . strtolower($name) . __(' in here');
        }
        return $msg . "...";
    }

    public static function get_initial_name($name)
    {
        $explodeName = explode(" ", $name);
        if (count($explodeName) > 1) {
            $name = strtoupper(substr($explodeName[0], 0, 1)) . strtoupper(substr($explodeName[1], 0, 1));
            return $name;
        } else
            return strtoupper(substr($name, 0, 2));
    }

    public static function get_month($type, $month)
    {
        switch ($month) {
            case '01':
                if ($type == 'short') {
                    $month = __('Jan');
                } else if ($type == 'long') {
                    $month = __('Januari');
                }
                break;
            case '02':
                if ($type == 'short') {
                    $month = __('Feb');
                } else if ($type == 'long') {
                    $month = __('Februari');
                }
                break;
            case '03':
                if ($type == 'short') {
                    $month = __('Mar');
                } else if ($type == 'long') {
                    $month = __('Maret');
                }
                break;
            case '04':
                if ($type == 'short') {
                    $month = __('Apr');
                } else if ($type == 'long') {
                    $month = __('April');
                }
                break;
            case '05':
                if ($type == 'short') {
                    $month = __('May');
                } else if ($type == 'long') {
                    $month = __('Mei');
                }
                break;
            case '06':
                if ($type == 'short') {
                    $month = __('Jun');
                } else if ($type == 'long') {
                    $month = __('Juni');
                }
                break;
            case '07':
                if ($type == 'short') {
                    $month = __('Jul');
                } else if ($type == 'long') {
                    $month = __('Juli');
                }
                break;
            case '08':
                if ($type == 'short') {
                    $month = __('Aug');
                } else if ($type == 'long') {
                    $month = __('Agustus');
                }
                break;
            case '09':
                if ($type == 'short') {
                    $month = __('Sep');
                } else if ($type == 'long') {
                    $month = __('September');
                }
                break;
            case '10':
                if ($type == 'short') {
                    $month = __('Oct');
                } else if ($type == 'long') {
                    $month = __('Oktober');
                }
                break;
            case '11':
                if ($type == 'short') {
                    $month = __('Nov');
                } else if ($type == 'long') {
                    $month = __('November');
                }
                break;
            case '12':
                if ($type == 'short') {
                    $month = __('Dec');
                } else if ($type == 'long') {
                    $month = __('Desember');
                }
                break;
            default:
                return false;
                break;
        }
        return $month;
    }

    public static function datetime_long_datetime_local($datetime)
    {
        $timezone = config('app.region');
        $datetime = explode(' ', $datetime->setTimezone($timezone));
        $date     = $datetime[0];
        $date     = explode("-", $date);
        $date     = join(' ', [$date[2], MyHelper::get_month('long', $date[1]), $date[0]]);
        $time     = $datetime[1] . ' ' . MyHelper::timezone_short($timezone);
        return join(', ', [$date, $time]);
    }

    public static function carbon_datetime_local($datetime)
    {
        $timezone = config('app.region');
        $datetime = Carbon::parse($datetime)->timezone($timezone)->toDateTimeString();
        $datetime = explode(' ', $datetime);
        $date     = $datetime[0];
        $date     = explode("-", $date);
        $date     = join(' ', [$date[2], MyHelper::get_month('long', $date[1]), $date[0]]);
        $time     = $datetime[1] . ' ' . MyHelper::timezone_short($timezone);
        return join(', ', [$date, $time]);
    }

    public static function date_long_local($date)
    {
        $timezone = config('app.region');
        $date     = explode(' ', $date);
        $date     = $date[0];
        $date     = explode("-", $date);
        $date     = join(' ', [$date[2], MyHelper::get_month('long', $date[1]), $date[0]]);
        return $date;
    }

    public static function gender($icon = false)
    {
        return [
            'M' => ($icon) ? '<i class="fas fa-male text-info"></i> ' . __('Male') : __('Male'),
            'F' => ($icon) ? '<i class="fas fa-female text-danger"></i> ' . __('Female') : __('Female'),
        ];
    }

    public static function welcome_message($is_error, $message, $items = [])
    {
        return \Session::flash("flash_notification", [
            "is_error"      => $is_error,
            "message"       => $message,
            "items"         => $items,
        ]);
    }

    public static function item_checked_all($countChecked, $countItem)
    {
        if ($countChecked == $countItem)
            return 'checked';
    }

    public static function timezone()
    {
        return [
            'Asia/Jakarta'  => 'Asia/Jakarta',
            'Asia/Makassar' => 'Asia/Makassar',
            'Asia/Jayapura' => 'Asia/Jayapura',
        ];
    }

    /**
     * Get list file in directory
     */
    public static function directory_get_list_file($path)
    {
        $iterator = new \DirectoryIterator(public_path($path));
        $result = [];
        $timezone = config('app.region');
        $timezone_short = MyHelper::timezone_short($timezone);
        date_default_timezone_set($timezone);
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {
                if (!in_array($fileinfo->getFilename(), ['.gitignore']))
                    $result[] = array(
                        "file_name"     => $fileinfo->getFilename(),
                        "file_size"     => $fileinfo->getSize(), // returns size in bytes
                        "file_ext"      => $fileinfo->getExtension(),
                        "file_type"     => MyHelper::file_get_type($fileinfo->getExtension()),
                        "last_modified" => date("Y-m-d H:i:s", $fileinfo->getATime()) . " $timezone_short",
                        "link"          => asset($path . "/" . $fileinfo->getFilename()),
                        "path"          => $path . "/" . $fileinfo->getFilename()
                    );
            }
        }
        $file_name = array_column($result, 'file_name');
        array_multisort($file_name, SORT_ASC, $result);
        return $result;
    }

    /**
     * Get info of directory
     */
    public static function directory_get_info($path)
    {
        $iterator = new \DirectoryIterator(public_path($path));
        $result = [];
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir()) {
                if (!in_array($fileinfo->getFilename(), ['..', '.', '.gitignore']))
                    $result[] = [
                        'name' => $fileinfo->getFilename(),
                        "path" => $path . "/" . $fileinfo->getFilename()
                    ];
            }
        }
        return $result;
    }

    /**
     * Get tree of directory
     */
    public static function directory_get_tree($path)
    {
        $directories = MyHelper::directory_get_info($path);
        $result = [];
        foreach ($directories as $directory) {
            $result[] = [
                'parent'          => $directory['name'],
                'children'        => MyHelper::directory_get_tree($path . "/" . $directory['name']),
                'total_file'      => count(MyHelper::directory_get_list_file($path . "/" . $directory['name'])),
                'total_directory' => count(MyHelper::directory_get_info($path . "/" . $directory['name'])),
            ];
        }
        return $result;
    }

    /**
     * Get type of file
     */
    public static function file_get_type($fileExt)
    {
        $imgExt = ['jpg', 'jpeg', 'png', 'svg', 'ico'];
        if (in_array($fileExt, $imgExt))
            return 'image';
        else
            return 'others';
    }

    /**
     * Get icon extension of file
     */
    public static function file_icon_extension($fileType)
    {
        if ($fileType == "image")
            return 'fas fa-image text-info';
        else
            return 'fas fa-question-circle text-dark';
    }

    public static function reverse_slug($slug)
    {
        return ucwords(str_replace('-', ' ', str_replace('_', ' ', $slug)));
    }

    public static function download_filename($filename, $part = null, $max_part = null)
    {
        $time_download = MyHelper::datetime_long_datetime_local(now());
        $domain        = config('app.base_domain');
        $filename      = explode('.', $filename);
        if ($part)
            $filename      = "[$domain] " . $filename[0] . " PART $part of $max_part - $time_download." . $filename[1];
        else
            $filename      = "[$domain] " . $filename[0] . " - $time_download." . $filename[1];
        return $filename;
    }

    /**
     * Function custom encryption
     */
    public static function customEncryption($text)
    {
        // Store the cipher method 
        $ciphering = "AES-256-CBC";

        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = env('HELPER_ENCRYPT_IV');

        // Store the encryption key 
        $encryption_key = env('HELPER_ENCRYPT_KEY');

        // Use openssl_encrypt() function to encrypt the data 
        $encryption = openssl_encrypt(
            $text,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );
        $encryption = str_replace(array('+', '/', '='), array('-', '_', ''), $encryption);
        return $encryption;
    }

    /**
     * Function custom decryption
     */
    public static function customDecryption($text)
    {
        $text = str_replace(array('-', '_'), array('+', '/'), $text);
        // Store the cipher method 
        $ciphering = "AES-256-CBC";

        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption 
        $decryption_iv = env('HELPER_ENCRYPT_IV');

        // Store the encryption key 
        $decryption_key = env('HELPER_ENCRYPT_KEY');

        // Use openssl_encrypt() function to encrypt the data 
        $decryption = openssl_decrypt(
            $text,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );
        return $decryption;
    }

    /**
     * Badge activity log
     */
    public static function badge_activity()
    {
        return [
            'restored'   => '<span class="badge badge-success"> ' . __('Restored') . ' </span>',
            'deleted'    => '<span class="badge badge-danger"> ' . __('Deleted') . ' </span>',
            'created'    => '<span class="badge badge-secondary"> ' . __('Created') . ' </span>',
            'updated'    => '<span class="badge badge-info"> ' . __('Updated') . ' </span>',
            'import'     => '<span class="badge badge-success"> ' . __('Import') . ' </span>',
            'run_seeder' => '<span class="badge badge-success"> ' . __('Run Seeder') . ' </span>',
        ];
    }

    public static function format_date_input($date)
    {
        if ($date) {
            $date = Carbon::parse($date)->format('d-m-Y');
        }
        return $date;
    }

    public static function format_date($date)
    {
        if ($date) {
            $date = Carbon::parse($date)->format('Y-m-d');
        }
        return $date;
    }

    public static function badge_active($value)
    {
        $response = ($value) ? '<span class="badge badge-info"><i class="far fa-check-circle"></i> ' . __('Active') .
            '</span>' : '<span class="badge badge-danger"><i class="far fa-times-circle"></i> ' . __('Not Active') .
            '</span>';
        return $response;
    }

    public static function badge_publish($value)
    {
        $response = ($value) ? '<span class="badge badge-success"><i class="far fa-check-circle"></i> ' . __('Publish') .
            '</span>' : '<span class="badge badge-danger"><i class="far fa-times-circle"></i> ' . __('Not Publish') .
            '</span>';
        return $response;
    }

    public static function badge_enable($value)
    {
        $response = ($value) ? '<span class="badge badge-info"><i class="far fa-check-circle"></i> ' . __('Enable') .
            '</span>' : '<span class="badge badge-danger"><i class="far fa-times-circle"></i> ' . __('Disable') .
            '</span>';
        return $response;
    }

    public static function badge_ready($value)
    {
        $response = ($value) ? '<span class="badge badge-info"><i class="far fa-check-circle"></i> ' . __('Ready') .
            '</span>' : '<span class="badge badge-danger"><i class="far fa-times-circle"></i> ' . __('Not Ready') .
            '</span>';
        return $response;
    }

    public static function badge_available($value)
    {
        $response = ($value) ? '<span class="badge badge-info"><i class="far fa-check-circle"></i> ' . __('Available') .
            '</span>' : '<span class="badge badge-danger"><i class="far fa-times-circle"></i> ' . __('Not Available') .
            '</span>';
        return $response;
    }

    public static function icon_active($value)
    {
        $response = ($value) ? '<i class="far fa-check-circle text-info bs-tooltip" title="' . __('Active') . '"></i>' : '<i class="far fa-times-circle text-danger bs-tooltip" title="' . __('Not Active') . '"></i>';
        return $response;
    }

    public static function icon_verified($value)
    {
        $response = ($value) ? '<i class="far fa-check-circle text-info bs-tooltip" title="' . __('Verified') . '"></i>' : '<i class="far fa-times-circle text-danger bs-tooltip" title="' . __('Not Verified') . '"></i>';
        return $response;
    }

    public static function icon_publish($value)
    {
        $response = ($value) ? '<i class="far fa-check-circle text-success bs-tooltip" title="' . __('Publish') . '"></i>' : '<i class="far fa-times-circle text-danger bs-tooltip" title="' . __('Not Publish') . '"></i>';
        return $response;
    }

    public static function storage_domain($path, $value, $domain = null)
    {
        if ($domain)
            return "$domain/storage/$path/original/" . $value;
        else
            return env('APP_BASE_DOMAIN') . "/storage/$path/original/" . $value;
    }

    public static function google_sheet_url($id)
    {
        $url = "https://docs.google.com/spreadsheets/d/";
        return $url . $id;
    }

    public static function google_sheet_url_export($id, $type = null)
    {
        if ($type == "pdf")
            $url = MyHelper::google_sheet_url($id) . "/export?format=pdf";
        else
            $url = MyHelper::google_sheet_url($id) . "/export?format=xlsx";
        return $url;
    }

    public static function route_get_controller($type = "controller")
    {
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        if ($type == "action")
            return $action;
        else
            return $controller;
    }
}
