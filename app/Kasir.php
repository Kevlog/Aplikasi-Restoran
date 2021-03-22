<?php

namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Kasir extends Authenticatable
    {
        use Notifiable;
        public $timestamps = false;
        protected $guard = 'kasir';
        protected $table = 'kasir';

        protected $fillable = [
            'username_kasir', 'nama_kasir', 'password_kasir',
        ];

        protected $hidden = [
            'password_kasir', 'remember_token',
        ];

        public function username()
        {
            return $this->username_kasir;
        }

        public function getAuthPassword()
        {
            return $this->password_kasir;
        }

        protected $primaryKey = 'id_kasir';
    }
