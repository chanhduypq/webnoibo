<?php

class MeigenWidget extends CWidget {

    

    public function init() {
        
    }

    public function run() {
        if (FunctionCommon::isViewFunction("meigen") == TRUE) {
            $result=  $this->getContent();
            ?>

            <div class="list_coffe">
                <div class="box_coffee">
                    
                    <div class="txt_coffee">
                        <div id="witt_frame">
                            <div style="padding: 10px;font-size: large;line-height: 140%;font-weight: 700;text-align: left;">
                                <?php echo htmlspecialchars($result['text']);?>
                            </div>
                            <div style="text-align: right;padding: 10px;">
							
                                <a style="text-decoration-line: underline;" href="http://<?php echo $result['link'];?>" target="_blank">
                                        <?php echo htmlspecialchars($result['a_text']);?>
                                 </a>
                                 <div>
                                        <?php echo htmlspecialchars($result['last_text']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }

    private function getContent() {
        $html_string = file_get_contents('http://www.iwanami.co.jp/meigen/heute.html');
        $dom = new DOMDocument();
        $dom->encoding = 'UTF-8';
        $dom->loadHTML($html_string);
        $divs = $dom->getElementsByTagName("div");
        foreach ($divs as $div) {
            if ($div->getAttribute('id') == 'witt_frame') {
                $divs = $div->getElementsByTagName("div");
                break;
            }
        }
        $text = '';
        $link = 'www.iwanami.co.jp';
        $a_text = '';
        $last_text = '';
        foreach ($divs as $div) {
            if ($div->getAttribute('class') == 'witticism') {
                $text = $div->nodeValue;
            }
            if ($div->getAttribute('class') == 'source') {
                $as = $div->getElementsByTagName('a');
                foreach ($as as $a) {
                    $link.=$a->getAttribute('href');
                    $a_text = $a->nodeValue;
                }
            }
            if ($div->getAttribute('class') == 'comment') {
                $last_text = $div->nodeValue;
            }
        }
        return array('link'=>$link,'text'=>$text,'last_text'=>$last_text,'a_text'=>$a_text);
    }

}
