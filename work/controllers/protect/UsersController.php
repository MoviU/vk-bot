<?php
namespace app\controllers\protect;

use Yii;
use yii\helpers\Url;
use app\models\User;
use app\models\UsersForm;
use app\models\Vkgroups;

class  UsersController extends \app\controllers\BaseController{
	
	function actionIndex(){
        $groups = null;
		if(\Yii::$app->request->get("search")){
			$search = \Yii::$app->request->get("search");
			$users = User::find()->orFilterWhere(["like","email",$search])->orFilterWhere(["like","auth_id",$search])->orWhere(["id"=>$search])->all();
            if(!$users){
                $groups = Vkgroups::find()->orFilterWhere(["like","group_id",$search])->orFilterWhere(["like","name",$search])->with("user")->all();
            }
        }
		else $users = User::find()->all();
		return $this->render("userlist",["users"=>$users,"groups"=>$groups]);
	}
    function actionEdit(){
        
        
        
        if(\Yii::$app->request->get("id")){
            $user = User::findOne(["id"=>\Yii::$app->request->get("id")]);
            $model = new UsersForm();
            if($model->load(\Yii::$app->request->post()) && $model->validate()){
                $user->balance = $model->amount;
                $user->save();
                return $this->refresh();
            }
            return $this->render("edit", [
                'user'  => $user,
                'model' => $model
            ]);
        }
        
        return $this->redirect("/protect/users");
        
    }
}

