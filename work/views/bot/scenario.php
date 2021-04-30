<style>
    .imgcontainer,.textcontainer{
        float:left;
        padding:15px;
        padding-bottom:5px;
    }
    .textcontainer{
        width:calc(100% - 84px);
    }
    .bgwhite{
        background:white;
        border-radius: 8px;
        padding:30px;
    }
    .answerbox{
        border: 1px solid rgba(75, 119, 166, 0.7);
        box-sizing: border-box;
        border-radius: 8px;
        padding:10px 20px;
        height:auto;
        color: #24282D;
        font-size:15px;
        position:relative;
        min-height:85px;
    }
    .answerbox>div:first-of-type{
        min-height:65px;
        outline:none;
        margin-bottom:30px;
    }
    .answerbox .editbox-control{
        margin-top:10px;
        position:absolute;
        bottom:10px;
    }
    .answerbox .editbox-control button{
        background: #EDF2F7;
        border-radius: 8px;
        border:0px;
        height:30px;
        width:30px;
        text-align:center;
    }
    .addanswer{
        background: #FFFFFF;
        border: 1px solid #D1D9E0;
        box-sizing: border-box;
        border-radius: 8px;
        padding:18px 15px;
        width:100%;
        color: #24282D99;
        text-align:left;
    }
    .float-right{
        float:right;
    }
    #speed-button{
        background: transparent;
        border: 0px;
        min-width: 320px;
        color: #4B77A6;
        outline: none;

    }
    a,a:hover,a:focus{
        color: #4B77A6;
    }
    .t16{
        font-size: 16px;
        line-height: 15px;
    }
    .btnvk{
        background: #4B77A6;
        border-radius: 50px;
        font-size: 16px;
        line-height: 15px;
        color:white;
        padding:17px 80px;
    }
    .btnvk:hover{
        color:white;
    }
    .btnvkorange{
        border: 2px solid #F64747;
        box-sizing: border-box;
        border-radius: 50px;
        background:transparent;
        font-size: 16px;
        line-height: 15px;
        color:white;
        padding:13px 20px;;
    }
    .panel-vk{
        border: 2px solid #D1D9E0;
        box-sizing: border-box;
        border-radius: 8px;
        background:transparent;
        color: #4B77A6;
        font-size: 15px;
        padding:15px;
        margin-top:40px;
    
    }
    .panel-vk span{
        color: #24282D;
        font-size: 14px;
        margin-top:23px;
        display:block;
    }
    .btnvkwhite{
        background: #FFFFFF;
        border-radius: 50px;
        
        font-size: 16px;
        line-height: 15px;
        color: #4B77A6;
        padding-top:17px;
        padding-bottom:17px;
        border:0px;
        margin-top:30px;
    }
    .col-lg-4>.btnvkwhite{
        padding-top:4px;
        padding-bottom:4px;
        margin-left:4px;
        margin-right:4px;
        
    }
    .btnvk-checker:first-of-type{
        border-radius: 8px 0px 0px 8px;
    }
    .btnvk-checker:last-of-type{
        border-radius: 0px 8px 8px 0px;
    }
    .btnvk-checker.active{
        background: #4B77A6;
        /* Blue vk */
        border: 1px solid #4B77A6;
        box-sizing: border-box;
        
        color:white;
    }
    .btnvk-checker{
        background: transparent;
        /* Blue vk */
        border: 1px solid #4B77A6;
        box-sizing: border-box;
        
        padding-top:14px ;
        padding-bottom:14px ;
        width:150px;
    }
    .modal .alert{
        font-weight: normal;
        font-size: 12px;
        line-height: 150%;
    }
    .modal .alert .uppertext{
        font-weight: bold;
        text-transform:uppercase;
    }
</style>
<?php
use app\widgets\Submenu;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use app\components\MacrosHandler;
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
            "Настройки"=>["class"=>"active","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
            "Сценарий"=>["class"=>"","href"=>Url::to(["/constructor/create"])],
            "Рассылка"=>["class"=>"","href"=>Url::to(["/constructor/create"])],
            "Статистика"=>["class"=>"","href"=>Url::to(["/bot","id"=>$bot->id])]
        
        ]]) ?>


<h3>Реакции бота</h3>
<div class="col-lg-8 formcontainer bgwhite">
    Бот напишет: 
        
        <select name="speed" id="speed">
          <option>в случайном порядке, повторяясь</option>
          <option>в случайном порядке, не повторяясь</option>
          <option >по порядку</option>
          
        </select>
    
    
    <?php ActiveForm::begin(["id"=>"actionform","options"=>["style"=>"margin-top:22px;"]])?>
        <div class="form-group">
            <div class="form-control answerbox"  >
                <div contenteditable>
                <?=($action?$action->text:"")?>
                </div>
            <!-- Панель блока ответа с макросами и управлением -->
                <div class="editbox-control" >
                    <button type=button>
                       <svg width="14" fill="none" xmlns="http://www.w3.org/2000/svg" height="19" viewBox="0 -4 14 15">
                            <path d="M6.99301 0.333333C3.31301 0.333333 0.333008 3.32 0.333008 7C0.333008 10.68 3.31301 13.6667 6.99301 13.6667C10.6797 13.6667 13.6663 10.68 13.6663 7C13.6663 3.32 10.6797 0.333333 6.99301 0.333333ZM6.99967 12.3333C4.05301 12.3333 1.66634 9.94667 1.66634 7C1.66634 4.05333 4.05301 1.66667 6.99967 1.66667C9.94634 1.66667 12.333 4.05333 12.333 7C12.333 9.94667 9.94634 12.3333 6.99967 12.3333ZM9.33301 6.33333C9.88634 6.33333 10.333 5.88667 10.333 5.33333C10.333 4.78 9.88634 4.33333 9.33301 4.33333C8.77967 4.33333 8.33301 4.78 8.33301 5.33333C8.33301 5.88667 8.77967 6.33333 9.33301 6.33333ZM4.66634 6.33333C5.21967 6.33333 5.66634 5.88667 5.66634 5.33333C5.66634 4.78 5.21967 4.33333 4.66634 4.33333C4.11301 4.33333 3.66634 4.78 3.66634 5.33333C3.66634 5.88667 4.11301 6.33333 4.66634 6.33333ZM6.99967 10.6667C8.55301 10.6667 9.87301 9.69333 10.4063 8.33333H3.59301C4.12634 9.69333 5.44634 10.6667 6.99967 10.6667Z" fill="#4B77A6"></path>
                        </svg>
                    </button>
                    <button type=button>
                        <svg width="14" fill="none" xmlns="http://www.w3.org/2000/svg" height="19" viewBox="0 -6 14 15">
                            <path d="M0.333008 4.33333C0.333008 2.30667 1.97301 0.666667 3.99967 0.666667H10.9997C12.473 0.666667 13.6663 1.86 13.6663 3.33333C13.6663 4.80667 12.473 6 10.9997 6H5.33301C4.41301 6 3.66634 5.25333 3.66634 4.33333C3.66634 3.41333 4.41301 2.66667 5.33301 2.66667H10.333V4H5.27301C4.90634 4 4.90634 4.66667 5.27301 4.66667H10.9997C11.733 4.66667 12.333 4.06667 12.333 3.33333C12.333 2.6 11.733 2 10.9997 2H3.99967C2.71301 2 1.66634 3.04667 1.66634 4.33333C1.66634 5.62 2.71301 6.66667 3.99967 6.66667H10.333V8H3.99967C1.97301 8 0.333008 6.36 0.333008 4.33333Z" fill="#4B77A6"></path>
                        </svg>
                    </button>
                    <button type=button>
                        <svg width="14" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 6" height="20">
                            <path d="M11.7597 7.62667C11.7864 7.42667 11.7997 7.22 11.7997 7C11.7997 6.78667 11.7864 6.57333 11.7531 6.37333L13.1064 5.32C13.2264 5.22667 13.2597 5.04667 13.1864 4.91333L11.9064 2.7C11.8264 2.55333 11.6597 2.50667 11.5131 2.55333L9.91975 3.19333C9.58641 2.94 9.23308 2.72667 8.83975 2.56667L8.59975 0.873333C8.57308 0.713333 8.43975 0.6 8.27975 0.6H5.71975C5.55975 0.6 5.43308 0.713333 5.40641 0.873333L5.16641 2.56667C4.77308 2.72667 4.41308 2.94667 4.08641 3.19333L2.49308 2.55333C2.34641 2.5 2.17975 2.55333 2.09975 2.7L0.826414 4.91333C0.746414 5.05333 0.773081 5.22667 0.906414 5.32L2.25975 6.37333C2.22641 6.57333 2.19975 6.79333 2.19975 7C2.19975 7.20667 2.21308 7.42667 2.24641 7.62667L0.893081 8.68C0.773081 8.77333 0.739748 8.95333 0.813081 9.08667L2.09308 11.3C2.17308 11.4467 2.33975 11.4933 2.48641 11.4467L4.07975 10.8067C4.41308 11.06 4.76641 11.2733 5.15975 11.4333L5.39975 13.1267C5.43308 13.2867 5.55975 13.4 5.71975 13.4H8.27975C8.43975 13.4 8.57308 13.2867 8.59308 13.1267L8.83308 11.4333C9.22641 11.2733 9.58642 11.06 9.91308 10.8067L11.5064 11.4467C11.6531 11.5 11.8197 11.4467 11.8997 11.3L13.1797 9.08667C13.2597 8.94 13.2264 8.77333 13.0997 8.68L11.7597 7.62667ZM6.99975 9.4C5.67975 9.4 4.59975 8.32 4.59975 7C4.59975 5.68 5.67975 4.6 6.99975 4.6C8.31975 4.6 9.39975 5.68 9.39975 7C9.39975 8.32 8.31975 9.4 6.99975 9.4Z" fill="#4B77A6"></path>
                        </svg>
                    </button>
                    <button type=button>
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" height="20" width="16" viewBox="1 -1 16 4">
                            <path d="M5.18021 1.50667L4.15354 0.653334L0.546875 5L4.15354 9.34667L5.18021 8.49333L2.28021 5L5.18021 1.50667ZM4.66687 5.66667H6.00021V4.33333H4.66687V5.66667ZM11.3335 4.33333H10.0002V5.66667H11.3335V4.33333ZM7.33354 5.66667H8.66687V4.33333H7.33354V5.66667ZM11.8469 0.653334L10.8202 1.50667L13.7202 5L10.8202 8.49333L11.8469 9.34667L15.4535 5L11.8469 0.653334Z" fill="#4B77A6"></path>
                        </svg>
                    </button>
                    
                </div>
            </div>
            <textarea class="form-control answerbox hide" name=text><?=($action?$action->text:"")?></textarea>
            <select class="macrossel">
                <option value=0>Вставить макрос</option>
                <?php foreach(MacrosHandler::options() as $k=>$val) {
                    echo "<option value='$val'>$k</option>";
                } ?>
                
            </select>
        </div>
        <!--<button class="btn btn-primary">Сохранить</button>-->
    <?php ActiveForm::end()?>
    <button class=" addanswer">Добавить вариант ответа
        <svg class="float-right" width="18" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 -5 18 18" height="14">
            <path d="M14 8H8V14H6V8H0V6H6V0H8V6H14V8Z" fill="#D1D9E0"></path>
        </svg>
    </button>
</div>
<div class="col-lg-4 leftblock">
    <a href="<?=Url::to(["/constructor/edit","id"=>$bot->id])?>" class="t16">
        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.19926 9.13375L2.57342 5.5L6.19926 1.86625L5.08301 0.75L0.333008 5.5L5.08301 10.25L6.19926 9.13375Z" fill="#4B77A6"/>
        </svg>
        Назад к настройкам
    </a>
    
    <div style="margin-top:35px;">
        <button class="btn btnvk" onclick="console.log($('.answerbox>div:first-of-type').parent().parent().find('textarea'));$('.answerbox>div:first-of-type').parent().parent().find('textarea').val($('.answerbox>div:first-of-type').html());alert();$('#actionform').submit();">Сохранить</button>
    
        <button class="btn btnvkorange">
            <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.5 16C1.5 17.1 2.4 18 3.5 18H11.5C12.6 18 13.5 17.1 13.5 16V4H1.5V16ZM3.5 6H11.5V16H3.5V6ZM11 1L10 0H5L4 1H0.5V3H14.5V1H11Z" fill="#F64747"/>
            </svg>
        </button>
    </div>
    <div class="panel-vk">
        <b>Команда <b class="enabledaction"><?=($action->enabled?"включена":" выключена")?></b>
        <div class="toggle-button-cover">
              <div class="button-cover">
                <div class="button r" id="button-1">
                  <input type="checkbox" class="checkbox"  onchange="$.get('/bot/action?id=5&action=3&enabled='+(this.value));if($('.enabledaction').html()=='включена')$('.enabledaction').html('выключена');else $('.enabledaction').html('включена');" <?=($action->enabled?"checked=checked":"")?>>
                  <div class="knobs"></div>
                  <div class="layer"></div>
                </div>
              </div>
            </div>
        </b>
        <span>Команда использовалась: <?=($action->uses?$action->uses:0)?> раз</span>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button class="btnvkwhite col-lg-12" data-toggle="modal" data-target="#myModal">
                <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.333 0.333336H1.66634C0.933008 0.333336 0.339674 0.933336 0.339674 1.66667L0.333008 8.33334C0.333008 9.06667 0.933008 9.66667 1.66634 9.66667H12.333C13.0663 9.66667 13.6663 9.06667 13.6663 8.33334V1.66667C13.6663 0.933336 13.0663 0.333336 12.333 0.333336ZM6.33301 2.33334H7.66634V3.66667H6.33301V2.33334ZM6.33301 4.33334H7.66634V5.66667H6.33301V4.33334ZM4.33301 2.33334H5.66634V3.66667H4.33301V2.33334ZM4.33301 4.33334H5.66634V5.66667H4.33301V4.33334ZM3.66634 5.66667H2.33301V4.33334H3.66634V5.66667ZM3.66634 3.66667H2.33301V2.33334H3.66634V3.66667ZM9.66634 8.33334H4.33301V7H9.66634V8.33334ZM9.66634 5.66667H8.33301V4.33334H9.66634V5.66667ZM9.66634 3.66667H8.33301V2.33334H9.66634V3.66667ZM11.6663 5.66667H10.333V4.33334H11.6663V5.66667ZM11.6663 3.66667H10.333V2.33334H11.6663V3.66667Z" fill="#4B77A6"/>
                </svg>
                Клавиатура команды
            </button>
        </div>
        <div class="col-md-4">
            <button class="btnvkwhite col-lg-12">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H2V20C2 21.1 2.9 22 4 22H18V20H4V6Z" fill="#4B77A6"/>
                    <path d="M20 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 12L17.5 10.5L15 12V4H20V12Z" fill="#4B77A6"/>
                </svg>
            </button>
        </div>
        <div class="col-md-4">
            <button class="btnvkwhite col-lg-12">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.77031 6.76L6.23031 5.48L0.820312 12L6.23031 18.52L7.77031 17.24L3.42031 12L7.77031 6.76ZM7.00031 13H9.00031V11H7.00031V13ZM17.0003 11H15.0003V13H17.0003V11ZM11.0003 13H13.0003V11H11.0003V13ZM17.7703 5.48L16.2303 6.76L20.5803 12L16.2303 17.24L17.7703 18.52L23.1803 12L17.7703 5.48Z" fill="#4B77A6"/>
                </svg>
            </button>
        </div>
        <div class="col-md-4">
            <button class="btnvkwhite col-lg-12">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="#4B77A6"/>
                </svg>
            </button>
        </div>
        
    </div>
</div>


<div class="col-lg-8 bgwhite">
    <h4>Настройки переходов</h4>
    <div class="toggle-button-cover float-right" style="margin-top: -30px;">
              <div class="button-cover">
                <div class="button r" id="button-1">
                  <input type="checkbox" class="checkbox"  onchange="$.get('/bot/action?id=5&action=3&enabled='+(this.value));if($('.enabledaction').html()=='включена')$('.enabledaction').html('выключена');else $('.enabledaction').html('включена');" <?=($action->enabled?"checked=checked":"")?>>
                  <div class="knobs"></div>
                  <div class="layer"></div>
                </div>
              </div>
            </div>
    <div>
        <input type=radio> Перейти на другую команду если <span class="circle">?</span><br>
        <input type=radio> После ответа мнговенно перейти на другую команду <span class="circle">?</span><br>
        
        <div class="form-group" style="margin-top:30px;">
            <label style="color:#0009;font-weight: normal;">Если следующее сообщение пользователя равно одному из ключевых слов</label>
            <div class="form-control answerbox" contenteditable><?=($action?$action->text:"")?>
            
            <!-- Панель блока ответа с макросами и управлением -->
                <div class="editbox-control" contenteditable="false">
                    <button type=button>
                       <svg width="14" fill="none" xmlns="http://www.w3.org/2000/svg" height="19" viewBox="0 -4 14 15">
                            <path d="M6.99301 0.333333C3.31301 0.333333 0.333008 3.32 0.333008 7C0.333008 10.68 3.31301 13.6667 6.99301 13.6667C10.6797 13.6667 13.6663 10.68 13.6663 7C13.6663 3.32 10.6797 0.333333 6.99301 0.333333ZM6.99967 12.3333C4.05301 12.3333 1.66634 9.94667 1.66634 7C1.66634 4.05333 4.05301 1.66667 6.99967 1.66667C9.94634 1.66667 12.333 4.05333 12.333 7C12.333 9.94667 9.94634 12.3333 6.99967 12.3333ZM9.33301 6.33333C9.88634 6.33333 10.333 5.88667 10.333 5.33333C10.333 4.78 9.88634 4.33333 9.33301 4.33333C8.77967 4.33333 8.33301 4.78 8.33301 5.33333C8.33301 5.88667 8.77967 6.33333 9.33301 6.33333ZM4.66634 6.33333C5.21967 6.33333 5.66634 5.88667 5.66634 5.33333C5.66634 4.78 5.21967 4.33333 4.66634 4.33333C4.11301 4.33333 3.66634 4.78 3.66634 5.33333C3.66634 5.88667 4.11301 6.33333 4.66634 6.33333ZM6.99967 10.6667C8.55301 10.6667 9.87301 9.69333 10.4063 8.33333H3.59301C4.12634 9.69333 5.44634 10.6667 6.99967 10.6667Z" fill="#4B77A6"></path>
                        </svg>
                    </button>
                    
                    
                </div>
            </div>
            <p style="font-size:15px;color: #00000088;">Ключевые слова через запятую</p>
        </div>
        
        <div class="">
            <button class="btnvk-checker active">Сценарий</button><button class="btnvk-checker">Настройки</button>
            <button class=" addanswer" style="margin-top:20px;">Добавить вариант ответа
                <svg class="float-right" fill="none" xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 -7 12 18">
                    <path d="M1.41 0.590027L6 5.17003L10.59 0.590027L12 2.00003L6 8.00003L0 2.00003L1.41 0.590027Z" fill="#D1D9E0"></path>
                </svg>
            </button>
            
            <button class="btnvkwhite" style="border: 1px solid #4B77A6;width:230px;"> 
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.66634 5.66665H5.66634V9.66665H4.33301V5.66665H0.333008V4.33331H4.33301V0.333313H5.66634V4.33331H9.66634V5.66665Z" fill="#4B77A6"/>
                </svg>
                Добавить переход
            </button>
        </div>
    </div>
</div>







<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Клавиатура</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
            <svg style="float: left;
margin: 7px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5H11V7H9V5ZM9 9H11V15H9V9ZM10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z" fill="#F64747"/>
            </svg>
            Клавиатура работает только для сообществ с тарифом "Начальный" или выше.
            <br>
            <a class="uppertext" href="">Купить подписку</a>
        </div>
        <div class="alert alert-warning">
            <svg style="float: left;margin: 7px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5H11V7H9V5ZM9 9H11V15H9V9ZM10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z" fill="#F64747"/>
            </svg>
            Для работы клавиатуры обязательно должны быть включены "Возможности ботов" в настройках группы ВКонтакте.
            <br>
            <a href="">Скрыть уведомление</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>









<?php
$this->registerJs(<<<JS

$(".btnvk-checker").click(function(){
    if(!$(this).hasClass(".active")){
        $(".btnvk-checker").parent().find(".btnvk-checker").removeClass("active");
        $(this).addClass("active");
    }
});

$( "#speed" ).selectmenu();

$(".addanswer").click(function(){
    var btn = $(this).detach();
    var elem = $(".formcontainer").find(".form-group").last().clone();
    $(elem).find("span").remove();
    $(elem).find("select").show();
    $(".formcontainer form").append(elem);
    $(".formcontainer").append(btn);
    $(elem).find("select").selectmenu({
        change:changesel
    });
    $( ".macrossel" ).selectmenu( "destroy" );
    /**/
    $( ".macrossel" ).selectmenu({
        change:changesel
    });
    
});

function changesel(event, ui){
 var parent = $(this).parent();
            if(ui.item.value!=0){
                var pos = $(parent).find("textarea").prop("selectionStart");
                var endpos = $(parent).find("textarea").prop("selectionEnd");
                $(parent).find("textarea").val(  $(parent).find("textarea").val().substring(0, pos)
                    + ui.item.value
                    +$(parent).find("textarea").val().substring(endpos, $(parent).find("textarea").val().length)
                    );
                $(this).val(0);
                $( this ).selectmenu( "refresh" );
                console.log("345");
            }
}

$( ".macrossel" ).selectmenu({
    change:changesel
});

JS
,View::POS_READY
);

?>
