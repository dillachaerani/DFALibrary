<?php
$menu = "Menu Setting";
$attributes = [
    "key"              => "Key",
    "is_trash"         => "Trash",
    "sheet_id"         => "Google Sheet ID",
    "last_sync"        => "Last Sync",
    "sheet_import_id"  => "Google Sheet ID (Import)",
    "last_sync_import" => "Last Sync Sheet Import",
];
return [
    "title" => [
        "index"  => "Data $menu",
        "create" => "Add New $menu",
        "edit"   => "Edit $menu",
        "detail" => "Detail $menu",
    ],
    "description" => [
        "index"  => "",
        "detail" => "",
    ],
    "keywords" => [
        "index"  => "",
        "detail" => "",
    ],
    "messages" => [
        "create" => [
            "success" => "$menu :attr has been saved successfully",
            "failed"  => "$menu :attr failed to save",
        ],
        "update" => [
            "success" => "$menu :attr has been updated successfully",
            "failed"  => "$menu :attr failed to update",
        ],
        "delete" => [
            "alert"    => "$menu :attr will be deleted",
            "success"  => "$menu :attr has been successfully deleted",
            "failed"   => "$menu :attr failed to delete",
            "multiple" => [
                "alert"   => "data will be deleted",
                "success" => ":attr data has been successfully deleted",
                "failed"  => "No data deleted",
            ],
            "all" => [
                "alert"   => "All data will be deleted",
                "success" => "All data has been successfully deleted",
                "failed"  => "No data deleted",
            ]
        ],
        "delete_force" => [
            "alert"    => "$menu :attr will be deleted permanently",
            "success"  => "$menu :attr has been successfully deleted permanently",
            "failed"   => "$menu :attr failed to delete permanently",
            "multiple" => [
                "alert"   => "data will be deleted permanently",
                "success" => ":attr data has been successfully deleted permanently",
                "failed"  => "No data deleted permanently",
            ],
            "all" => [
                "alert"   => "All data will be deleted permanently",
                "success" => "All data has been successfully deleted permanently",
                "failed"  => "No data deleted permanently",
            ]
        ],
        "restore" => [
            "alert"    => "$menu :attr will be restored",
            "success"  => "$menu :attr has been successfully restored",
            "failed"   => "$menu :attr failed to restore",
            "selected" => [
                "alert"   => "data will be restored",
                "success" => ":attr data has been successfully restored",
                "failed"  => "No data restored",
            ],
            "all" => [
                "alert"   => "All data will be restored",
                "success" => "All data has been successfully restored",
                "failed"  => "No data restored",
            ]
        ],
        "trash" => [
            "alert"    => "$menu :attr will be :status",
            "success"  => "Trash :attr has been successfully :status",
            "failed"   => "$menu :attr failed to delete",
            "selected" => [
                "alert"   => "data will be :status",
                "success" => ":attr data has been successfully updated",
                "failed"  => "No data updated",
            ],
            "all" => [
                "alert"   => "All data will be :status",
                "success" => "All data has been successfully updated",
                "failed"  => "No data updated",
            ]
        ],
        "enable-trash" => [
            "alert"    => "$menu :attr will be enable trash",
            "success"  => "$menu :attr has been successfully enable trash",
            "failed"   => "$menu :attr failed to enable trash",
            "selected" => [
                "alert"   => "data will be enable trash",
                "success" => ":attr data has been successfully enable trash",
                "failed"  => "No data enable trash",
            ],
            "all" => [
                "alert"   => "All data will be enable trash",
                "success" => "All data has been successfully enable trash",
                "failed"  => "No data enable trash",
            ]
        ],
        "disable-trash" => [
            "alert"    => "$menu :attr will be disable trash",
            "success"  => "$menu :attr has been successfully disable trash",
            "failed"   => "$menu :attr failed to disable trash",
            "selected" => [
                "alert"   => "data will be disable trash",
                "success" => ":attr data has been successfully disable trash",
                "failed"  => "No data disable trash",
            ],
            "all" => [
                "alert"   => "All data will be disable trash",
                "success" => "All data has been successfully disable trash",
                "failed"  => "No data disable trash",
            ]
        ],
    ],
    "attributes" => $attributes,
];
