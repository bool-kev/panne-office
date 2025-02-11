<?php

namespace App\Helper;
use App\Models\User;

    class Helper{
        public static function router(User $user)
        {
            if($user->role_id == 1) return route('citoyen.dashboard');
            elseif ($user->role_id == 2) return route('operateur.dashboard');
            elseif ($user->role_id == 3) return route('admin.dashboard');
        }
    }
?>