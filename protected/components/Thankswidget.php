<?php

class Thankswidget extends CWidget 
{

    
    public function run() 
	{
        if(FunctionCommon::isViewFunction("thanks")==true){
            $thanks = Yii::app()->db->createCommand()
                    ->select(array(
                        "photo",
                        "firstname",
                        "lastname",
                        "unit_name",
                        "post_name",
                        "sender",
                        "thanks.comment",
                        "thanks.id",
                        "user.birthday"
                    ))
                    ->from("thanks")
                    ->join("user", "user.id=thanks.user_id")
                    ->join("unit", "unit.id=user.division")
                    ->join("post", "post.id=user.position")             
                    ->order('thanks.created_date desc')
                    ->queryAll();
        }
        else{
            $thanks=array();
        }
        
        if(is_array($thanks)&&count($thanks)>0){?>
            <ul class="als-wrapper" id="als-wrapper_0" style="width: 880px; height: 140px;">
                <?php
                foreach ($thanks as $thank){ 
                    ?>               
                
                <li class="als-item" id="als-item_0_0" style="left: 0px;">
                    
                    <div class="img_slide" style="height: 193px;" id="<?php echo $thank['id'];?>">
                            <?php if($thank['photo']!=""&&  file_exists(Yii::getPathOfAlias('webroot').FunctionCommon::getFilenameInThumnail($thank['photo']))){ 
                                $thumnail_file_path=FunctionCommon::getFilenameInThumnail($thank['photo']);
                                $url = ltrim($thumnail_file_path, '/');
                                list($width_orig, $height_orig) = getimagesize($url);
                                if($width_orig>200){
                                    $width=200;
                                }
                                else{
                                    $width=$width_orig;
                                }
                                $height= ceil($height_orig*$width/$width_orig);
                                if($height>193){
                                    $height=193;
                                    $ratio=$width_orig/$height_orig;
                                    $width= ceil($height*$ratio);
                                }
                                ?>
                                 <img style="margin: 0 auto;width: <?php echo $width;?>px;height: <?php echo $height;?>px;" src="<?php echo FunctionCommon::getFilenameInThumnail($thank['photo']);?>"/>
                            <?php }
                            else{?> 
                                 <img style="width: 200px;height: 193px;" src="<?php echo Yii::app()->request->baseUrl; ?>/css/common/img/img_photo01.gif" />
                            <?php }
                                 ?>                            
                        </div>
                        <div class="txt_slide">
                            <h4><?php echo htmlspecialchars($thank['lastname']).' '.htmlspecialchars($thank['firstname']);?></h4>
                            <p>Sinh ngày: <b><?php echo FunctionCommon::formatDate($thank['birthday']);?></b></p>
                            <p style="word-wrap: break-word;">Nhóm: <b><?php  echo htmlspecialchars($thank['unit_name']).' - '.htmlspecialchars($thank['post_name']);?></b></p>
                            <p><?php echo FunctionCommon::crop(nl2br(htmlspecialchars($thank['comment'])),50); ?></p>
                        </div>
                        
            </li>                        
                    
                    
                    
                <?php
                }
                ?>
            </ul>   

<?php
        }
    }
    
    



}
?>




