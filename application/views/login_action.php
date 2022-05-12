<!DOCTYPE HTML>
<html class="loginPage" dir="ltr">
    <head>
        <title>Health Management Information System</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">
        <meta name="description" content="DHIS 2">
        <meta name="keywords" content="DHIS 2">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../javascripts/jQuery/jquery.min.js"></script>
        <script>
        $.ajaxSetup( {
          beforeSend: function(xhr) {
            xhr.setRequestHeader(
                'X-Requested-With',
                {
                  toString: function() {
                    return '';
                  }
                }
            );
          }
        } );
        </script>
        <script type="text/javascript" src="login.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/widgets.css">
        <link type="text/css" rel="stylesheet" href="../css/login.css">
        <link type="text/css" rel="stylesheet" href="../../api/files/style/external" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  
  </head>

    <body class="loginPage">
        <h1 style="display:none">Health Management Information System</h1>
        <div style="display:none">DHIS 2</div>
        <div>
                    <img id="flagArea" src="<?php echo base_url('assets/images/zanzibar.png') ?>">
                            <span id="titleArea">Health Management Information System</span>
                            <span id="introArea">Mfumo wa Kukusanya Taarifa za Uendeshaji wa Huduma za Afya</span>
                </div>
                <div id="accountArea">
        <h3>Other Related Links</h3>
        <p><i class="fa fa-globe"></i>&nbsp;&nbsp;<strong><a target="_blank" href="https://mohz.go.tz">MoHSWEGC Website</a></strong></p>
        <p><i class="fa fa-film"></i>&nbsp;&nbsp;<strong><a target="_blank" href="https://ihris.mohz.go.tz">Human Resource for Health(IHRIS)</a></strong></p>
                        </div>
                <div id="loginField">
        <div id="loginArea">
            <div id="bannerArea">
            <a href="http://www.dhis2.org"><img src="<?php echo base_url('assets/images/logo_front.png') ?>" style="border:none"></a>
            </div>
            
            <form id="loginForm" action="<?=base_url('login/dhis2/user')?>" method="post">
                <div>
                    <div id="signInLabel">Sign in</div>
                    <div><input type="text" id="j_username" name="j_username" placeholder="Username" required></div>
                    <div><input type="password" id="j_password" name="j_password" autocomplete="off" placeholder="Password" required></div>
                    <div>
                        <label><input type="checkbox" name="2fa" value="2fa" id="2fa" />Login using two factor authentication</label>
                        <input type="code" id="2fa_code" name="2fa_code" placeholder="Two factor authentication code" hidden readonly >
                    </div>
                </div>
                <div id="submitDiv">
                    <input id="submit" class="button" type="submit" value="Sign in">
                </div>
            </form>

            <?php if (isset($_SESSION['wrong_password'])) { ?>
               <div id="loginMessage"><?php echo $_SESSION['wrong_password'] ?></div>
             <?php  }  ?>
           
            <div id="notificationArea">              
              Contact HMIS for Login Rights
            </div>
                        <!--[if lte IE 8]>
            <div id="notificationArea" style="color: white; background-color: red;">Please upgrade your browser. Internet Explorer version 8 and earlier is not supported.</div>
            <![endif]-->
        </div>
        </div>
        <div id="footerArea">
            <div id="leftFooterArea" class="innerFooterArea">
                Powered by <a href="http://www.dhis2.org">DHIS 2</a>&nbsp; <span id="applicationFooter">Revolutionary Government of Zanzibar</span>
            </div>
            <div id="rightFooterArea" class="innerFooterArea">
                <span id="applicationRightFooter">Information is Power</span>
                <select id="localeSelect" onchange="login.localeChanged()" style="margin-left: 30px">
                    <option value="">[ Change language ]</option>
                                        <option value="ar">Arabic</option>
                                        <option value="ar">Arabic (Egypt)</option>
                                        <option value="ar">Arabic (Iraq)</option>
                                        <option value="ar">Arabic (Sudan)</option>
                                        <option value="bn">Bengali</option>
                                        <option value="bi">Bislama</option>
                                        <option value="my">Burmese</option>
                                        <option value="zh">Chinese</option>
                                        <option value="zh">Chinese (China)</option>
                                        <option value="cs">Czech</option>
                                        <option value="da">Danish</option>
                                        <option value="en">English</option>
                                        <option value="fr">French</option>
                                        <option value="in">Indonesian</option>
                                        <option value="in">Indonesian (Indonesia)</option>
                                        <option value="km">Khmer</option>
                                        <option value="rw">Kinyarwanda</option>
                                        <option value="lo">Lao</option>
                                        <option value="mn">Mongolian</option>
                                        <option value="ne">Nepali</option>
                                        <option value="nb">Norwegian Bokmål</option>
                                        <option value="pt">Portuguese</option>
                                        <option value="pt">Portuguese (Brazil)</option>
                                        <option value="ps">Pushto</option>
                                        <option value="ru">Russian</option>
                                        <option value="es">Spanish</option>
                                        <option value="sv">Swedish</option>
                                        <option value="tg">Tajik</option>
                                        <option value="tet">Tetum</option>
                                        <option value="uk">Ukrainian</option>
                                        <option value="ur">Urdu</option>
                                        <option value="uz">Uzbek</option>
                                        <option value="vi">Vietnamese</option>
                                        <option value="ckb">ckb</option>
                                        <option value="prs">prs</option>
                                    </select>
            </div>
        </div>
    </body>
    <style>
        
*
{
  font-family: LiberationSans, sans-serif;
  line-height: 125%;
}

html,body
{
  background-color: #1d5288;  
  color: white;
  font-size: 15px;
}

a
{
  color: #e6eaf1;
  text-decoration: none;
}

a:hover
{
  color: #fff;
  text-decoration: underline;
}

#flagArea
{
  position: absolute;
  top: 22px;
  left: 52px;
  border: 1px solid #d5d5d5;
  border-radius: 2px;
  max-width: 105px;
  margin-bottom: 5%;
}

#titleArea
{
  position: absolute;
  top: 24px;
  left: 177px;
  font-size: 19px;
}

#introArea
{
  width: 250px;
  position: absolute;
  top: 53px;
  left: 177px;
  font-size: 17px;
  color: #bfd9f2;
}

#bannerArea
{
  margin-bottom: 21px;
  border: none;
  text-align: center;
}

#accountArea
{
  position: absolute;
  top: 22px;
  right: 17px;
  padding: 18px 30px 18px 0;
  font-size: 17px;
}

#loginField
{
  position: relative;
  margin: 128px auto 0 auto;
  width: 270px;
}

#signInLabel
{
  padding: 5px 0 1px 0;
  font-size: 13px;
}

#submitDiv
{
  padding: 3px 0 20px 0;
}

#loginField input[type=text],input[type=password],input[type=code]
{
  width: 255px;
  height: 22px;
  border: 1px solid #888;
  padding: 6px 6px;
  margin: 4px 0;
  border-radius: 3px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.14);
}

#loginMessage
{
  background-color: #3b6da1;
  border-style: solid;
  border-width: 1px;
  border-color: #D0D0D0;
  padding: 11px;
  margin: 20px 0;
  display: block;
  width: auto;
  text-align: center;
  border-radius: 2px;
}

#notificationArea
{
  background-color: #DAEAFA;
  color: #333;
  margin-top: 15px;
  padding: 15px;
  border-radius: 3px;
}

#notificationArea:empty
{
  display: none;
}

#notificationArea a 
{
  color: #2E527C;
}

#footerArea
{
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 8px 0 7px 0;
  font-size: 13px;
  border-top: 1px solid #416f9d;
  color: #6b90b8;
  width: 100%;
}

.innerFooterArea
{
  line-height: 26px;
  display: inline-block;
  vertical-align: middle;
}  

#leftFooterArea
{
  float: left;
  margin-left: 50px;
}

#rightFooterArea
{
  float: right;
  margin-right: 50px;
}

#localeSelect
{
  width: 160px;
}
    
.greenButtonLink
{
  padding: 6px 12px;
  height: 27px;
  border: 1px solid #67A767;
  border-radius: 3px;
  margin-right: 4px;
  font-family: LiberationSansBold, arial;
  font-size: 13px;
  background-color: #1A9B20;
  color: #fff !important;
  text-decoration: none !important;
}

.greenButtonLink:hover
{
  text-decoration: none;
  background-color: #1DA223;
}

.button 
{
  font-family: LiberationSansBold, arial;
  background: -webkit-linear-gradient(top, #f1f1f1, #d1d1d1);
  background: -moz-linear-gradient(top, #f1f1f1, #d1d1d1);
  background: -ms-linear-gradient(top, #f1f1f1, #d1d1d1);
  background: -o-linear-gradient(top, #f1f1f1, #d1d1d1);
  height: 34px;
  border: 1px solid #444;
  border-radius: 3px;
  color: #222;
  width: 130px;
}

.button:hover 
{
  background: -webkit-linear-gradient(top, #fafafa, #dadada);
  background: -moz-linear-gradient(top, #fafafa, #dadada);
  background: -ms-linear-gradient(top, #fafafa, #dadada);
  background: -o-linear-gradient(top, #fafafa, #dadada);
  border: 1px solid #333333;
}

@font-face {
    font-family: 'LiberationSansRegular';
    src: url('../fonts/LiberationSans-Regular-webfont.eot');
    src: url('../fonts/LiberationSans-Regular-webfont.eot?#iefix') format('eot'),
         url('../fonts/LiberationSans-Regular-webfont.woff') format('woff'),
         url('../fonts/LiberationSans-Regular-webfont.ttf') format('truetype'),
         url('../fonts/LiberationSans-Regular-webfont.svg#webfontc8rbNdBe') format('svg');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'LiberationSansBold';
    src: url('../fonts/LiberationSans-Bold-webfont.eot');
    src: url('../fonts/LiberationSans-Bold-webfont.eot?#iefix') format('eot'),
         url('../fonts/LiberationSans-Bold-webfont.woff') format('woff'),
         url('../fonts/LiberationSans-Bold-webfont.ttf') format('truetype'),
         url('../fonts/LiberationSans-Bold-webfont.svg#webfontHyWb8e07') format('svg');
    font-weight: normal;
    font-style: normal;
}


    </style>
</html>