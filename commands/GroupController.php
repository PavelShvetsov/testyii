<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\rbac\UserGroupRule;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GroupController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        $rule = new \app\rbac\UserGroupRule;
        $auth->add($rule);

        $author = $auth->createRole('author');
        $author->ruleName = $rule->name;
        $auth->add($author);
// ... add permissions as children of $author ...

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $author);
    }
}
