<?php

class Hobby_itdwidget extends CWidget {

    

    public function init() {
        
    }

    public function run() {
        $sql = "select * from hobby_itd order by created_date desc limit 2";
        $connection = Yii::app()->db;
        $bobby = $connection->createCommand()
                ->select(array(
                        'hobby_itd.id',
						
						'lastname',
						'firstname',
						'user.photo',
						'user.division',						
                                                'user.birthday',
                                                "unit_name",
                                                "post_name",
                            )
                    )
                    ->from('hobby_itd')
                    ->join('user', 'user.id=hobby_itd.user_id')
                    ->join("unit", "unit.id=user.division")
                    ->join("post", "post.id=user.position")             
                    ->limit(2)
                    ->order('hobby_itd.created_date desc')
                ->queryAll()
                ;
        

        
        ?>


        <ul class="list_photo">
            <?php
            if (!is_null($bobby)) {
                foreach ($bobby as $object) {

                    ?>
                    <li>
                        <div class="img">
                            <?php
                            if ($object['photo'] != "") {
                                
                                $thumnail_file_path = FunctionCommon::getFilenameInThumnail($object['photo']);
                                
                                if (file_exists(Yii::getPathOfAlias('webroot') . $thumnail_file_path)) {



                                    
                                    $url = ltrim($thumnail_file_path, '/');
                                list($width_orig, $height_orig) = getimagesize($url);
                                if($width_orig>126){
                                    $width=126;
                                }
                                else{
                                    $width=$width_orig;
                                }
                                $height= ceil($height_orig*$width/$width_orig);
                                if($height>122){
                                    $height=122;
                                    $ratio=$width_orig/$height_orig;
                                    $width= ceil($height*$ratio);
                                }
                                    
                                    
                                    

                                    
                                    echo '<img style="width:' . $width . 'px;height:' . $height . 'px;" src="' . Yii::app()->request->baseUrl . $thumnail_file_path . '"/>';



//										
                                }
                            }
                            ?>
                        </div>
                        <div class="txt">
                            <h4><?php echo htmlspecialchars($object['lastname']).' '.htmlspecialchars($object['firstname']);?></h4>
                            <p><b>Nhóm: </b> <?php  echo htmlspecialchars($object['unit_name']).' - '.htmlspecialchars($object['post_name']);?></p>
<!--                            <p style="word-wrap: break-word;">
                                
                               
                            </p>-->
                            
                            
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

            <?php
        }

    }
    