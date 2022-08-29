<?php

namespace App\Constant;

class Constant
{
    /// Special Username & Email in Application
    const SPECIAL_EMAIL = 'superadmin@gmail.com';
    const SPECIAL_USERNAME = 'superadmin';

    /// Global Key Session
    const KEY_SESSION_MODUL_MENU = "session-modul-menu";

    /// Path Image or File
    const PATH_IMAGE_EXAMPLE = "images/example";
    const PATH_DEFAULT_IMAGE = "assets/images/samples/broken-image.png";

    /// Digunakan untuk migration table
    const STATUSENUM = ['active', 'not_active', 'none'];
    const STATUSKEYVALUE = ['active' => "Aktif", 'not_active' => "Tidak Aktif", 'none' => "Tidak Diketahui"];


    /// Table Name Constant
    const TABLE_APP_MODUL = 'app_modul';
    const TABLE_APP_MENU = 'app_menu';
    const TABLE_APP_USER = 'users';
    const TABLE_APP_GROUP_USER = 'app_group_user';
    const TABLE_APP_ACCESS_MODUL = 'app_access_modul';
    const TABLE_APP_ACCESS_MENU = 'app_access_menu';
    const TABLE_MST_CATEGORY = 'master_category';
    const TABLE_MST_DATA = 'master_data';
    const TABLE_EXAMPLE = "example";
    const TABLE_PARAMETER = "parameter";

    const LIST_AVAILABLE_ACCESS = ['view', 'add', 'delete', 'edit', 'print', 'export', 'import', 'approve'];

    const TABLE_PROFILE = 'profile';
    const TABLE_PORTFOLIO = 'portfolio';
    const TABLE_PORTFOLIO_TECHNOLOGY = 'portfolio_technology';
    const TABLE_PORTFOLIO_IMAGE = 'portfolio_image';
    const TABLE_WORK_EXPERIENCE = 'work_experience';


    const PATH_IMAGE_PROFILE = "images/profile";
    const PATH_IMAGE_COMPANY = "images/company";
    const PATH_IMAGE_BANNER_PORTFOLIO = "images/portfolio/banner";
    const PATH_IMAGE_PREVIEW_PORTFOLIO = "images/portfolio/preview";
}
