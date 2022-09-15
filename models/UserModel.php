<?php

include_once("BaseModel.php");

class UserModel extends BaseModel
{
    protected static $table = "users";
    public $fillable = [
        'id',
        'name',
        'facebook_id',
        'password',
        'email',
        'avatar',
        'status',
        'ins_id',
        'upd_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag',
    ];
}
