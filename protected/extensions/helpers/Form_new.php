<?php

class Form_new extends CWidget {

    public function editConfirm14($model, $form, $controller_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }
        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_edit_attachment4';
        if (Yii::app()->request->cookies[$cookie_key_name] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name]->value)) {
            $uploaded_file_attachment4_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name]->value));
        } else if ($my_class == 'user') {
            $uploaded_file_attachment4_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase($model->photo));
        }
        if ($my_class == 'user') {

            echo $form->hiddenField($model, 'photo');
            echo $form->hiddenField($model, 'photo_checkbox_for_deleting');

            if ($model->photo_checkbox_for_deleting == '1') {//delete checkbox has been checked
                $this->echoEmpty($assetsBase, true);
            } else {//delete checkbox has not been checked                                 
                if (trim($model->photo) != "" || (Yii::app()->request->cookies[$cookie_key_name] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name]->value))) {//upload new file                                            
                    Upload_file_common_new::echoOldFile1($uploaded_file_attachment4_ext, 4, $model, $controller_name, $action_type = 2, $assetsBase);
                } else {//keep old status                                              
                    $this->echoEmpty($assetsBase, true);
                }
            }
        }
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function editConfirm11($model, $form, $controller_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }
        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_edit_attachment';
        if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
            $uploaded_file_attachment1_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '1']->value));
        } else {
            $uploaded_file_attachment1_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase($model->attachment1));
        }
        if (Yii::app()->request->cookies[$cookie_key_name . '2'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '2']->value)) {
            $uploaded_file_attachment2_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '2']->value));
        } else {
            $uploaded_file_attachment2_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase($model->attachment2));
        }
        if (Yii::app()->request->cookies[$cookie_key_name . '3'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '3']->value)) {
            $uploaded_file_attachment3_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '3']->value));
        } else {
            $uploaded_file_attachment3_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase($model->attachment3));
        }

        echo $form->hiddenField($model, 'attachment1');
        echo $form->hiddenField($model, 'attachment1_checkbox_for_deleting');


        echo $form->hiddenField($model, 'attachment2');
        echo $form->hiddenField($model, 'attachment2_checkbox_for_deleting');

        echo $form->hiddenField($model, 'attachment3');
        echo $form->hiddenField($model, 'attachment3_checkbox_for_deleting');
        ?>
        <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM; ?></div>    
        <div class="photo">
            <div class="imgbox"> 
        <?php
        if ($model->attachment1_checkbox_for_deleting == '1') {//delete checkbox has been checked
            $this->echoEmpty($assetsBase);
        } else {//delete checkbox has not been checked                                 
            if (trim($model->attachment1) != "" || (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value))) {//upload new file                                            
                Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 1, $model, $controller_name, $action_type = 2, $assetsBase);
            } else {//keep old status                                              
                $this->echoEmpty($assetsBase);
            }
        }
        ?>
            </div>
            <div class="imgbox">
                <?php
                if ($model->attachment2_checkbox_for_deleting == '1') {//delete checkbox has been checked
                    $this->echoEmpty($assetsBase);
                } else {//delete checkbox has not been checked
                    if (trim($model->attachment2) != "" || (Yii::app()->request->cookies[$cookie_key_name . '2'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '2']->value))) {//upload new file
                        Upload_file_common_new::echoOldFile1($uploaded_file_attachment2_ext, 2, $model, $controller_name, $action_type = 2, $assetsBase);
                    } else {//keep old status                                              
                        $this->echoEmpty($assetsBase);
                    }
                }
                ?>
            </div>
            <div class="imgbox">
                <?php
                if ($model->attachment3_checkbox_for_deleting == '1') {//delete checkbox has been checked
                    $this->echoEmpty($assetsBase);
                } else {//delete checkbox has not been checked
                    if (trim($model->attachment3) != "" || (Yii::app()->request->cookies[$cookie_key_name . '3'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '3']->value))) {//upload new file
                        Upload_file_common_new::echoOldFile1($uploaded_file_attachment3_ext, 3, $model, $controller_name, $action_type = 2, $assetsBase);
                    } else {//keep old status                                              
                        $this->echoEmpty($assetsBase);
                    }
                }
                ?>
            </div>
        </div>
                <?php
            }

            /**
             * @param CActiveRecord $model 
             * @return html 
             */
            public function edit_confirm_one_file_img($model, $form, $controller_name, $assetsBase) {
                if (!($model instanceof CActiveRecord)) {
                    return;
                }
                $my_class = strtolower(get_class($model));
                $cookie_key_name = 'file_' . $my_class . '_edit_attachment';
                if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
                    $uploaded_file_attachment1_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '1']->value));
                } else {
                    $uploaded_file_attachment1_ext = Upload_file_common::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase($model->attachment1));
                }
                echo $form->hiddenField($model, 'attachment1');
                echo $form->hiddenField($model, 'attachment1_checkbox_for_deleting');
                ?>  



        <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM_ONE_FILE; ?></div>    
        <div class="photo">
            <div class="imgbox"> 
        <?php
        if ($model->attachment1_checkbox_for_deleting == '1') {//delete checkbox has been checked
            $this->echoEmpty($assetsBase);
        } else {//delete checkbox has not been checked                                 
            if (trim($model->attachment1) != "" || (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value))) {//upload new file                                            
                Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 1, $model, $controller_name, $action_type = 2, $assetsBase);
            } else {//keep old status                                              
                $this->echoEmpty($assetsBase);
            }
        }
        ?>
            </div>

        </div>
        <?php
    }

    public function edit14($model, $form, $controller_name, $attachment4_error, $assetsBase) {

        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_edit_attachment';
        if (Yii::app()->request->cookies[$cookie_key_name . '4'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '4']->value)) {
            if ($my_class == 'user') {
                $model->photo = Yii::app()->request->cookies[$cookie_key_name . '4']->value;
            }
        }


        $host_file_attachment4_ext = "";
        if ($my_class == 'user') {
            $host_file_attachment4_ext = strtolower($this->getFileNameExtension($model->photo));
        }
        if ($attachment4_error != "") {
            echo '<div class="alert error_message" id="photo_error">' . $attachment4_error . '</div>';
        }
        if ($my_class == 'user') {
            if (trim($model->photo) != "") {//have file    
                FunctionCommon::echoOldFile($host_file_attachment4_ext, 4, $model, $controller_name, $assetsBase, $edit = true);
            } else {//do not have file
                echo '<img style="width:228px; float:left; margin: 0px 15px;" src="' . $assetsBase . '/css/common/img/img_dummyman.jpg">';
            }
        }
        if ($my_class == 'user') {
            echo '<p style="width:228px; float:left; margin-left: 15px;"><span class="mr10">Ảnh</span>' . $form->fileField($model, 'photo');
            echo '<span class="checkDelete">';
            echo $form->checkBox($model, 'photo_checkbox_for_deleting'
                    , array('value' => 1, 'uncheckValue' => 0)
            );
            echo Config::TEXT_FOR_LABEL_CANCEL_UPLOAD . '</span></p>';
        }
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function edit_one_file_img($model, $form, $controller_name, $attachment1_error, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }
        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_edit_attachment';
        if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
            $model->attachment1 = Yii::app()->request->cookies[$cookie_key_name . '1']->value;
        }

        /**
         * 
         */
        $host_file_attachment1_ext = strtolower($this->getFileNameExtension($model->attachment1));
        ?>





        <div class="attachements">
            <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_ONE_FILE; ?></div> 
            <div id="error_message1"></div>            

        <?php
        if ($attachment1_error != "") {
            echo '<div class="alert error_message" id="err1">' . $attachment1_error . '</div>';
        }
        ?>
            <div class="photo">
                <div class="imgbox">
            <?php
            if (trim($model->attachment1) != "") {//have file                                                 
                FunctionCommon::echoOldFile($host_file_attachment1_ext, 1, $model, $controller_name, $assetsBase, $edit = true);
            } else {//do not have file
                FunctionCommon::echoEmpty($assetsBase);
            }
            $this->echoFileForUploadingFile($model, $form, 1);
            $this->echoCheckboxForDeletingFile($model, $form, 1);
            ?>

                </div>

            </div>
        </div>






        <?php
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function edit11($model, $form, $controller_name, $attachment1_error, $attachment2_error, $attachment3_error, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }
        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_edit_attachment';
        if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
            $model->attachment1 = Yii::app()->request->cookies[$cookie_key_name . '1']->value;
        }
        if (Yii::app()->request->cookies[$cookie_key_name . '2'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '2']->value)) {
            $model->attachment2 = Yii::app()->request->cookies[$cookie_key_name . '2']->value;
        }
        if (Yii::app()->request->cookies[$cookie_key_name . '3'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '3']->value)) {
            $model->attachment3 = Yii::app()->request->cookies[$cookie_key_name . '3']->value;
        }
        /**
         * 
         */
        $host_file_attachment1_ext = strtolower($this->getFileNameExtension($model->attachment1));
        $host_file_attachment2_ext = strtolower($this->getFileNameExtension($model->attachment2));
        $host_file_attachment3_ext = strtolower($this->getFileNameExtension($model->attachment3));
        ?>


        <div class="attachements">
            <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT; ?></div> 
            <div id="error_message1"></div>            
            <div id="error_message2"></div>            
            <div id="error_message3"></div>   
        <?php
        if ($attachment1_error != "") {
            echo '<div class="alert error_message" id="err1">' . $attachment1_error . '</div>';
        }
        if ($attachment2_error != "") {
            echo '<div class="alert error_message" id="err2">' . $attachment2_error . '</div>';
        }
        if ($attachment3_error != "") {
            echo '<div class="alert error_message" id="err3">' . $attachment3_error . '</div>';
        }
        ?>
            <div class="photo">
                <div class="imgbox">
            <?php
            if (trim($model->attachment1) != "") {//have file                                                 
                FunctionCommon::echoOldFile($host_file_attachment1_ext, 1, $model, $controller_name, $assetsBase, $edit = true);
            } else {//do not have file
                FunctionCommon::echoEmpty($assetsBase);
            }
            $this->echoFileForUploadingFile($model, $form, 1);
            $this->echoCheckboxForDeletingFile($model, $form, 1);
            ?>

                </div>
                <div class="imgbox">
                    <?php
                    if (trim($model->attachment2) != "") {//have file 
                        FunctionCommon::echoOldFile($host_file_attachment2_ext, 2, $model, $controller_name, $assetsBase, $edit = true);
                    } else {//do not have file
                        FunctionCommon::echoEmpty($assetsBase);
                    }
                    $this->echoFileForUploadingFile($model, $form, 2);
                    $this->echoCheckboxForDeletingFile($model, $form, 2);
                    ?>

                </div>
                <div class="imgbox">
                    <?php
                    if (trim($model->attachment3) != "") {//have file                                         
                        FunctionCommon::echoOldFile($host_file_attachment3_ext, 3, $model, $controller_name, $assetsBase, $edit = true);
                    } else {//do not have file
                        FunctionCommon::echoEmpty($assetsBase);
                    }
                    $this->echoFileForUploadingFile($model, $form, 3);
                    $this->echoCheckboxForDeletingFile($model, $form, 3);
                    ?>

                </div>
            </div>
        </div>






        <?php
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function registConfirm11($model, $form, $controller_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }

        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_regist_attachment';

        /**
         * 
         */
        if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
            $uploaded_file_attachment1_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '1']->value));
        } else {
            $uploaded_file_attachment1_ext = '';
        }
        if (Yii::app()->request->cookies[$cookie_key_name . '2'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '2']->value)) {
            $uploaded_file_attachment2_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '2']->value));
        } else {
            $uploaded_file_attachment2_ext = '';
        }
        if (Yii::app()->request->cookies[$cookie_key_name . '3'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '3']->value)) {
            $uploaded_file_attachment3_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '3']->value));
        } else {
            $uploaded_file_attachment3_ext = '';
        }


        echo $form->hiddenField($model, 'attachment1');

        echo $form->hiddenField($model, 'attachment1_checkbox_for_deleting');

        echo $form->hiddenField($model, 'attachment2');

        echo $form->hiddenField($model, 'attachment2_checkbox_for_deleting');

        echo $form->hiddenField($model, 'attachment3');

        echo $form->hiddenField($model, 'attachment3_checkbox_for_deleting');
        ?>
        <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM; ?></div>                                 	                        
        <div class="photo">
            <div class="imgbox"> 
        <?php
        if ($model->attachment1_checkbox_for_deleting == '1') {//delete checkbox has been checked
            $this->echoEmpty($assetsBase);
        } else {//delete checkbox has not been checked                                 
            if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
                Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 1, $model, $controller_name, $action_type = 1, $assetsBase);
            } else {//keep old status                                              
                $this->echoEmpty($assetsBase);
            }
        }
        ?>
            </div>
            <div class="imgbox">
                <?php
                if ($model->attachment2_checkbox_for_deleting == '1') {//delete checkbox has been checked
                    $this->echoEmpty($assetsBase);
                } else {//delete checkbox has not been checked
                    if (Yii::app()->request->cookies[$cookie_key_name . '2'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '2']->value)) {
                        Upload_file_common_new::echoOldFile1($uploaded_file_attachment2_ext, 2, $model, $controller_name, $action_type = 1, $assetsBase);
                    } else {//keep old status                                              
                        $this->echoEmpty($assetsBase);
                    }
                }
                ?>
            </div>
            <div class="imgbox">
                <?php
                if ($model->attachment3_checkbox_for_deleting == '1') {//delete checkbox has been checked
                    $this->echoEmpty($assetsBase);
                } else {//delete checkbox has not been checked
                    if (Yii::app()->request->cookies[$cookie_key_name . '3'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '3']->value)) {
                        Upload_file_common_new::echoOldFile1($uploaded_file_attachment3_ext, 3, $model, $controller_name, $action_type = 1, $assetsBase);
                    } else {//keep old status                                              
                        $this->echoEmpty($assetsBase);
                    }
                }
                ?>
            </div>
        </div>
                <?php
            }

            /**
             * @param CActiveRecord $model 
             * @return html 
             */
            public function regist_confirm_one_file_img($model, $form, $controller_name, $assetsBase) {
                if (!($model instanceof CActiveRecord)) {
                    return;
                }

                $my_class = strtolower(get_class($model));
                $cookie_key_name = 'file_' . $my_class . '_regist_attachment';

                /**
                 * 
                 */
                if (Yii::app()->request->cookies[$cookie_key_name . '1'] != null && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
                    $uploaded_file_attachment1_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '1']->value));
                } else {
                    $uploaded_file_attachment1_ext = '';
                }
                echo $form->hiddenField($model, 'attachment1');

                echo $form->hiddenField($model, 'attachment1_checkbox_for_deleting');
                ?>  


        <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM_ONE_FILE; ?></div>                                 	                        
        <div class="photo">
            <div class="imgbox"> 
        <?php
        if ($model->attachment1_checkbox_for_deleting == '1') {//delete checkbox has been checked            
            $this->echoEmpty($assetsBase);
        } else {//delete checkbox has not been checked                                 
            if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
                Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 1, $model, $controller_name, $action_type = 1, $assetsBase);
            } else {//keep old status                                              
                $this->echoEmpty($assetsBase);
            }
        }
        ?>
            </div>


        </div>
        <?php
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function registConfirm14($model, $form, $controller_name, $attr_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }

        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_regist_attachment4';

        /**
         * 
         */
        if (Yii::app()->request->cookies[$cookie_key_name] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name]->value)) {
            $uploaded_file_attachment4_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common_new::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name]->value));
        } else {
            $uploaded_file_attachment4_ext = '';
        }
        echo $form->hiddenField($model, $attr_name);

        echo $form->hiddenField($model, $attr_name . '_checkbox_for_deleting');
        if ($attr_name == 'photo') {
            if ($model->photo_checkbox_for_deleting == '1') {//delete checkbox has been checked
                $this->echoEmpty($assetsBase);
            } else {//delete checkbox has not been checked                                 
                if (Yii::app()->request->cookies[$cookie_key_name] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name])) {
                    Upload_file_common_new::echoOldFile1($uploaded_file_attachment4_ext, 4, $model, $controller_name, $action_type = 1, $assetsBase);
                } else {//keep old status                                              
                    $this->echoEmpty($assetsBase);
                }
            }
        } else if ($attr_name == 'eye_catch') {

            if ($model->eye_catch_checkbox_for_deleting == '1') {//delete checkbox has been checked
                $this->echoEmpty($assetsBase);
            } else {//delete checkbox has not been checked     
                if (Yii::app()->request->cookies[$cookie_key_name] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name])) {
                    Upload_file_common_new::echoOldFile1($uploaded_file_attachment4_ext, 4, $model, $controller_name, $action_type = 1, $assetsBase);
                } else {//keep old status                                              
                    $this->echoEmpty($assetsBase);
                }
            }
        }
        ?>



        <?php
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function regist11($model, $form, $attachment1_error, $attachment2_error, $attachment3_error, $controller_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }
        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_regist_attachment';
        ?>
        <div class="attachements">
            <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT; ?></div> 
            <div id="error_message1"></div>            
            <div id="error_message2"></div>            
            <div id="error_message3"></div>   
        <?php
        if ($attachment1_error != "") {
            echo '<div class="alert error_message" id="err1">' . $attachment1_error . '</div>';
        }
        if ($attachment2_error != "") {
            echo '<div class="alert error_message" id="err2">' . $attachment2_error . '</div>';
        }
        if ($attachment3_error != "") {
            echo '<div class="alert error_message" id="err3">' . $attachment3_error . '</div>';
        }
        ?>
            <div class="photo">
                <div class="imgbox">
            <?php
            if (Yii::app()->request->cookies[$cookie_key_name . '1'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
                $uploaded_file_attachment1_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common_new::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '1']->value));
                Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 1, $model, $controller_name, $action_type = 1, $assetsBase);
            } else {
                ?>
                        <img alt="" src="<?php echo $assetsBase; ?>/css/common/img/img_photo01.jpg">
                    <?php } ?>
                    <p><?php echo $form->fileField($model, 'attachment1', array('size' => 20)); ?></p>
                    <?php $this->echoCheckboxForDeletingFile($model, $form, 1); ?>

                </div>
                <div class="imgbox">
        <?php
        if (Yii::app()->request->cookies[$cookie_key_name . '2'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '2']->value)) {
            $uploaded_file_attachment2_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common_new::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '2']->value));
            Upload_file_common_new::echoOldFile1($uploaded_file_attachment2_ext, 2, $model, $controller_name, $action_type = 1, $assetsBase);
        } else {
            ?>
                        <img alt="" src="<?php echo $assetsBase; ?>/css/common/img/img_photo01.jpg">
                    <?php } ?>
                    <p><?php echo $form->fileField($model, 'attachment2', array('size' => 20)); ?></p>
                    <?php $this->echoCheckboxForDeletingFile($model, $form, 2); ?>

                </div>
                <div class="imgbox">
        <?php
        if (Yii::app()->request->cookies[$cookie_key_name . '3'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '3']->value)) {
            $uploaded_file_attachment3_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common_new::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '3']->value));
            Upload_file_common_new::echoOldFile1($uploaded_file_attachment3_ext, 3, $model, $controller_name, $action_type = 1, $assetsBase);
        } else {
            ?>
                        <img alt="" src="<?php echo $assetsBase; ?>/css/common/img/img_photo01.jpg">
                    <?php } ?>
                    <p><?php echo $form->fileField($model, 'attachment3', array('size' => 20)); ?></p>
                    <?php $this->echoCheckboxForDeletingFile($model, $form, 3); ?>

                </div>
            </div>
        </div>
        <?php
    }

    /**
     * @param CActiveRecord $model 
     * @return html 
     */
    public function regist_one_file_img($model, $form, $attachment1_error, $controller_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }

        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_regist_attachment';
        ?>
        <div class="attachements">
            <div class="title"><?php echo Config::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_ONE_FILE; ?></div> 
            <div id="error_message1"></div>                        
        <?php
        if ($attachment1_error != "") {
            echo '<div class="alert error_message" id="err1">' . $attachment1_error . '</div>';
        }
        ?>
            <div class="photo">
                <div class="imgbox">
            <?php
            if (Yii::app()->request->cookies[$cookie_key_name . '1'] != null && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '1']->value)) {
                $uploaded_file_attachment1_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common_new::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '1']->value));
                Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 1, $model, $controller_name, $action_type = 1, $assetsBase);
            } else {
                ?>
                        <img alt="" src="<?php echo $assetsBase; ?>/css/common/img/img_photo01.jpg">
                    <?php } ?>
                    <p><?php echo $form->fileField($model, 'attachment1', array('size' => 20)); ?></p>
                    <?php $this->echoCheckboxForDeletingFile($model, $form, 1); ?>

                </div>


            </div>
        </div>
        <?php
    }

    public function regist14($model, $form, $attachment4_error, $controller_name, $assetsBase) {
        if (!($model instanceof CActiveRecord)) {
            return;
        }
        ?>
        <?php
        $my_class = strtolower(get_class($model));
        $cookie_key_name = 'file_' . $my_class . '_regist_attachment';
        ?>



        <div id="error_message4"></div>   
        <?php
        if ($attachment4_error != "") {
            echo '<div class="alert error_message" id="photo_error">' . $attachment4_error . '</div>';
        }


        if (Yii::app()->request->cookies[$cookie_key_name . '4'] != NULL && file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->request->cookies[$cookie_key_name . '4']->value)) {
            $uploaded_file_attachment1_ext = Upload_file_common_new::getFileNameExtension(Upload_file_common_new::getFileNameFromValueInDatabase(Yii::app()->request->cookies[$cookie_key_name . '4']->value));
            Upload_file_common_new::echoOldFile1($uploaded_file_attachment1_ext, 4, $model, $controller_name, $action_type = 1, $assetsBase);
        } else {
            if ($my_class == 'user') {
                ?>
                <img alt="" src="<?php echo $assetsBase; ?>/css/common/img/img_dummyman.jpg">
                <?php
            }
        }
        if ($my_class == 'user') {

            echo '<p><span class="mr10">Ảnh</span>' . $form->fileField($model, 'photo', array('size' => 20)) . '</p>';
            ?>    

            <p>
                <span class="checkDelete">
            <?php
            echo $form->checkBox($model, 'photo_checkbox_for_deleting'
                    , array('value' => 1, 'uncheckValue' => 0)
            );
            echo Config::TEXT_FOR_LABEL_CANCEL_UPLOAD;
            ?>  
                </span>
            </p>       
                    <?php
                }
            }

            /**
             * @param CActiveRecord $model 
             * @return html 
             */
            public function detail($model, $controller_name, $assetsBase, $edit = FALSE) {
                if (!($model instanceof CActiveRecord)) {
                    return;
                }
                /**
                 * 
                 */
                $host_file_attachment1_ext = strtolower($this->getFileNameExtension($model->attachment1));
                $host_file_attachment2_ext = strtolower($this->getFileNameExtension($model->attachment2));
                $host_file_attachment3_ext = strtolower($this->getFileNameExtension($model->attachment3));
                ?>








        <div class="photo">

        <?php
        if (trim($model->attachment1) != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment1)) {//have file 
            echo '<div class="imgbox">';
            FunctionCommon::echoOldFile($host_file_attachment1_ext, 1, $model, $controller_name, $assetsBase, $edit);
            echo '</div>';
        }
        if (trim($model->attachment2) != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment2)) {//have file 
            echo '<div class="imgbox">';
            FunctionCommon::echoOldFile($host_file_attachment2_ext, 2, $model, $controller_name, $assetsBase, $edit);
            echo '</div>';
        }
        if (trim($model->attachment3) != "" && file_exists(Yii::getPathOfAlias('webroot') . $model->attachment3)) {//have file 
            echo '<div class="imgbox">';
            FunctionCommon::echoOldFile($host_file_attachment3_ext, 3, $model, $controller_name, $assetsBase, $edit);
            echo '</div>';
        }
        ?>


        </div>







        <?php
    }

    function echoOldFile($host_file_attachment_ext, $order_index, $model, $img_extention_array, $zip_extention_array, $excel_extention_array, $word_extention_array, $powerpoint_extention_array, $controller_name) {
        $attachment = "";
        if ($order_index == 1) {
            $attachment = $model->attachment1;
        } else if ($order_index == 2) {
            $attachment = $model->attachment2;
        } elseif ($order_index == 3) {
            $attachment = $model->attachment3;
        }
        ?>
        <a <?php if (in_array($host_file_attachment_ext, $img_extention_array)) echo ' rel="prettyPhoto" '; ?> 
            href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/<?php echo $controller_name; ?>/download/?id=<?php echo $model->id . "&" . $order_index; ?>">

        <?php
        if (in_array($host_file_attachment_ext, $img_extention_array))
            echo '<img style="width:228px; height:171px;" src="' . Yii::app()->request->baseUrl . $attachment . '"/>';
        else if ($host_file_attachment_ext == 'pdf')
            echo '<img src="' . Yii::app()->request->baseUrl . '/css/common/img/img_pdf.gif' . '"/>';
        else if (in_array($host_file_attachment_ext, $zip_extention_array))
            echo '<img src="' . Yii::app()->request->baseUrl . '/css/common/img/img_zip.gif' . '"/>';
        else if (in_array($host_file_attachment_ext, $excel_extention_array))
            echo '<img src="' . Yii::app()->request->baseUrl . '/css/common/img/img_excel.gif' . '"/>';
        else if (in_array($host_file_attachment_ext, $word_extention_array))
            echo '<img src="' . Yii::app()->request->baseUrl . '/css/common/img/img_word.gif' . '"/>';
        else if (in_array($host_file_attachment_ext, $powerpoint_extention_array))
            echo '<img src="' . Yii::app()->request->baseUrl . '/css/common/img/img_ppt.gif' . '"/>';
        ?>
            <div style="text-align: center;"><?php echo $this->getFileNameFromValueInDatabase($attachment); ?></div>
            <?php ?>


        </a>
            <?php
        }

        public static function getFileNameFromValueInDatabase($full_file_name) {
            if ($full_file_name == null || !is_string($full_file_name) || trim($full_file_name) == "") {
                return null;
            }
            $string_array = explode("/", $full_file_name);
            if (count($string_array) == 1) {
                return NULL;
            }
            $file_name = $string_array[count($string_array) - 1];
            $string_array = explode(".", $file_name);
            $file_name = '';
            for ($i = 0, $n = count($string_array) - 2; $i < $n; $i++) {
                $file_name.=$string_array[$i];
            }
            $file_name.='.' . $string_array[count($string_array) - 1];
            return $file_name;
        }

        public static function getFileNameExtension($file_name) {
            if ($file_name == null || !is_string($file_name) || trim($file_name) == "") {
                return null;
            }
            $string_array = explode(".", $file_name);
            if (count($string_array) == 1) {
                return null;
            }
            return $string_array[count($string_array) - 1];
        }

        function echoEmpty($assetsBase, $has_img = FALSE) {

            if ($has_img === true) {
                echo '<img alt="" src="' . $assetsBase . '/css/common/img/img_photo01.jpg">';
            } else {
                echo '';
            }
        }

        function echoCheckboxForDeletingFile($model, $form, $order_index) {
            $attachment_checkbox_for_deleting = 'attachment' . $order_index . '_checkbox_for_deleting';
            ?>
        <p>
            <span class="checkDelete">
        <?php
        echo $form->checkBox($model, $attachment_checkbox_for_deleting
                , array('value' => 1, 'uncheckValue' => 0)
        );
        echo Config::TEXT_FOR_LABEL_CANCEL_UPLOAD;
        ?>  
            </span>
        </p>
                <?php
            }

            function echoFileForUploadingFile($model, $form, $order_index) {
                $attachment_checkbox_for_deleting = 'attachment' . $order_index;
                echo '<p>' . $form->fileField($model, $attachment_checkbox_for_deleting) . '</p>';
            }

            /**
             * @param CActiveRecord $model 
             * @return html 
             */
            function add($model, $form) {
                $this->regist($model, $form);
            }

            /**
             * @param CActiveRecord $model 
             * @return html 
             */
            function addConfirm($model, $form) {
                $this->registConfirm($model, $form);
            }

        }
        