<?php
include('core/configFb.php');
$helper = $fb->getRedirectLoginHelper();
$permission = ['email'];
$loginUrl = $helper->getLoginUrl('https://paraline.local:80/?controller=user&action=home', $permission);
