<?php
namespace app\controllers\protect;

use Yii;
use app\controllers\BaseController;
use app\models\Tariff;
use app\models\TariffForm;

class TariffController extends BaseController {

    function actionEdit(){
        if (\Yii::$app->request->get("id")){
            $id=\Yii::$app->request->get("id");
        }
        else{
            return $this->redirect("/protect/tariff");
        }
        $tariff = Tariff::findOne($id);
        if ($tariff) {
            $model = new TariffForm();
            $tariff->modules = json_decode($tariff->modules);
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

                Tariff::updateAll([
                    'name'    => $model->name,
                    'price'   => $model->price,
                    'members' => $model->members
                    ], ['id' => $id]);

                return $this->redirect(["/protect/tariff/edit","id"=>$id]);
            }
        
            return $this->render("edit", [
                "tariff" => $tariff,
                'model'  => $model,
            ]);
        }
        throw new \yii\web\HttpException(404, 'Oops, not found.');

    }
    function actionModules(){
        if(\Yii::$app->request->get("id") and \Yii::$app->request->method=="POST" ){
            $id=\Yii::$app->request->get("id");
            $tariff = Tariff::findOne(["id"=>$id]);
            $modules = ["joke","signa","facts","quote", 'keyboard', 'rules', 'vars'];
            $tariff->command = (\Yii::$app->request->post("command")?1:0);
            $tariff->macros = (\Yii::$app->request->post("macros")?1:0);
            $tariff->media = (\Yii::$app->request->post("media")?1:0);
            $mds = [];
            foreach ($modules as $m) {
                $mds[$m] = (isset(\Yii::$app->request->post("modules")[$m])?1:0);
            }
            $tariff->modules = json_encode($mds);
            $tariff->save();
        }
    }
	function actionIndex(){
		if (\Yii::$app->request->post("name") && !\Yii::$app->request->post("id")) {
			$tariff = new Tariff();
			$tariff->name=\Yii::$app->request->post("name");
			$tariff->price=\Yii::$app->request->post("price");
			$tariff->save();
			$this->refresh();
		}
		$tariffs = Tariff::find()->all();
		return $this->render("tariff",["tariffs"=>$tariffs]);

	}
	function actionRemove(){
		$tariff = Tariff::findOne(\Yii::$app->request->get("id"));
		if(!empty($tariff))
			$tariff->delete();
		$this->redirect(["protect/tariff"]);
	}
}
