<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Friendslist.php
 * 
 * Description: This webpage is to display the list of friends in your account
 * 
 * @package friendslist
 * @author Elavarasan Lee
 * @version 1.0.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Friends</title>
    <style type="text/css">
            .login{background: url("<?php echo $base_url; ?>/images/flogin.png") no-repeat scroll center transparent; max-width: 83px; min-height:20px; margin: 90px;}
            .logout{background: url('<?php echo $base_url; ?>/images/flogout.png') no-repeat scroll left transparent; max-width: 72px; min-height:21px; margin-top:5px;}
        .cb{clear: both;}
        .friendsBlock{height: auto; overflow: hidden; width: 1000px;}
        .friendsImage,.friendsName{width: 100px;}
        .row{float:left; height:100px; font-size: 12px; font-family: arial;}
    </style>
</head>
<body>
    <?php if($fb_uid === FALSE): ?>
        <a href="<?php echo $loginUrl; ?>"><div class="login"></div></a>
        <?php else: ?>
            <?php if($loggedIn != FALSE): ?>
                <a href="<?php echo $logoutUrl; ?>"><div class="logout"></div></a>
    <div class="cb">
    <strong>Your Friends: </strong><br/>
        <div class="friendsBlock">
        <?php foreach($friends as $sno=>$details): #if($sno>='39'){ break; }?>
            <div class="row">
                  <div class="friendsImage">
                      <a href="http://facebook.com/<?php echo $details['id'] ?>" target="_blank" class="fblink">
                        <img src="http://graph.facebook.com/<?php echo $details['id'] ?>/picture?type=square" />
                      </a>
                  </div>
                  <div class="friendsName">
                      <a href="http://facebook.com/<?php echo $details['id'] ?>" target="_blank" class="fblink">
                        <?php echo $details['name']; ?>
                      </a>
                  </div>
             </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php else: ?>
        <a href="<?php echo $loginUrl; ?>"><div class="login"></div></a>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
