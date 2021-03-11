<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->email) ?>,</p>

    <p>Click button below to reset your password</p>

    <p>
        <?php //echo Html::a(Html::encode($resetLink), $resetLink) ?>
        <a href="<?= $resetLink ?>" class="btn btn-success btn-sm" style="display: inline-block; background: green; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 30px; margin: 0; text-decoration: none; text-transform: uppercase; padding: 10px 25px; mso-padding-alt: 0px; border-radius: 30px;" target="_blank"> Reset password </a>

    </p>
</div>
<div>
    <span style="color:rgb(170,170,170);font-family:helvetica,arial;font-size:10px">------------------------------<wbr>---</span>
</div>
<div>
    <span style="font-family:helvetica,arial;margin-right:5px;color:rgb(6,52,214);font-size:15px">
        <b>ESAPP MIS</b>
    </span>
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">&nbsp;</span>
    <br style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">
    <br style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px;font-stretch:normal;line-height:normal">
        <b>Email&nbsp;</b><a href="mailto:" target="_blank"><font color="#3388cc"></font></a>
    </span>
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px;font-stretch:normal;line-height:normal"><br></span>
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px;font-stretch:normal;line-height:normal">
        <b>Work</b>&nbsp;<a href="tel:+260 211 260174" style="color:rgb(51,136,204)" target="_blank">
            +260 211 260174
        </a>
    </span>
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px;font-stretch:normal;line-height:normal">
        <b>WhatsApp</b>&nbsp;<a href="tel:+260 211 260174" style="color:rgb(51,136,204)" target="_blank">
            +260 211 260174
        </a>
    </span>
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">&nbsp;</span>
    <br style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">
    <span style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">Plot 9019, Mwalumina Rd, Woodlands., 10101 Lusaka, Zambia</span>
    <br/>
    <span style="font-family:helvetica,arial;font-size:12px;margin-right:5px;color:rgb(6,52,214)">
        <b>Enhanced Smallholder Promotion Programme(E-SAPP)-Ministry of Agriculture</b>
    </span> <br style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">
    <table cellpadding="0" border="0" style="color:rgb(3,3,3);font-family:helvetica,arial;font-size:12px">
        <tbody>
            <tr>
                <td style="padding-right:4px">
                    <a href="https://web.facebook.com/ESAPPZambia/" style="display:inline-block" target="_blank" data-saferedirecturl="">
                        <img width="30" height="30" src="https://ci3.googleusercontent.com/proxy/THpCB2NEElBH9_94gJ0jhMIiKidOmrbZyt9oJF2QDycbMd09yLlxVG5iKxSUkl7OOUm4jloV0FPx05HuZ-TAh_NEVMEYv9kif_UJs8UW_61dbF1a=s0-d-e1-ft#https://s1g.s3.amazonaws.com/977575c7512d986349fbf5dc1027d0ba.png" alt="Facebook" style="border:none" class="CToWUd">
                    </a>
                </td>
                <td style="padding-right:4px">
                    <a href="#" style="display:inline-block" target="_blank" data-saferedirecturl="">
                        <img width="30" height="30" src="https://ci6.googleusercontent.com/proxy/rOEdCompM_1xDZaE2dHUDvlnWa7ogeEvDqIdVb9EWf5hiuRbQezhE_-dtuy-wtCLYunHXKuh81saHhDNUY7-GRlrjQGDlRpWWiL7Df_AIseUDIpe=s0-d-e1-ft#https://s1g.s3.amazonaws.com/19e2ba5551c4ef7f51facbef9a193ff7.png" alt="Twitter" style="border:none" class="CToWUd">
                    </a>
                </td>
                <td style="padding-right:4px"><br></td>
            </tr>
        </tbody>
    </table>
    <a href="https://www.agriculture.gov.zm" style="color:rgb(51,136,204);font-family:helvetica,arial;font-size:12px" target="_blank" >https://www.agriculture.gov.zm</a><br>
</div>
<div>
    <br>
</div>
<!--<div>
    <img src="https://ci6.googleusercontent.com/proxy/95TNuAVpQOdT5qKQ-nBMqWl-W2s8LG7A31oAumQVBWiQwnSYsIjaJV8fmtEWw4MkUqma0ICyGLV0IcNa8tTxWTTys21s5YSB6PX16YPqmY4qnEMwZFtPSnCh0ovvY1REm0c-nQs3wo1ddJiO2OHas3nmiZKwF2nH2R4chCC8L00vmcdB89ErKO0fX4nE8u4sq4aYVSvEJmsxmuyePw=s0-d-e1-ft#https://docs.google.com/uc?export=download&amp;id=14ll2JXz7ybO0v43EJlr7w3lGpHSA-ZqF&amp;revid=0Bx0A9BHBdXBAZGlOR1h5VzJGSUZBcWU1U2hMQ2w2Qk9pWWNFPQ" class="CToWUd"><br>
</div>-->
<div>
    <span style="color:rgb(170,170,170);font-family:helvetica,arial;font-size:12px">
        This email is auto generated by the ESAPP MIS.Please do not reply to this email...
    </span>
</div>
<div>
    <span style="color:rgb(170,170,170);font-family:helvetica,arial;font-size:10px">The content of this email is confidential and intended for the recipient specified in message only. It is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. If you received this message by mistake, please reply to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future.</span>
</div>
<div>
    <br>
</div>
<div>
    <span style="color:rgb(170,170,170);font-family:helvetica,arial;font-size:10px">------------------------------<wbr>---</span>
</div>
