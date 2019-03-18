<?php
/**
 * AttributeEvent
 *
 * @copyright Copyright © 2019 Absoft. All rights reserved.
 * @author    dattt@absoft.com.vn
 */

namespace frontend\components;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

class AttributeEvent implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        ModelEvent::on(ActiveRecord::className(), BaseActiveRecord::EVENT_BEFORE_INSERT, function ($event) {
            $event->sender->created_at = strtotime('now');
            $event->sender->updated_at = strtotime('now');

        });
        // TODO: Implement bootstrap() method.
    }
}