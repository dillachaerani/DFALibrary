<?php
$menu = "User";
$attributes = [
    "avatar"                => 'Avatar',
    "name"                  => 'Name',
    "username"              => 'Username',
    "email"                 => 'Email',
    'email_verified_at'     => 'Email Status',
    "roles"                 => "Roles",
    "is_active"             => "Status",
    "password"              => "Paassword",
    "password_confirmation" => "Password Confirmation",
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
        "activate" => [
            "alert"    => "$menu :attr will be activated",
            "success"  => "$menu :attr has been successfully activated",
            "failed"   => "$menu :attr failed to activated",
            "selected" => [
                "alert"   => "data will be activated",
                "success" => ":attr data has been successfully activated",
                "failed"  => "No data activated",
            ],
            "all" => [
                "alert"   => "All data will be activated",
                "success" => "All data has been successfully activated",
                "failed"  => "No data activated",
            ]
        ],
        "deactivate" => [
            "alert"    => "$menu :attr will be deactivated",
            "success"  => "$menu :attr has been successfully deactivated",
            "failed"   => "$menu :attr failed to deactivated",
            "selected" => [
                "alert"   => "data will be deactivated",
                "success" => ":attr data has been successfully deactivated",
                "failed"  => "No data deactivated",
            ],
            "all" => [
                "alert"   => "All data will be deactivated",
                "success" => "All data has been successfully deactivated",
                "failed"  => "No data deactivated",
            ]
        ],
        "verification" => [
            "alert"    => "$menu :attr will be verified",
            "success"  => "$menu :attr has been successfully verified",
            "failed"   => "$menu :attr failed to verified",
            "selected" => [
                "alert"   => "data will be verified",
                "success" => ":attr data has been successfully verified",
                "failed"  => "No data verified",
            ],
            "all" => [
                "alert"   => "All data will be verified",
                "success" => "All data has been successfully verified",
                "failed"  => "No data verified",
            ]
        ],
        "unverification" => [
            "alert"    => "$menu :attr will be unverified",
            "success"  => "$menu :attr has been successfully unverified",
            "failed"   => "$menu :attr failed to unverified",
            "selected" => [
                "alert"   => "data will be unverified",
                "success" => ":attr data has been successfully unverified",
                "failed"  => "No data unverified",
            ],
            "all" => [
                "alert"   => "All data will be unverified",
                "success" => "All data has been successfully unverified",
                "failed"  => "No data unverified",
            ]
        ],
    ],
    "attributes" => $attributes,
];
