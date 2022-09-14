<?php

include_once("BaseModel.php");

class AdminModel extends BaseModel
{
    protected static $table = "admin";
    const ADMIN_PERMISSION = 'admin';
    const SUPER_ADMIN_PERMISSION = 'super admin';
    public $fillable = [
        'id',
        'name',
        'password',
        'email',
        'avatar',
        'role_type',
        'ins_id',
        'upd_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag',
    ];

    // public function __construct()
    // {
    // 	$this->tableName = 'admin_table';
    // }

}
