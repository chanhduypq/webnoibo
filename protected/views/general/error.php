<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
	jQuery(function($) 
	{
		$("body").attr('id','work');      
	});
</script>
<?php $index=Yii::app()->baseUrl.'/work'?>
<div class="wrapper secondary admin">

    
        <div class="contents detail">
        	
            <div class="mainBox detail">
				<?php switch ($error['code']) 
				{
					case 401:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i>Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo '<br />';						
						echo '</div>';
					break;	
					case 404:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i> Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo 'Bạn không có quyền truy cập chức năng này<br />';						
						echo '</div>';
					break;
					case 405:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i>Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo '<br />';						
						echo '</div>';
					break;
					case 408:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i>Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo '<br />';						
						echo '</div>';
					break;
					case 500:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i>Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo '<br />';						
						echo '</div>';
					break;
					case 501:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i>Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo '<br />';						
						echo '</div>';
					break;
					case 503:
						echo '<div class="pageTtl">';
						echo '<h2></h2>';
						echo '<span>';
						echo '<a href='.$index.' class="btn btn-important">';
						echo '<i class="icon-home icon-white"></i>Home</a>';
						echo '</span>';
						echo '</div>';
						echo '<div class="box">';
						echo '<br />';						
						echo '</div>';
					break;
				}
				?>
            </div><!-- /mainBox -->
            
            
        </div><!-- /contents -->
        

</div><!-- /wrap -->

