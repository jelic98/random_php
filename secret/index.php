<html>
    <?php
        define(SECRET, 'p@$$w0rd');
        define(IMAGES, glob('img/*'));
        define(THEMES, ['#000000']);
        define(TITLE, 'Secret page');
        define(INPUT, 'Enter key');
        define(ERROR, 'Incorrent key');
        define(SUBMIT, 'OK');
    
        $theme = THEMES[date('s') % count(THEMES)];
    ?>
    <head>
        <title><?php echo TITLE; ?></title>
	    <meta name="theme-color" content="<?php echo $theme; ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
	    <style>
		    body{
		        margin: 0;
		        background-color: black;
		        background-size: contain;
		        background-repeat: no-repeat;
		    
		        <?php
                    if(isset($_POST['secret'])) {
                        if(!strcasecmp($_POST['secret'], SECRET)) {
                            echo 'background-image: url(' . IMAGES[date('z') % count(IMAGES)] . ');}';
                            exit;
                        }
            
                        $error = ERROR;
                    }
                ?>
		    }
		    
		    *{font-family: 'Dosis', sans-serif;}input{outline:0;border:none}input:focus{border-color:transparent!important}input:focus::-webkit-input-placeholder{color:transparent}input:focus:-moz-placeholder{color:transparent}input:focus::-moz-placeholder{color:transparent}input:focus:-ms-input-placeholder{color:transparent}input::-webkit-input-placeholder{color:#adadad}input:-moz-placeholder{color:#adadad}input::-moz-placeholder{color:#adadad}input:-ms-input-placeholder{color:#adadad}button{outline:0!important;border:none;background:<?php echo $theme; ?>}button:hover{cursor:pointer}.container-contact100{width:100%;min-height:100vh;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;flex-wrap:wrap;justify-content:center;align-items:center;padding:15px;background:<?php echo $theme; ?>}.label-input100{font-size:13px;color:#666666;line-height: 1.5;padding-left:5px}.wrap-contact100{width:500px;background:#fff;border-radius:10px;overflow:hidden;padding:42px 55px 45px 55px}.contact100-form{width:100%}.wrap-input100{width:100%;position:relative;border-bottom:2px solid #d9d9d9;padding-bottom:13px;margin-bottom:27px}.input100{display:block;width:100%;background:0 0;font-size:18px;color:#333;line-height:1.2;padding:0 5px}.focus-input100{position:absolute;display:block;width:100%;height:100%;top:0;left:0;pointer-events:none}.focus-input100::before{content:"";display:block;position:absolute;bottom:-2px;left:0;width:0;height:2px;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;transition:all .4s;background:#7f7f7f}input.input100{height:40px}.input100:focus+.focus-input100::before{width:100%}.container-contact100-form-btn{display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;flex-wrap:wrap;justify-content:center;padding-top:13px}.wrap-contact100-form-btn{width:100%;display:block;position:relative;z-index:1;border-radius:25px;overflow:hidden;margin:0 auto}.contact100-form-bgbtn{position:absolute;z-index:-1;width:300%;height:100%;background:#000;top:0;left:-100%;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;transition:all .4s}.contact100-form-btn{display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;justify-content:center;align-items:center;padding:0 20px;width:100%;height:50px;font-size:16px;color:#fff;line-height:1.2}.wrap-contact100-form-btn:hover .contact100-form-bgbtn{left:0}@media (max-width:576px){.wrap-contact100{padding:72px 15px 65px 15px}}
	    </style>
    </head>
    <body>
	    <div class="container-contact100">
		    <div class="wrap-contact100">
			    <form class="contact100-form" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
				    <div class="wrap-input100 validate-input">
					    <?php
						    echo '<span class="label-input100">' . $error . '</span>';
						?>
					    <input class="input100" type="password" name="secret" placeholder="<?php echo INPUT; ?>">
					    <span class="focus-input100"></span>
				    </div>
				    <div class="container-contact100-form-btn">
					    <div class="wrap-contact100-form-btn">
						    <div class="contact100-form-bgbtn"></div>
						    <button class="contact100-form-btn"><?php echo SUBMIT; ?></button> 
					    </div>
				    </div>
			    </form>
		    </div>
	    </div>
    </body>
</html>
