<?php

include_once("BaseModel.php");

class AdminModel extends BaseModel
{
    protected static $table = "admin";
    const ADMIN_PERMISSION = 'admin';
    const SUPER_ADMIN_PERMISSION = 'super admin';
}
