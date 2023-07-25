<?php
$menu = "Permission";
$attributes = [
    "name"        => 'Name',
    "guard_name"  => 'Guard Name',
    "roles_count" => "Roles Count",
    "roles"       => "Roles",
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
        "create" => "",
        "detail" => "",
        "edit"   => "",
    ],
    "keywords" => [
        "index"  => "",
        "create" => "",
        "detail" => "",
        "edit"   => "",
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
            "selected" => [
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
            "selected" => [
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
    ],
    "attributes" => $attributes,
];
