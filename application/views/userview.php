<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <style type="text/css">
            body{text-align: left; margin: 5px 180px;}
            .login{background: url("<?php echo $base_url; ?>/images/flogin.png") no-repeat scroll center transparent; min-width: 83px; min-height:20px; margin: 90px;}
            .logout{background: url('<?php echo $base_url; ?>/images/flogout.png') no-repeat scroll left transparent; min-width: 72px; min-height:21px; margin-top:5px;}
            .cb{clear: both;}
            .key{min-width: 100px; float: left;}
            .value{color: #cc0000; float: left; max-width: 800px}
            .ar{color:darkred; cursor: pointer;}
            .friendsBlock{height: auto; overflow: hidden; width: 1000px;}
            .friendsImage,.friendsName{width: 100px;}
            .row{float:left; height:100px; font-size: 12px; font-family: arial;}
            .fblink{text-decoration: none; color: #333;}
            .fblink:hover{color: lightcoral; text-decoration-style: double;}
        </style>
    </head>
    <body>
        <?php if($fb_uid === FALSE): ?>
        <a href="<?php echo $loginUrl; ?>"><div class="login"></div></a>
        <?php else: ?>
            <?php if($loggedIn != FALSE): ?>
                <a href="<?php echo $logoutUrl; ?>"><div class="logout"></div></a>
                <div class="contentFromFb">
                    <img src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=large" />
                    <br/>
                    <div class="cb">
                        <strong>Access Token: </strong><br/><div class="value"><?php echo $userAccessToken; ?></div>
                    </div>
                    <div class="cb">
                        <strong>User Details: </strong><br/>
                        <?php foreach ($user as $key=>$value):
                                if(!is_array($value)):
                                    echo '<div class="ud cb"><div class="key">'.$key.'</div> <div class="value">:'.$value.'</div></div>';
                                else:
                                    echo '<div class="ud cb"><div class="key">'.$key.'</div> <div class="ar value">:has got array of values</div></div>';
                                endif;
                              endforeach; ?>
                    </div>
                    <div class="cb">
                        <strong>Friends: </strong><br/>
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
                </div>
            <?php else: ?>
                <a href="<?php echo $loginUrl; ?>"><div class="login"></div></a>
            <?php endif; ?>
        <?php endif; ?>
    </body>
</html>
