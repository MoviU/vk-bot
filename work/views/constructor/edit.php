<style>
    .imgcontainer,.textcontainer{
        float:left;
        padding:15px;
        padding-bottom:5px;
    }
    .textcontainer{
        width:calc(100% - 84px);
    }
	.badge-danger{
		background-color:red;
	}
</style>
<?php
use app\widgets\Submenu;
use yii\helpers\Url;
use yii\web\View;
use app\models\Botactions;
?>

<?= Submenu::widget(["left"=>
        [
            "<i class='fa fa-arrow-left' style='font-size:20px;'></i>"=>["class"=>"","href"=>Url::to(["/constructor"])],
            ($bot->group?"<img class='img-circle' style='float:left;margin-top:10px;margin-right:10px;' src='".$bot->group->img."'>":"").
            " <div class='' style='float:left;line-height: 18px;margin-top: 20px;margin-right: 20px;font-size: 14px;color: #24282D;'>".$bot->name."<br>".($bot->group?"<span style='font-size: 13px;
line-height: 12px;color: #24282D;'>".$bot->group->name."</span>":"")."</div>"=>["class"=>"","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
        ($bot->group?('<button class="writebotbtn" onclick="window.open(\'https://vk.com/club'.$bot->group->group_id.'\')"><img src="/img/vk.svg">
Написать боту</button>'):"")
        
        ],"right"=>[
            "Конструктор"=>["class"=>"active","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
            "Сценарий"=>["class"=>"","href"=>Url::to(["/constructor/commands","id"=>$bot->id])],
            "Рассылка"=>["class"=>"","href"=>Url::to(["/bot/mailing","id"=>$bot->id])],
            "Статистика"=>["class"=>"","href"=>Url::to(["/bot","id"=>$bot->id])]
        
        ]]) ?>



<h3 style="margin-top:50px;margin-bottom:25px;">Реакции бота</h3>

<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">Основные сообщения</a></li>
    <?php if($bot->tariff->media){?>
		<li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Ответы на медиафайлы</a></li>
	<?php } ?>
  </ul>
 <div class="tab-content">
<div class="col-lg-8 tab-pane active" id="tab1" style="padding-left:0px;">
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_FIRST_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg style="" width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M7 7H35V28H9.0475L7 30.0475V7ZM7 3.5C5.075 3.5 3.5175 5.075 3.5175 7L3.5 38.5L10.5 31.5H35C36.925 31.5 38.5 29.925 38.5 28V7C38.5 5.075 36.925 3.5 35 3.5H7ZM10.5 21H24.5V24.5H10.5V21ZM10.5 15.75H31.5V19.25H10.5V15.75ZM10.5 10.5H31.5V14H10.5V10.5Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Приветственные сообщения</b>
                <p>Реакция на первое сообщение пользователя боту, срабатывает только 1 раз</p>
            </div>
        </div>
        </a>
    </div>
    
    
    
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_SUBSCRIBE])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M35 7H7C5.075 7 3.5175 8.575 3.5175 10.5L3.5 31.5C3.5 33.425 5.075 35 7 35H35C36.925 35 38.5 33.425 38.5 31.5V10.5C38.5 8.575 36.925 7 35 7ZM35 31.5H7V14L21 22.75L35 14V31.5ZM21 19.25L7 10.5H35L21 19.25Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Реакция на подписку</b>
                <p>Сработает только, если пользователь писал в сообщество</p>
            </div>
        </div>
        </a>
    </div>
    
    
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_UNSUBSCRIBE])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M36.7325 24.57V8.75C36.7325 6.825 35.1575 5.25 33.2325 5.25H8.75C6.825 5.25 5.25 6.825 5.25 8.75V26.25C5.25 28.175 6.825 29.75 8.75 29.75H26.3375C26.8275 33.11 30.0125 35.6125 33.6525 34.8775C35.9975 34.405 37.905 32.48 38.3775 30.135C38.815 27.965 38.0975 25.9525 36.7325 24.57ZM33.2325 8.75L21 14.875L8.75 8.75H33.2325ZM26.8625 26.25H8.75V12.25L21 18.375L33.25 12.25V22.8375C32.97 22.8025 32.6725 22.75 32.375 22.75C29.9425 22.75 27.8425 24.185 26.8625 26.25ZM35.875 29.75H28.875V28H35.875V29.75Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Реакция на отписку</b>
                <p>Сработает, только если пользователь писал в сообщество</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_UKNOW])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M33.25 3.5H8.75C6.8075 3.5 5.25 5.075 5.25 7V31.5C5.25 33.425 6.8075 35 8.75 35H15.75L21 40.25L26.25 35H33.25C35.175 35 36.75 33.425 36.75 31.5V7C36.75 5.075 35.175 3.5 33.25 3.5ZM33.25 31.5H24.7975L23.765 32.5325L21 35.2975L18.2175 32.515L17.2025 31.5H8.75V7H33.25V31.5ZM19.25 26.25H22.75V29.75H19.25V26.25ZM21 12.25C22.925 12.25 24.5 13.825 24.5 15.75C24.5 19.25 19.25 18.8125 19.25 24.5H22.75C22.75 20.5625 28 20.125 28 15.75C28 11.8825 24.8675 8.75 21 8.75C17.1325 8.75 14 11.8825 14 15.75H17.5C17.5 13.825 19.075 12.25 21 12.25Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Реакция на неизвестную команду</b>
                <p>Ответ на любое сообщение не по сценарию</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_ACCESS_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M21 3.5C11.34 3.5 3.5 11.34 3.5 21C3.5 30.66 11.34 38.5 21 38.5C30.66 38.5 38.5 30.66 38.5 21C38.5 11.34 30.66 3.5 21 3.5ZM21 35C13.2825 35 7 28.7175 7 21C7 13.2825 13.2825 7 21 7C28.7175 7 35 13.2825 35 21C35 28.7175 28.7175 35 21 35ZM29.0325 13.265L17.5 24.7975L12.9675 20.2825L10.5 22.75L17.5 29.75L31.5 15.75L29.0325 13.265Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Реакция на разрешение сообщений</b>
                <p>Срабатывает, когда пользователь разрешает сообществу отправлять ему сообщения</p>
            </div>
        </div>
        </a>
    </div>
    
</div>

<?php if($bot->tariff->media):?>
<div class="col-lg-8 tab-pane" id="tab2" style="padding-left:0px;">
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_IMAGE_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M35 7H29.4525L26.25 3.5H15.75L12.5475 7H7C5.075 7 3.5 8.575 3.5 10.5V31.5C3.5 33.425 5.075 35 7 35H35C36.925 35 38.5 33.425 38.5 31.5V10.5C38.5 8.575 36.925 7 35 7ZM35 31.5H7V10.5H14.0875L17.29 7H24.71L27.9125 10.5H35V31.5ZM21 12.25C16.17 12.25 12.25 16.17 12.25 21C12.25 25.83 16.17 29.75 21 29.75C25.83 29.75 29.75 25.83 29.75 21C29.75 16.17 25.83 12.25 21 12.25ZM21 26.25C18.1125 26.25 15.75 23.8875 15.75 21C15.75 18.1125 18.1125 15.75 21 15.75C23.8875 15.75 26.25 18.1125 26.25 21C26.25 23.8875 23.8875 26.25 21 26.25Z" fill="#4B77A6"/>
                </svg>

            </div>
            <div class="textcontainer">
                <b>Ответ на картинку</b>
                <p>Реакция на сообщение с картинкой</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_VIDEO_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M15.75 12.25V26.25L28 19.25L15.75 12.25ZM36.75 5.25H5.25C3.325 5.25 1.75 6.825 1.75 8.75V29.75C1.75 31.675 3.325 33.25 5.25 33.25H14V36.75H28V33.25H36.75C38.675 33.25 40.25 31.675 40.25 29.75V8.75C40.25 6.825 38.675 5.25 36.75 5.25ZM36.75 29.75H5.25V8.75H36.75V29.75Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Ответ на видео</b>
                <p>Реакция на сообщение с видео</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_PRODUCT_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M37.4675 20.265L21.7175 4.515C21.0875 3.885 20.2125 3.5 19.25 3.5H7C5.075 3.5 3.5 5.075 3.5 7V19.25C3.5 20.2125 3.885 21.0875 4.5325 21.735L20.2825 37.485C20.9125 38.115 21.7875 38.5 22.75 38.5C23.7125 38.5 24.5875 38.115 25.2175 37.4675L37.4675 25.2175C38.115 24.5875 38.5 23.7125 38.5 22.75C38.5 21.7875 38.0975 20.895 37.4675 20.265ZM22.75 35.0175L7 19.25V7H19.25V6.9825L35 22.7325L22.75 35.0175Z" fill="#4B77A6"/>
                <path d="M11.375 14C12.8247 14 14 12.8247 14 11.375C14 9.92525 12.8247 8.75 11.375 8.75C9.92525 8.75 8.75 9.92525 8.75 11.375C8.75 12.8247 9.92525 14 11.375 14Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Ответ на товар</b>
                <p>Реакция на сообщение с товаром</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_SMILE_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M20.9825 3.5C11.3225 3.5 3.5 11.34 3.5 21C3.5 30.66 11.3225 38.5 20.9825 38.5C30.66 38.5 38.5 30.66 38.5 21C38.5 11.34 30.66 3.5 20.9825 3.5ZM21 35C13.265 35 7 28.735 7 21C7 13.265 13.265 7 21 7C28.735 7 35 13.265 35 21C35 28.735 28.735 35 21 35ZM27.125 19.25C28.5775 19.25 29.75 18.0775 29.75 16.625C29.75 15.1725 28.5775 14 27.125 14C25.6725 14 24.5 15.1725 24.5 16.625C24.5 18.0775 25.6725 19.25 27.125 19.25ZM14.875 19.25C16.3275 19.25 17.5 18.0775 17.5 16.625C17.5 15.1725 16.3275 14 14.875 14C13.4225 14 12.25 15.1725 12.25 16.625C12.25 18.0775 13.4225 19.25 14.875 19.25ZM21 30.625C25.0775 30.625 28.5425 28.07 29.9425 24.5H12.0575C13.4575 28.07 16.9225 30.625 21 30.625Z" fill="#4B77A6"/>
                </svg>
            </div>
            <div class="textcontainer">
                <b>Ответ на стикер</b>
                <p>Реакция на сообщение со стикером</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_DOCUMENT_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M14 28H28V31.5H14V28ZM14 21H28V24.5H14V21ZM24.5 3.5H10.5C8.575 3.5 7 5.075 7 7V35C7 36.925 8.5575 38.5 10.4825 38.5H31.5C33.425 38.5 35 36.925 35 35V14L24.5 3.5ZM31.5 35H10.5V7H22.75V15.75H31.5V35Z" fill="#4B77A6"/>
                </svg>


            </div>
            <div class="textcontainer">
                <b>Ответ на документ</b>
                <p>Реакция на сообщение с документом</p>
            </div>
        </div>
        </a>
    </div>
    <div class="panel panel-default">
        <a href="<?=Url::to(["/bot/action","id"=>$bot->id,"action"=>Botactions::TYPE_AUDIO_MSG])?>">
        <div class="panel-body">
            <div class="imgcontainer">
                <svg width="53" height="46" viewBox="0 0 53 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52.4592 27.2014C51.6504 31.6815 50.1581 33.4908 48.8198 35.7544C42.9564 43.2891 36.9892 47.4632 27.388 45.5292C13.4372 42.7189 10 36.4118 10 25.165C10 13.9181 20.8719 6.22626 32.0383 6.22626C35.6777 6.02263 42.552 5.00441 48.8198 9.89182C53.8745 14.9829 53.2679 21.7031 52.4592 27.2014Z" fill="#EDF2F7"/>
                <path d="M21 24.5C23.905 24.5 26.25 22.155 26.25 19.25V8.75C26.25 5.845 23.905 3.5 21 3.5C18.095 3.5 15.75 5.845 15.75 8.75V19.25C15.75 22.155 18.095 24.5 21 24.5ZM19.25 8.75C19.25 7.7875 20.0375 7 21 7C21.9625 7 22.75 7.7875 22.75 8.75V19.25C22.75 20.2125 21.9625 21 21 21C20.0375 21 19.25 20.2125 19.25 19.25V8.75ZM29.75 19.25C29.75 24.08 25.83 28 21 28C16.17 28 12.25 24.08 12.25 19.25H8.75C8.75 25.4275 13.3175 30.5025 19.25 31.36V36.75H22.75V31.36C28.6825 30.5025 33.25 25.4275 33.25 19.25H29.75Z" fill="#4B77A6"/>
                </svg>


            </div>
            <div class="textcontainer">
                <b>Ответ на аудиофайл</b>
                <p>Реакция на сообщение с аудиофайлом</p>
            </div>
        </div>
        </a>
    </div>
    
    
    
</div>
<?php endif; ?>
    
</div>
<div class="col-lg-4 leftblock">
    <div class="vkcolbox" >
        <b style="margin-bottom:10px;display:inline-block;">Тариф «<?=$bot->tariff->name?>»</b>
        <div>
			<?php if($bot->groups){ foreach($bot->groups as $group){?>
				<img src="<?=$group->img?>" style="width:50px;"><div style="float:right;width:calc(100% - 55px);"><?=$group->name?><br><?=(strtotime($group->paid)>time()?"Оплачен до<br> {$group->paid}":"<span class='badge badge-danger'>Неоплачен </span>")?></div>
				<br>
				<br>
			<?php }}else echo"Нет групп";?>
		</div>
        <button onclick="window.location.href='<?=URL::to(["/constructor/settariff","id"=>$bot->id])?>'" class="btn-white">Сменить тариф</button>
    </div>
    <!--
    <div class="panel panel-default">
        <div class="panel-body">
            Управление ботом<i class="fa fa-cog pull-right"></i>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            Ответить на пропуски<i class="fa fa-comments-o pull-right"></i>
        </div>
    </div>-->
    <div class="panel panel-default">
        <div class="panel-body">
            Бот сообщества <span class="enabled"><?=($bot->enabled?"включен":"выключен")?></span>
            <div class="toggle-button-cover">
              <div class="button-cover">
                <div class="button r" id="button-1">
                  <input type="checkbox" class="checkbox" data-bot_id=<?=$bot->id?> <?=($bot->enabled?"checked=checked":"")?>>
                  <div class="knobs"></div>
                  <div class="layer"></div>
                </div>
              </div>
            </div>
    
        </div>
    </div>
    
</div>
<?php
$this->registerJs(<<<JS
    $("input[type=checkbox]").change(function(){
        $.get("/constructor/enablebot",{id:$(this).data('bot_id')}).done(function(data){
                if(parseInt(data)==1){
                    $(".enabled").html("включен");
                }
                else
                    $(".enabled").html("выключен");
        });
    });
JS
,View::POS_LOAD
);
