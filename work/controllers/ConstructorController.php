<?php
namespace app\controllers;

use Yii;

use app\models\Bot;
use app\models\Tariff;
use app\models\BotcommandForm;
use app\models\Vkgroups;
use yii\helpers\Html;
use app\models\Botcommand;
use app\models\BotcommandsHasVariables;
use app\models\SetRuleForm;
use app\models\VariablesHasData;

class ConstructorController extends DefController{
    
    public function actionRemove(){
        if(\Yii::$app->request->get("id")){
            $id = intval(\Yii::$app->request->get("id"));
            $bot = Bot::findOne(["id"=>$id,"user_id"=>\Yii::$app->user->id]);
            if($bot)
                // Удаляем команды
                $commands = Botcommand::findAll(['bot_id' => $bot->id]);
                foreach ($commands as $command) {
                    $command->delete();
                }
                // Удаляем переменные
                $variables = BotcommandsHasVariables::findAll(['bot_id' => $bot->id]);
                foreach ($variables as $var) {
                    $value = VariablesHasData::findAll(['var_id' => $var->id]);
                    $value->delete();
                    $var->delete();
                }

                $bot->delete();
        }
        $this->redirect("/constructor");
    }
    function actionEnablebot(){
        if(\Yii::$app->request->get("id")){
            $id = intval(\Yii::$app->request->get("id"));
            $bot = Bot::findOne(["id"=>$id,"user_id"=>\Yii::$app->user->id]);
            if($bot){
                $bot->enabled = 1-$bot->enabled;
                $bot->save();
                echo $bot->enabled;
            }
        }
    }

    public function actionCreate(){
        
		if(\Yii::$app->request->post("botname")){
			$nbot = new Bot();
			$nbot->name=\Yii::$app->request->post("botname");
			$nbot->user_id = \Yii::$app->user->id;
            $nbot->tariff_id = 2;
			$nbot->save();
			\Yii::$app->session->setFlash("success","Новый бот успешно создан. Перейдите в настройки бота чтобы отредактировать команды.");
			$this->redirect(["/constructor"]);
		}
		
        $bot_count = Bot::find()->where(["user_id"=>\Yii::$app->user->id])->count();
        return $this->render("create",["number"=>$bot_count+1]);
        
    }


	public function actionIndex(){
        if(\Yii::$app->request->method=="POST"){
            $name=\Yii::$app->request->post("name");
            $id=\Yii::$app->request->post("id");
            $bot = Bot::findOne(["id"=>$id,"user_id"=>\Yii::$app->user->id]);
            if($bot ){
                $bot->name=$name;
                $bot->save();
            }
            $this->refresh();
        }
		$bots = Bot::find()->where(["user_id"=>\Yii::$app->user->id])->with("groups")->all();
        $groupcount = Vkgroups::find()->where(["user_id"=>\Yii::$app->user->id])->count();
		return $this->render("construct",["bots"=>$bots,"groupcount"=>$groupcount]);
	}
	function actionCommands(){
		
        $id = \Yii::$app->request->get("id");
        $model = new BotcommandForm();
        $bot = Bot::findOne($id);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $command = Html::encode($model->command);
            $response = Html::encode($model->response);

            $new_command = new Botcommand();

            $new_command->command  = $command;
            $new_command->response = $response;
            $new_command->bot_id   = $id;
            $new_command->user_id  = \Yii::$app->user->id;

            $new_command->save();

            \Yii::$app->getSession()->setFlash('success', 'Команда была успeшно добавлена!');
            return $this->refresh();
        }

		return $this->render("commands", [
            'id'    => $id,
            'model' => $model,
            'bot'   => $bot,
        ]);
	}

	function actionEcommand(){
		if (\Yii::$app->request->method=="POST") {
            if (\Yii::$app->request->post("id")) {
                $com = Botcommand::findOne(\Yii::$app->request->post("id"));
            } else {
                $com = new Botcommand();
            }
            if (\Yii::$app->request->post("command") and \Yii::$app->request->post("response")) {
                $com->command=\Yii::$app->request->post("command");
                $com->response=\Yii::$app->request->post("response");
                if (\Yii::$app->request->post("enabled")) {
                    $com->enabled=\Yii::$app->request->post("enabled");
                }
                $com->save();
                $this->refresh();
            }
        }

		$id = \Yii::$app->request->get("id");
        $com = Botcommand::findOne($id);
        if ($com) {
            $bot = Bot::find()->where(["id"=>$com->bot_id,"user_id"=>\Yii::$app->user->id])->with("groups")->one();
            $tariff = Tariff::findOne($bot->tariff_id);
            $tariff->modules = json_decode($tariff->modules);   
            
            return $this->render("createcommand.php", [
                'id'     => $id,
                'bot'    => $bot,
                'com'    => $com,
                'tariff' => $tariff,
            ]);
        }
        throw new \yii\web\HttpException(404, 'Oops. Not found');
	}
	function actionRemovecommand(){
		$command_id = \Yii::$app->request->get("command_id");
		$user_id = \Yii::$app->user->id;
		$bc = Botcommand::findOne(["id"=>$command_id]);//,"user_id"=>$user_id
		$bc->delete();
		return $this->actionAjaxcommand();
	}
	
	/**
     * Ajaxcommand
     * Передает все команды бота в вид
     *
     * @return void
     */
	function actionAjaxcommand(){
		$search = \Yii::$app->request->get("search");
		$id = \Yii::$app->request->get("id");
		$actions = null;
		if(strlen($search)>0){
			$actions = Botcommand::find()->where(["like","command",$search])->all();
            var_dump($actions);
        } else{
			$actions = Botcommand::find()->where(["bot_id"=>\Yii::$app->request->get("id")])->all();
        }
		//
		return $this->renderPartial("ajax_scenario.php",compact("actions","id"));
	}
	
	
    function actionEdit(){
        /**
         * Проверяем не пытаеться ли пользователь изменить бота без id
         */ 
        $id = \Yii::$app->request->get("id");
        if ($id) {
            $bot = Bot::find()->where(["user_id"=>\Yii::$app->user->id,"id"=>$id])->with(["groups","tariff"])->one();
            if (!$bot) {
                return $this->goBack();
            }
            return $this->render("edit", ["bot"=>$bot]);    
        } else {
            return $this->goBack();
        }
    }
    function actionGroupconnect(){
        $id = \Yii::$app->request->get("bot_id");
        $bot = Bot::findOne(["user_id"=>\Yii::$app->user->id,"id"=>$id]);
        if(\Yii::$app->request->get("group_id")){
            $group = Vkgroups::findOne(["id"=>\Yii::$app->request->get("group_id"),"user_id"=>\Yii::$app->user->id]);
            if($group and $bot){
                $group->bot_id = $id;
                $group->save();
                $this->redirect(["/constructor/edit","id"=>$id]);
            }
        }
        $groups = Vkgroups::find()->where(["user_id"=>\Yii::$app->user->id])->all();
        return $this->render("connect",compact("bot","groups"));
    }
    
    function actionGroups(){
        if(\Yii::$app->request->get("untie")>0){
            $group = Vkgroups::findOne(["user_id"=>\Yii::$app->user->id,"id"=>\Yii::$app->request->get("untie")]);
            if($group){
                $group->bot_id = 0;
                $group->paid = null;
                $group->save();
                $this->redirect("/constructor/groups");
            }
        }
        $groups = Vkgroups::find()->where(["user_id"=>\Yii::$app->user->id])->with(["bot","bot.tariff"])->all();
        return $this->render("groups",compact("groups"));
    
	}
	function actionSettariff(){
		$id = \Yii::$app->request->get("id");
		$tariffs = Tariff::find()->all();
        $groups = Vkgroups::find()->where(["user_id"=>\Yii::$app->user->id,"id"=>$id])->with("bot")->all();
        return $this->render("settariff",compact("groups","tariffs"));
    }

    public function actionCreatecommand () {
        $id = \Yii::$app->request->get('id');
        $bot = Bot::findOne($id);

        return $this->render('createcommand', [
            'bot' => $bot
        ]);
    }
    public function actionSavecommand () {
        $command = \Yii::$app->request->post();

        return print_r($command);
    }

    public function actionBotconstructor () {
        $id = \Yii::$app->request->get("id");
        
        

        return $this->renderPartial("botconstructor.php", [
            'id' => $id
        ]);
    }
}

