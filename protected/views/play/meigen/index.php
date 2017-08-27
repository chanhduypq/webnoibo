<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/play/css/secondary.css" rel="stylesheet" type="text/css"/>
<script language="javascript">
jQuery(function($)
{  
	$("body").attr('id','play');  
});	
</script>

<div class="wrap play secondary meigen">
    <div class="container">
        <div class="contents index">
            <div class="mainBox">
            	<div class="pageTtl">
				<h2>今日の名言</h2>
					<a  href="<?php echo Yii::app()->baseUrl?>/play" class="btn btn-important">
						<i class="icon-home icon-white"></i> 
							あそびのTopへ戻る
					</a>
					</div>
                <div class="box">
				
                	<div id="witt_frame">
						<div class="witticism">
						<?php echo htmlspecialchars($text);?>
						</div>
						<div class="source">
							
							<a href="http://<?php echo $link;?>" target="_blank">
								<?php echo htmlspecialchars($a_text);?>
							 </a>
							 <div class="comment">
								<?php echo htmlspecialchars($last_text);?>
							</div>
						</div>
					</div>
                </div><!-- /box -->
            </div><!-- /mainBox -->
            
        </div><!-- /contents -->
        <p id="page-top">
			<a href="#wrap">PAGE TOP</a>
		</p>
    </div><!-- /container -->
    <div class="footer">
    	<p>COPYRIGHT (C) Newgin  ALL RIGHTS RESERVED.</p>
    </div>
</div>






