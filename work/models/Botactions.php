<?php

namespace app\models;
use yii\db\ActiveRecord;

class Botactions extends ActiveRecord {

     const TYPE_FIRST_MSG=0;
     const TYPE_SUBSCRIBE=1;
     const TYPE_UNSUBSCRIBE=2;
     const TYPE_UKNOW=3;
     const TYPE_ACCESS_MSG=4;
     //const TYPE_ACCESS_MSG=5;
     const TYPE_IMAGE_MSG=6;
     const TYPE_VIDEO_MSG=7;
     const TYPE_SMILE_MSG=8;
     const TYPE_PRODUCT_MSG=9;
     const TYPE_DOCUMENT_MSG=10;
     const TYPE_AUDIO_MSG=11;

}
