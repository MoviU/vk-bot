<?php

namespace app\components;
use app\components\Instagraph;
class ImageWork{
    function vinci($image,$bot,$user_id) {
        
        $text_m = '✨🔥 Мы поставили на вашу фотку эффект %effect%';
       
        $rand = rand(111111111,999999999);
        $rands = rand(111111111,999999999);
        $path = "/cache/vinci/";
        $photo = $image->photo_604;
        for ($i = 0; $i <= 10; $i++) {
        if($image->sizes[$i]->type == "w"){ if (!$photo) $photo = $image->sizes[$i]->url; break;}
        elseif($image->sizes[$i]->type == "z"){if (!$photo) $photo = $image->sizes[$i]->url; break;}    
        elseif($image->sizes[$i]->type == "y"){if (!$photo) $photo = $image->sizes[$i]->url; break;}    
        elseif($image->sizes[$i]->type == "x"){if (!$photo) $photo = $image->sizes[$i]->url; break;}}
        if (!$photo) return array('text' => 'Фотография слишком маленькая или не загружена.');
        $photo = file_get_contents($photo);
        $urll = file_put_contents("".$_SERVER['DOCUMENT_ROOT']."".$path."$rand.jpg",$photo);

        if($urll != true){return array('text' => "Ошибка!"); }

        
       $this->loading($rand,$rands);
        #logs
       
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
                
                return array('type' =>'','text' => "Мы не смогли загрузить фото на сервер Вконтакте.". json_encode($upload));
            }
            $answer = str_replace("%effect%", $filters[0]->name, $bot->modules_data->photoedit->answer2);
            return array('type' =>'photo'.$user_id.'_'.$upload['response'][0]["id"],'text' => $answer);
       /* } else {
            $file = file_get_contents(realpath($path.$rand.'.jpg'));
            file_put_contents('./images/effect/'.$rand.'.jpg',$file);
            unlink(realpath($path.$rand.'.jpg')); 
            $answer = str_replace("%effect%", $filters[0]->name, $bot->modules_data->photoedit->answer2);
            return array('text' => $answer.'<br> Ссылка на фото https://bot-vk.ru/application/cache/vinci/'.$rands.'.jpg'); 
        
        } */
    }
    
    function loading($photo,$photos){
        try
        {
            $instagraph = Instagraph::factory("cache/vinci/".$photo.".jpg", "cache/vinci/".$photos.".jpg");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            die;
        }

         $rand = rand(0,3);
         $instagraph->gotham();
         /*if($rand == 0){$instagraph->gotham();} 
         elseif($rand == 1){$instagraph->toaster();} 
         elseif($rand == 2){$instagraph->nashville();} 
         elseif($rand == 3){$instagraph->lomo();}*/

        
    }
}
