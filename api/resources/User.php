<?php

namespace api\resources

use backend\models\User;

class AuthUser extends User{
    public function fields()
    {
        $fields = parent::fields();
    
        $fields['auth-token'] = '';

        return $fields;
    }
}

