<?php

use yii\db\Migration;
use app\models\User;

class m161116_211902_create_users extends Migration
{
    public function up()
    {
        $admin = new User();
        $admin->username = 'admin';
        $admin->setPassword('admin');
        $admin->email = 'admin@admin.com';
        $admin->save();
    }

    public function down()
    {
        $admin = User::findByUsername('admin');
        if ($admin) {
            $admin->delete();
        }
    }
}
