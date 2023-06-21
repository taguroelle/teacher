<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class User extends Model{
protected $table = 'teachers';
protected $timestamps = false;
protected $primarykey = 'teacher_id';


// column sa table
protected $fillable = [
'dept_id', 'firstname', 'lastname', 'middlename', 'gender', 'contact_no', 'email_address', 'address'
];

}