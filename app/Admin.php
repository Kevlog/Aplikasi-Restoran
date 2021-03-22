<?php

namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Admin extends Authenticatable
    {
        use Notifiable;
        public $timestamps = false;
        protected $guard = 'admin';
        protected $table = 'admin';

        protected $fillable = [
            'username_admin', 'nama_admin', 'password_admin',
        ];

        protected $hidden = [
            'password_admin', 'remember_token',
        ];

        public function username()
        {
            return $this->username_admin;
        }

        public function getAuthPassword()
        {
          return $this->password_admin;
        }

        protected $primaryKey = 'id_admin';
    }
