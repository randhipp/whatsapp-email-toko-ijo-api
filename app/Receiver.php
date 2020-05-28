<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $table = 'ws_user';

    protected $appends = ['year_of_birth'];

    protected $hidden = [
          'user_name',
          'user_pwd',
          'location',
          'messenger',
          'flag_email',
          'flag_messenger',
          'flag_birthdate',
          'flag_hp',
          'flag_img',
          'occupation',
          'company',
          'schools',
          'hobbies',
          'relationship',
          'about_me',
          'last_login',
          'deposit',
          'create_by',
          'create_time',
          'update_by',
          'update_time',
          'email_new',
          'email_cancel_code',
          'email_confirm_code',
          'reset_password_code',
          'profile_effective_date',
          'status_data',
          'shop_info',
          'lang',
          'user_pwd_1',
          'uniq_char',
          'activation_code',
          'status',
          'birth_date'
    ];

    /**
     * Get the receiver's year of birth.
     *
     * @return string
     */
    public function getYearOfBirthAttribute()
    {
        if($this->birth_date != null){
            $year = substr($this->birth_date,0,4);
            return "{$year}";
        }

        return $this->birth_date;
    }



}
