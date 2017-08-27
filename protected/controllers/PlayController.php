<?php

class PlayController extends Controller {

    public $pageTitle;

    public function init() {
        parent::init();
        $this->pageTitle = Config::TITLE_FOR_TOP_PLAY;
        if (Yii::app()->request->cookies['id'] == NULL ) {
            $this->redirect(array('newgin/'));
        }
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionDesigncommentajax() {
        if (Yii::app()->request->isAjaxRequest) {
            $items = array();
            $design_comment = Yii::app()->db->createCommand()
                    ->select("name,id")
                    ->from("design_comment")
                    ->queryAll();
            if (is_array($design_comment) && count($design_comment) > 0) {
                foreach ($design_comment as $row) {
                    $count = Yii::app()->db->createCommand()
                            ->select("count(design_comment_id) as count")
                            ->from("design_comment_detail")
                            ->where("design_comment_id=" . $row['id'])
                            ->queryScalar();
                    $items[] = array("name" => $row['name'], "count" => $count);
                }
            }
            $has_comment = Yii::app()->db->createCommand()
                    ->select("count(*) as count")
                    ->from("design_comment_detail")
                    ->queryScalar();
            if ($has_comment == '0') {
                $has_comment = FALSE;
            } else {
                $has_comment = true;
            }
            $this->returnHtml($items, $has_comment);
            Yii::app()->end();
        }
    }

    public function actionSendmessageajax() {
        if (Yii::app()->request->isAjaxRequest) {
            $content = Yii::app()->request->getParam("content");
            $now = date("Y-m-d H:i:s");
            $user_id = Yii::app()->request->getParam("user_id");

            $columns = array(
                'user_id' => $user_id,
                'content' => base64_encode($content),
                'send_time' => $now,
                'is_saved' => FALSE
            );
            Yii::app()->db->createCommand()
                    ->insert("room_chat", $columns);

            $row = Yii::app()->db->createCommand()
                    ->select(
                            array(
                                'send_time',
                                'lastname',
                                'firstname',
                                'content'
                                )
                            )
                    ->from("room_chat")
                    ->join("user", "user.id=room_chat.user_id")
                    ->order("send_time desc")
                    ->where("user_id=$user_id")
                    ->limit(1)
                    ->queryRow();

            if (is_array($row) && count($row) > 0) {
                ?>                
                <div class="room_message" style="vertical-align: middle;padding-left: 20px;margin-top: 50px;">
                    <div style="float: left;margin-right: 5px;">[<?php echo $this->convert_time($row['send_time']); ?>]</div>
                    <div style="float: left;margin-right: 5px;"><?php echo $row['lastname'] . ' ' . $row['firstname'] . ':'; ?></div>
                    <div style="float: left;margin-right: 5px;"><?php echo base64_decode($row['content']); ?></div>
                    <div class="clear"></div>
                </div>   
                <?php
            }

            Yii::app()->end();
        }
    }

    public function actionSavemessageajax() {
        if (Yii::app()->request->isAjaxRequest) {
            $user_id = Yii::app()->request->getParam("user_id");
            $columns = array(
                'is_saved' => TRUE
            );
            Yii::app()->db->createCommand()
                    ->update("room_chat", $columns, "user_id=$user_id");
            Yii::app()->end();
        }
    }

    private function convert_time($date_time) {
        $temp = explode(" ", $date_time);
        $date = $this->convertToDate($temp[0]);
        $today = $this->convertToDate(date("Y-m-d"));
        $result = '';
        if ($date == $today) {
            $result.='Today';
        } else {
            $result.=$date->format("d/m/Y");
        }
        $result.=' ';
        $result.=date('h:i A', strtotime($date_time));
        return $result;
    }

    private function convertToDate($string) {
        $date = new DateTime("$string");
        return $date;
    }

    private function returnHtml($items, $has_comment) {
        ?>

        <?php
        if ($has_comment == true) {
            ?>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/flotr2.min.js"></script>
            <div id="graph1">
            </div>
            <style type="text/css">
                #graph1 {
                    width : 600px;
                    height: 400px;
                    margin: 20px auto;
                }
            </style>

            <script type="text/javascript">

                (function basic_pie(container) {
            <?php
            
            for ($i = 0, $n = count($items); $i < $n; $i++) {
                if ($i == 0) {
                    echo "var ";
                }
                echo 'd' . ($i + 1) . '=[[0,' . $items[$i]['count'] . ']],';
            }
            ?>
                    graph;
                    graph = Flotr.draw(container, [
            <?php
            
            for ($i = 0, $n = count($items); $i < $n; $i++) {
                echo '{ data:d' . ($i + 1) . ',label:"' . $items[$i]['name'] . ': ' . $items[$i]['count'] . '"' . '}';

                if ($i < $n - 1) {
                    echo ',';
                }
            }
            ?>

                    ], {
                        HtmlText: false,
                        grid: {
                            verticalLines: false,
                            horizontalLines: false
                        },
                        xaxis: {
                            showLabels: false
                        },
                        yaxis: {
                            showLabels: false
                        },
                        pie: {
                            show: true,
                            explode: 6
                        },
                        mouse: {
                            track: true
                        },
                        legend: {
                            position: "se",
                            backgroundColor: "#D2E8FF"
                        }
                    });
                })(document.getElementById("graph1"));
            </script>   
            <?php
        } else {
            ?>
            <div style="color: red;width: 600px;height: 200px;margin-left: 95px;border: 1px;border-style: solid;border-color: black;text-align: center;vertical-align: middle;padding-top: 100px;"><h3>Chưa có một nhận xét từ một thành viên nào của công ty</h3></div>
            <?php
        }
        ?>

        <?php
    }

}
