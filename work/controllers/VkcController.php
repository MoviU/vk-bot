<?php
namespace app\controllers;
use Yii;
use app\models\Bot;
use app\models\Vkaccount;
use app\models\Vkgroups;
use app\models\Botcommand;
use app\models\Botactions;
use app\models\Dialogs;
use app\components\MacrosHandler;
use app\models\BotcommandsHasVariables;
use app\models\RulesForBotcommands;
use app\models\VariablesHasData;
use DateTime;
use \VK\CallbackApi\Server\VKCallbackApiServerHandler;
use VK\Client\VKApiClient;

class ServerHandler extends VKCallbackApiServerHandler
{
    public $secret;
    public $group_id;
    public $confirm_key;
    public $access_token;
    public const V = '5.130';
    
    
    public function photovinci($image, $bot, $user_id)
    {
        /*
        if (empty($bot->modules_data->photoedit->answer2)) $bot->modules_data->photoedit->answer2 = '✨🔥 Мы поставили на вашу фотку эффект %effect%';
        if (empty($bot->modules_data->photoedit->answer3)) $bot->modules_data->photoedit->answer3 = 1;
        if (empty($bot->modules_data->photoedit->answer4)) $bot->modules_data->photoedit->answer4 = 1;
        */
        $rand  = rand(111111111, 999999999);
        $rands = rand(111111111, 999999999);
        $path = "/application/cache/vinci/";
        $photo = $image->photo_604;
        for ($i = 0; $i <= 10; $i++) {
            if ($image->sizes[$i]->type == "w") {
                if (!$photo) {
                    $photo = $image->sizes[$i]->url;
                }
                break;
            } elseif ($image->sizes[$i]->type == "z") {
                if (!$photo) {
                    $photo = $image->sizes[$i]->url;
                }
                break;
            } elseif ($image->sizes[$i]->type == "y") {
                if (!$photo) {
                    $photo = $image->sizes[$i]->url;
                }
                break;
            } elseif ($image->sizes[$i]->type == "x") {
                if (!$photo) {
                    $photo = $image->sizes[$i]->url;
                }
                break;
            }
        }
        if (!$photo) {
            return 'Фотография слишком маленькая или не загружена.';
        }
        $photo = file_get_contents($photo);
        $urll = file_put_contents("".$_SERVER['DOCUMENT_ROOT']."".$path."$rand.jpg", $photo);

        if ($urll != true) {
            return array('text' => "Ошибка!");
        }
        file_get_contents("https://bot-vk.ru/application/helpers/filter.php?photo=$rand&photos=$rands");
        #logs
        if ($bot->modules_data->photoedit->answer3 == 1) {
            $get_params = http_build_query(array('peer_id' => $user_id,'access_token' => $bot->token,'v' => '5.21'));
            $link       = json_decode(file_get_contents('https://api.vk.com/method/photos.getMessagesUploadServer?' . $get_params))->response->upload_url;
            $ch         = curl_init();
            curl_setopt($ch, CURLOPT_URL, $link);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => new CURLFile("".$_SERVER['DOCUMENT_ROOT']."".$path."$rands.jpg")));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $resultat = json_decode(curl_exec($ch));
            curl_close($ch);
            $upload = file_get_contents("https://api.vk.com/method/photos.saveMessagesPhoto?server=" . $resultat->server . "&v=5.21&photo=" . $resultat->photo . "&hash=" . $resultat->hash . "&access_token=" . $bot->token);
            $upload  = json_decode($upload, true);
            unlink("".$_SERVER['DOCUMENT_ROOT']."".$path."$rand.jpg");
            unlink("".$_SERVER['DOCUMENT_ROOT']."".$path."$rands.jpg");
        
            if (empty($upload['response'][0]["id"])) {
                return "Мы не смогли загрузить фото на сервер Вконтакте.". json_encode($upload);
            }
            $answer = str_replace("%effect%", $filters[0]->name, $bot->modules_data->photoedit->answer2);
            return array('type' =>'photo'.$user_id.'_'.$upload['response'][0]["id"],'text' => $answer);
        }
    }

    public function curls($Url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    
    public function wiki($test)
    {
        $data = json_decode($this->curls('https://ru.wikipedia.org/w/api.php?action=opensearch&search='.urlencode($test).'&prop=info&format=json'));
        $text = $data[2][0];
        if (stristr($text, 'может иметь следующие значения:')) {
            $text = 'По вашему запросы найдено несколько значений :'.$data[1][0].', '.$data[1][1].',...';
        }
        $text .= '<br>Полная информация доступна по ссылке '.$data[3][0];
        return $text;
    }
    
    
    public function weather($city)
    {
        $weather = @file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text="'.urlencode($city).'")%20and%20u%3D%22c%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
        $weather=json_decode($weather);
        if ($weather and isset($weather->query)) {
            $weather = json_decode($weather)->query;
        }
        $resp = 'Мы нашли погоду для города %city%<br><br>Общая информация:<br>¦Температура - %tem_now%°C<br>¦Восход - %sunrise%<br>¦Закат - %sunset%<br><br>Погода на завтра:<br>¦Максимальная температура - %tem_max% °C<br>¦Минимальная температура - %tem_min% °C';
        if (!$weather or (isset($weather->count) and $weather->count < 1)) {
            return 'Я не смог найти такого города';
        }
        return str_replace(array("%city%","%tem_now%","%sunrise%","%sunset%","%tem_max%","%tem_min%"), array($city,$weather->results->channel->item->condition->temp,$weather->results->channel->astronomy->sunrise,$weather->results->channel->astronomy->sunset,$weather->results->channel->item->forecast[1]->high,$weather->results->channel->item->forecast[1]->low), $resp);
    }
        
        
    public function drawImage($text, $fileName, $x, $y, $angle, $fontName, $fontSize, $fontColor, $rand_id, $path)
    {
        $draw = new \ImagickDraw();
        $bg = new \Imagick($path.'signa/'.$fileName);
        $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
        $draw->setFont($path."font/".$fontName);
        $draw->setFontSize($fontSize);
        $draw->setFillColor($fontColor);
        $bg->annotateImage($draw, $x, $y, $angle, $text);
        $bg->setImageFormat("png");
        $bg->setImageCompression(\Imagick::COMPRESSION_JPEG);
        $bg->setImageCompressionQuality(100);
        $bg->writeImage($path.$rand_id.'.png');
    }

    public function signa($text, $token, $user_id)
    {
        $rand_id = rand(1, 9999999999);
        $path = "./img/";
        //$path = "https://bot-vk.ru/application/cache/signa/";
        $signs = json_decode(file_get_contents($path.'data.json'))->signa;
        $signa = $signs[rand(0, count($signs)-1)];
        $this->drawImage($text, $signa->img, $signa->x, $signa->y, $signa->angle, $signa->font, $signa->font_size, $signa->font_color, $rand_id, $path);

        $get_params = http_build_query(array('peer_id' => $user_id,'access_token' => $token,'v' => strval(self::V)));
        $rtg=file_get_contents('https://api.vk.com/method/photos.getMessagesUploadServer?' . $get_params);
    
        $link       = json_decode($rtg)->response->upload_url;
        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('photo' =>new \CurlFile(realpath($path.$rand_id.'.png'))));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resultat = json_decode(curl_exec($ch));
        curl_close($ch);
        $upload = json_decode(file_get_contents("https://api.vk.com/method/photos.saveMessagesPhoto?server=" . $resultat->server . "&v=5.21&photo=" . $resultat->photo . "&hash=" . $resultat->hash . "&access_token=" . $token));
        unlink(realpath($path.$rand_id.'.png'));
        // file_put_contents("logs.txt",file_get_contents("logs.txt")."\n".json_encode($upload).json_encode($resultat));
        return array('type' => 'photo'.$user_id.'_'.$upload->response[0]->id);
    }
        
    
    
    
    
    public function facts()
    {
        return  file_get_contents('http://webdiscover.ru/facts/rand.php');
    }
    public function joke()
    {
        $k =iconv('windows-1251', 'UTF-8', file_get_contents('http://rzhunemogu.ru/RandJSON.aspx?CType=1'));
        // Yii::debug(print_r($k,true));
        return str_replace('{"content":"', "", mb_substr($k, 0, mb_strlen($k)-2));
    }
    public function quote()
    {
        return  file_get_contents('http://api.forismatic.com/api/1.0/?method=getQuote&format=text');
    }
    public function confirmation(int $group_id, ?string $secret)
    {
        if ($group_id == $this->group_id) {
            echo $this->confirm_key;
        }
    }
    public function parse($event)
    {
        if ($event->type == static::CALLBACK_EVENT_CONFIRMATION) {
            $this->confirmation($event->group_id, "");
        } else {
            $this->parseObject($event->group_id, $event->secret, $event->type, (array)$event->object);
        }
    }
    protected function send($user_id, $message, $group="")
    {
        $vk=new \VK\Client\VKApiClient(self::V);
        $macrosys = new MacrosHandler();
        
        if (is_string($message)) {
            $message = $macrosys->filter($user_id, $this->access_token, $message, $group);
            $key = "message";
        } else {
            $key = "attachment";
        }
        $vk->messages()->send($this->access_token, [
                "user_id"    => $user_id,
                "random_id"  => random_int(1000, 99999),
                'read_state' => 1,
                
                $key=>$message,
                
            ]);
    }
    
    public function keyboard($user_id, $keyboard, $group, $message) {
        $vk=new \VK\Client\VKApiClient(self::V);
        $macrosys = new MacrosHandler();

        $vk->messages()->send($this->access_token, [
                "user_id"    => $user_id,
                "random_id"  => random_int(1000, 99999),
                'read_state' => 1,
                'message'    => $message,
                'keyboard'   => $keyboard,              
            ]);
    }
    
    public function getRuleForInt ($rule, $value, $msg_send, $msg_obj, $group) {
        $value->data = intval($value->data);
        $rule->value = intval($rule->value);
        if ($rule->rule == '==') {
            if ($value->data == $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '!=') {
            if ($value->data != $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '<') {
            if ($value->data < $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '>') {
            if ($value->data > $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '<=') {
            if ($value->data <= $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '>=') {
            if ($value->data >= $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
    }

    public function getRuleForStr($rule, $value, $msg_send, $msg_obj, $group) {
        if ($rule->rule == '==') {
            if ($value->data == $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '!=') {
            if ($value->data != $rule->value) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '<') {
            if (strlen($value->data) < strlen($rule->value)) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '>') {
            if (strlen($value->data) > strlen($rule->value)) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '<=') {
            if (strlen($value->data) <= strlen($rule->value)) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }
        if ($rule->rule == '>=') {
            if (strlen($value->data) >= strlen($rule->value)) {
                // отправляем клавиатуру
                if ($msg_send->keyboard) {
                    $this->keyboard($msg_obj->from_id, $msg_send->keyboard, $group->group_id, $msg_send->response);
                } else {
                    $this->send($msg_obj->from_id, strip_tags($msg_send->response), $group);
                }
            }
        }

    }

    public function messageNew(int $group_id, ?string $secret, array $object)
    {
        // Yii::debug(print_r($object,true));
        // print_r($object);
        $client_info = $object["client_info"];
        $msg_obj = $object["message"];
        if ($msg_obj->from_id != $group_id) {
            $message = $msg_obj->text;
            $group = Vkgroups::findOne(["group_id"=>$group_id]);

            if ($group and $group->group_id) {
                $bot = Bot::findOne(["id"=>$group->bot_id]);
               
                
                if ($bot and $bot->enabled) {
                    $bot->msg_count+=1;
                    $bot->save();
                    $dgs = Dialogs::find()->where(["bot_id"=>$group->bot_id,"user_id"=>$msg_obj->from_id])->all();
                    
                    if (!$dgs) {// первое сообщение боту
                        $action = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_FIRST_MSG]);
                        if ($action) {
                            $action->text = json_decode($action->text);
                            
                            $textlist =$action->text;
                            if ($action->writemode==0) {
                                shuffle($textlist);
                            }
                            foreach ($textlist as $text) {
                                $this->send($msg_obj->from_id, strip_tags($text), $group);
                            }
                            $d = new Dialogs();
                            $d->bot_id=$group->bot_id;
                            $d->user_id=$msg_obj->from_id;
                            $d->save();
                        }
                    } else {//не первое сообщение
                        if (!empty($msg_obj->attachments)) {//реакция на вложения
                            switch ($msg_obj->attachments[0]->type) {
                            case "photo":
                                $msg = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_IMAGE_MSG]);
                                $msg = $msg ? $msg->text : 'Крутая фотка, {name}';
                                break;
                            case "audio":
                                $msg = Botactions::findOne(["bot_id" => $group->bot_id, "type" => Botactions::TYPE_AUDIO_MSG]);
                                $msg = $msg ? $msg->text : 'Это наверное крутое аудио, {name}. Жаль я не могу его посмотреть';
                                break;
                            case "video":
                                $msg = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_VIDEO_MSG]);
                                $msg = $msg ? $msg->text : 'Это наверное крутое видео, {name}. Жаль я не могу его посмотреть';
                                break;
                            case "doc":
                                $msg = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_DOCUMENT_MSG]);
                                $msg = $msg ? $msg->text : 'Зачем мне этот документ?';
                                break;
                            case "market":
                                $msg = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_PRODUCT_MSG]);
                                $msg = $msg ? $msg->text : "market мне прислал? Зачем, {name}?";
                                break;
                            case "sticker":
                                $msg = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_SMILE_MSG]);
                                $msg = $msg ? $msg->text : "Я пока что не умею отправлять смайлики :(";
                                break;
                            default:
                                $msg = "Тип не определен";
                            }
                            $msg = json_decode($msg)[0];
                            $this->send($msg_obj->from_id, $msg, $group->group_id);
                        } else {
                            if ($message == "/quote") {
                                $this->send($msg_obj->from_id, strip_tags($this->quote()), $group);
                            } elseif ($message == "/joke") {
                                $this->send($msg_obj->from_id, strip_tags($this->joke()), $group);
                            } elseif ($message == "/facts") {
                                $this->send($msg_obj->from_id, strip_tags($this->facts()), $group);
                            } elseif ($message == "/signa") {
                                $this->send($msg_obj->from_id, strip_tags($this->signa("hello", $this->access_token, $msg_obj->from_id)), $group);
                            } elseif (explode(" ", $message)[0]=="/wiki") {
                                $this->send($msg_obj->from_id, strip_tags($this->wiki(explode(" ", $message)[1])), $group);
                            } else {
                                $commands = Botcommand::find()->where(["like","command",$message])
                                                    ->where(["enabled"=>1])
                                                    ->all();
                                $msg_send = null;
                                if ($commands) {
                                    foreach ($commands as $el_c) {
                                        if ($el_c->bot_id == $group->bot_id) {
                                            $command_list = explode(",", $el_c->command);
                                            foreach ($command_list as $comel) {
                                                if ($comel == $message) {
                                                    $msg_send=$el_c;
                                                    break;
                                                }
                                            }
                                            if ($msg_send) {
                                                break;
                                            }
                                        }
                                    }
                                    if ($msg_send) {
                                        $msg_send->uses+=1;
                                        $msg_send->save();
                                        // работа с переменными
                                        $vars = BotcommandsHasVariables::findAll(['bot_id' => $bot->id, 'command_id' => $msg_send->id]);
                                        if ($vars) {
                                            $values = VariablesHasData::findAll(['session_id' => $msg_obj->from_id]);
                                            if (count($values) != count($vars)) {
                                                foreach ($vars as $var) {
                                                    $data = new VariablesHasData();
                                                    $data->var_id = $var->id;
                                                    if ($var->type == BotcommandsHasVariables::VAR_INT_TYPE) {
                                                        $data->data = $var->default_int;
                                                    } else {
                                                        $data->data = $var->default_str;
                                                    }
                                                    $data->session_id = $msg_obj->from_id;
                                                    $data->save();
                                                }
                                            }
                                            if ($msg_send->rule_id) {
                                                $rule = RulesForBotcommands::findOne($msg_send->rule_id);
                                                $value = VariablesHasData::findOne(['var_id' => $rule->var_id]);
                                                if ($rule->when == 'if') {
                                                    if ($value->type == '0') 
                                                        $this->getRuleForInt($rule, $value, $msg_send, $msg_obj, $group);
                                                    if ($value->type == '1') 
                                                        $this->getRuleForStr($rule, $value, $msg_send, $msg_obj, $group);
                                                }
                                            }
                                            
                                        }
                                        
                                       
                                    }
                                }
                                if (!$msg_send) {
                                    //неизвестная команда
                                    $action = Botactions::findOne(["bot_id"=>$group->bot_id,"type"=>Botactions::TYPE_UKNOW]);
                                    if ($action) {
                                        $action->uses+=1;
                                        $action->save();
                                        $action->text = json_decode($action->text);
                                        $textlist =$action->text;
                                        if ($action->writemode==0) {
                                            shuffle($textlist);
                                        }
                                        foreach ($textlist as $text) {
                                            $this->send($msg_obj->from_id, strip_tags($text), $group);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $this->send($msg_obj->from_id, strip_tags("hello default".$message), $group);
            }
        }
        header("HTTP/1.1 200 OK");
        echo 'OK';
    }
}


class VkcController extends \yii\web\Controller{
    public $enableCsrfValidation = false;
    function actionBot(){
        $handler = new ServerHandler();
        $data = json_decode(\Yii::$app->request->getRawBody());
        
        $vkgr = Vkgroups::findOne(["group_id"=>$data->group_id]);
        if($vkgr){
            $handler->secret = $vkgr->secret_key;
            $handler->group_id = $vkgr->group_id;
            $handler->confirm_key = $vkgr->code;
            $handler->access_token = $vkgr->access_token;
            $handler->parse($data); 
        }
    }     
}
