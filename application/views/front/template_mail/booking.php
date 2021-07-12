<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta name="x-apple-disable-message-reformatting" />
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="color-scheme" content="light dark" />
   <meta name="supported-color-schemes" content="light dark" />
   <title></title>
   <style type="text/css" rel="stylesheet" media="all">
      /* Base ------------------------------ */

      @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&amp;display=swap");

      body {
         width: 100% !important;
         height: 100%;
         margin: 0;
         -webkit-text-size-adjust: none;
      }

      a {
         color: #3869D4;
      }

      a img {
         border: none;
      }

      td {
         word-break: break-word;
      }

      .preheader {
         display: none !important;
         visibility: hidden;
         mso-hide: all;
         font-size: 1px;
         line-height: 1px;
         max-height: 0;
         max-width: 0;
         opacity: 0;
         overflow: hidden;
      }

      /* Type ------------------------------ */

      body,
      td,
      th {
         font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
      }

      h1 {
         margin-top: 0;
         color: #333333;
         font-size: 22px;
         font-weight: bold;
         text-align: left;
      }

      h2 {
         margin-top: 0;
         color: #333333;
         font-size: 16px;
         font-weight: bold;
         text-align: left;
      }

      h3 {
         margin-top: 0;
         color: #333333;
         font-size: 14px;
         font-weight: bold;
         text-align: left;
      }

      td,
      th {
         font-size: 16px;
      }

      p,
      ul,
      ol,
      blockquote {
         margin: .4em 0 1.1875em;
         font-size: 16px;
         line-height: 1.625;
      }

      p.sub {
         font-size: 13px;
      }

      /* Utilities ------------------------------ */

      .align-right {
         text-align: right;
      }

      .align-left {
         text-align: left;
      }

      .align-center {
         text-align: center;
      }

      /* Buttons ------------------------------ */

      .button {
         background-color: #3869D4;
         border-top: 10px solid #3869D4;
         border-right: 18px solid #3869D4;
         border-bottom: 10px solid #3869D4;
         border-left: 18px solid #3869D4;
         display: inline-block;
         color: #FFF;
         text-decoration: none;
         border-radius: 3px;
         box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
         -webkit-text-size-adjust: none;
         box-sizing: border-box;
      }

      .button--green {
         background-color: #22BC66;
         border-top: 10px solid #22BC66;
         border-right: 18px solid #22BC66;
         border-bottom: 10px solid #22BC66;
         border-left: 18px solid #22BC66;
      }

      .button--red {
         background-color: #FF6136;
         border-top: 10px solid #FF6136;
         border-right: 18px solid #FF6136;
         border-bottom: 10px solid #FF6136;
         border-left: 18px solid #FF6136;
      }

      @media only screen and (max-width: 500px) {
         .button {
            width: 100% !important;
            text-align: center !important;
         }
      }

      /* Attribute list ------------------------------ */

      .attributes {
         margin: 0 0 21px;
      }

      .attributes_content {
         background-color: #F4F4F7;
         padding: 16px;
      }

      .attributes_item {
         padding: 0;
      }

      /* Related Items ------------------------------ */

      .related {
         width: 100%;
         margin: 0;
         padding: 25px 0 0 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      .related_item {
         padding: 10px 0;
         color: #CBCCCF;
         font-size: 15px;
         line-height: 18px;
      }

      .related_item-title {
         display: block;
         margin: .5em 0 0;
      }

      .related_item-thumb {
         display: block;
         padding-bottom: 10px;
      }

      .related_heading {
         border-top: 1px solid #CBCCCF;
         text-align: center;
         padding: 25px 0 10px;
      }

      /* Discount Code ------------------------------ */

      .discount {
         width: 100%;
         margin: 0;
         padding: 24px;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
         background-color: #F4F4F7;
         border: 2px dashed #CBCCCF;
      }

      .discount_heading {
         text-align: center;
      }

      .discount_body {
         text-align: center;
         font-size: 15px;
      }

      /* Social Icons ------------------------------ */

      .social {
         width: auto;
      }

      .social td {
         padding: 0;
         width: auto;
      }

      .social_icon {
         height: 20px;
         margin: 0 8px 10px 8px;
         padding: 0;
      }

      /* Data table ------------------------------ */

      .purchase {
         width: 100%;
         margin: 0;
         padding: 35px 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      .purchase_content {
         width: 100%;
         margin: 0;
         padding: 25px 0 0 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      .purchase_item {
         padding: 10px 0;
         color: #51545E;
         font-size: 15px;
         line-height: 18px;
      }

      .purchase_heading {
         padding-bottom: 8px;
         border-bottom: 1px solid #EAEAEC;
      }

      .purchase_heading p {
         margin: 0;
         color: #85878E;
         font-size: 12px;
      }

      .purchase_footer {
         padding-top: 15px;
         border-top: 1px solid #EAEAEC;
      }

      .purchase_total {
         margin: 0;
         text-align: right;
         font-weight: bold;
         color: #333333;
      }

      .purchase_total--label {
         padding: 0 15px 0 0;
      }

      body {
         background-color: #FFF;
         color: #333;
      }

      p {
         color: #333;
      }

      .email-wrapper {
         width: 100%;
         margin: 0;
         padding: 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      .email-content {
         width: 100%;
         margin: 0;
         padding: 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      /* Masthead ----------------------- */

      .email-masthead {
         padding: 25px 0;
         text-align: center;
      }

      .email-masthead_logo {
         width: 94px;
      }

      .email-masthead_name {
         font-size: 16px;
         font-weight: bold;
         color: #A8AAAF;
         text-decoration: none;
         text-shadow: 0 1px 0 white;
      }

      /* Body ------------------------------ */

      .email-body {
         width: 100%;
         margin: 0;
         padding: 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      .email-body_inner {
         width: 570px;
         margin: 0 auto;
         padding: 0;
         -premailer-width: 570px;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
      }

      .email-footer {
         width: 570px;
         margin: 0 auto;
         padding: 0;
         -premailer-width: 570px;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
         text-align: center;
      }

      .email-footer p {
         color: #A8AAAF;
      }

      .body-action {
         width: 100%;
         margin: 30px auto;
         padding: 0;
         -premailer-width: 100%;
         -premailer-cellpadding: 0;
         -premailer-cellspacing: 0;
         text-align: center;
      }

      .body-sub {
         margin-top: 25px;
         padding-top: 25px;
         border-top: 1px solid #EAEAEC;
      }

      .content-cell {
         padding: 35px;
      }

      /*Media Queries ------------------------------ */

      @media only screen and (max-width: 600px) {

         .email-body_inner,
         .email-footer {
            width: 100% !important;
         }
      }

      @media (prefers-color-scheme: dark) {
         body {
            background-color: #333333 !important;
            color: #FFF !important;
         }

         p,
         ul,
         ol,
         blockquote,
         h1,
         h2,
         h3,
         span,
         .purchase_item {
            color: #FFF !important;
         }

         .attributes_content,
         .discount {
            background-color: #222 !important;
         }

         .email-masthead_name {
            text-shadow: none !important;
         }
      }

      :root {
         color-scheme: light dark;
         supported-color-schemes: light dark;
      }
   </style>
   <!--[if mso]>
    <style type="text/css">
      .f-fallback  {
        font-family: Arial, sans-serif;
      }
    </style>
  <![endif]-->
   <style type="text/css" rel="stylesheet" media="all">
      body {
         width: 100% !important;
         height: 100%;
         margin: 0;
         -webkit-text-size-adjust: none;
      }

      body {
         font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
      }

      body {
         background-color: #FFF;
         color: #333;
      }
   </style>
</head>

<body style="width: 100% !important; height: 100%; -webkit-text-size-adjust: none; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; background-color: #FFF; color: #333; margin: 0;" bgcolor="#FFF">
   <span class="preheader" style="display: none !important; visibility: hidden; mso-hide: all; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden;"><?= $setting->nama?>. Please submit payment by <?= date('d-m-Y')?></span>
   <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 0;">
      <tr>
         <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 0;">
               <tr>
                  <td class="email-masthead" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: center; padding: 25px 0;" align="center">
                     <a href="https://example.com" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                        <?= $setting->nama ?>
                     </a>
                  </td>
               </tr>
               <!-- Email Body -->
               <tr>
                  <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="word-break: break-word; margin: 0; padding: 0; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                     <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0 auto; padding: 0;">
                        <!-- Body content -->
                        <tr>
                           <td class="content-cell" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 35px;">
                              <div class="f-fallback">
                                 <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Hi <?= $order->nama_depan ?> <?= $order->nama_belakang ?> ,</h1>
                                 <p style="font-size: 16px; line-height: 1.625; color: #333; margin: .4em 0 1.1875em;">Terimakasih telah memesan kamar dihotel kami, selanjutnya silahkan melakukan pembayaran sesuai dengan harga ketentuan.</p>
                                 <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 30px auto; padding: 0;">
                                    <tr>
                                       <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                             <tr>
                                                <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                                   <a href="<?= site_url('account/download/struck/' . $order->id_order) ?>" class="f-fallback button button--green" target="_blank" style="color: #FFF; border-color: #22bc66; border-style: solid; border-width: 10px 18px; background-color: #22BC66; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Download Invoice</a>
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                                 <table class="purchase" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 35px 0;">
                                    <tr>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: left;" align="left">No Order: <?= $order->no_order ?></h3>
                                       </td>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 class="align-right" style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: right;" align="right"><?= date_time_convert($order->tgl_order) ?></h3>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: left;" align="left">Check-in: <?= tgl_indo($order->check_in) ?></h3>
                                       </td>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 class="align-right" style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: right;" align="right">Check-out: <?= tgl_indo($order->check_out) ?></h3>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: left;" align="left">Tipe: <?= $order->tipe_kamar ?>(<?= $order->jml_kamar?> Kamar)</h3>
                                       </td>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 class="align-right" style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: right;" align="right">Durasi: <?= $order->malam ?> Malam</h3>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: left;" align="left">Pemesanan: <?= ($order->status == 1) ? 'Success' : '' ?> <?= ($order->status == 2) ? 'Canceled' : '' ?><?= ($order->status == 0) ? 'Pending' : ''; ?></h3>
                                       </td>
                                       <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <h3 class="align-right" style="margin-top: 0; color: #333333; font-size: 14px; font-weight: bold; text-align: right;" align="right">Pembayaran: <?= ($order->status_kode == 200) ? 'Berhasil' : '' ?> <?= ($order->status_kode == 201) ? 'Pending' : '' ?><?= ($order->status_kode == 200 || $order->status_kode == 0) ? 'Pending' : ''; ?></h3>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                          <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 25px 0 0;">
                                             <tr>
                                                <th class="purchase_heading" align="left" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                                   <p class="f-fallback" style="font-size: 12px; line-height: 1.625; color: #85878E; margin: 0;">Deskripsi</p>
                                                </th>
                                                <th class="purchase_heading" align="right" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                                   <p class="f-fallback" style="font-size: 12px; line-height: 1.625; color: #85878E; margin: 0;">Biaya
                                                   </p>
                                                </th>
                                             </tr>
                                             <?php $i = 1;
                                             foreach ($prices as $new) { ?>
                                                <tr>
                                                   <td width="80%" class="purchase_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 15px; color: #51545E; line-height: 18px; padding: 10px 0;"><span class="f-fallback"><?= $i ?>. <?= date_convert($new->tanggal) ?></span></td>
                                                   <td class="align-right" width="20%" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: right;" align="right"><span class="f-fallback">Rp. <?= number_format(rate_exchange($new->harga)) ?> 
                                                      </span></td>
                                                </tr>
                                             <?php $i++;
                                             } ?>
                                             <!-- <tr>
                                                <td width="80%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                   <p class="f-fallback purchase_total purchase_total--label" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0; padding: 0 15px 0 0;" align="right">Biaya Penginapan</p>
                                                </td>
                                                <td width="20%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                   <p class="f-fallback purchase_total" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0;" align="right">Rp. <?= number_format(rate_exchange($order->total)); ?></p>
                                                </td>
                                             </tr> -->

                                             <th class="purchase_heading" align="right" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                             </th>

                                             <th class="purchase_heading" align="right" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                             </th>

                                             <?php if (!empty($services)) { ?>
                                                <?php $i = 1;
                                                foreach ($services as $serv) {
                                                   $fs   =   json_decode($order->gratis_layanan);
                                                   $stl   =   '';
                                                   if (!empty($fs)) {
                                                      $stl      =   (in_array($serv->id_layanan, $fs)) ? 'stl' : '';
                                                   }
                                                ?>
                                                   <tr>
                                                      <td width="80%" class="purchase_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 15px; color: #51545E; line-height: 18px; padding: 10px 0;"><span class="f-fallback"><?= $i ?>. <?= $serv->judul ?> = Rp. <?= rate_exchange_order($serv->total, $order->biaya_unit); ?>/ <?php $tipe_biaya   =   '';
                                               if ($serv->tipe_biaya == 1) {
                                                  $tipe_biaya   =  'Per Orang';
                                               }
                                               if ($serv->tipe_biaya == 2) {
                                                  $tipe_biaya   =  'Per Malam';
                                               }
                                               if ($serv->tipe_biaya == 3) {
                                                  $tipe_biaya   =  'Biaya Tetap';
                                               }
                                               echo $tipe_biaya;
                                               ?></span></td>
                                                      <td class="align-right" width="20%" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: right;" align="right"><span class="f-fallback"> Rp. <?= rate_exchange_order($serv->total, $order->biaya_unit); ?></span></td>
                                                   </tr>
                                                <?php $i++;
                                                } ?>
                                             <?php } ?>

                                             <!-- <tr>
                                                <?php if ($order->total_gratis_layanan > 0) { ?>
                                                   <td width="80%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                      <p class="f-fallback purchase_total purchase_total--label" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0; padding: 0 15px 0 0;" align="right">Biaya Layanan</p>
                                                   </td>
                                                   <td width="20%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                      <p class="f-fallback purchase_total" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0;" align="right">Rp. <?= rate_exchange_order($order->jumlah_layanan - $order->total_gratis_layanan, $order->biaya_unit); ?></p>
                                                   </td>
                                                <?php } else { ?>
                                                   <td width="80%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                      <p class="f-fallback purchase_total purchase_total--label" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0; padding: 0 15px 0 0;" align="right">Biaya Layanan</p>
                                                   </td>
                                                   <td width="20%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                      <p class="f-fallback purchase_total" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0;" align="right">Rp. <?= rate_exchange_order($order->jumlah_layanan, $order->biaya_unit); ?></p>
                                                   </td>
                                                <?php } ?>
                                             </tr> -->

                                             <tr>
                                                <th class="purchase_heading" align="left" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                                </th>
                                                <th class="purchase_heading" align="right" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">

                                                </th>
                                             </tr>

                                             <?php if (!empty($order->voucher)) { ?>
                                                <tr>
                                                   <td width="80%" class="purchase_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 15px; color: #51545E; line-height: 18px; padding: 10px 0;"><span class="f-fallback">Voucher </span></td>
                                                   <td class="align-right" width="20%" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: right;" align="right"><span class="f-fallback"> hdhdhdh</span></td>
                                                </tr>
                                                <tr>
                                                   <th class="success">coupon</th>
                                                   <th class="table-active" id="grand_total" colspan="3">Rp. <?= rate_exchange_order($order->voucher_diskon, $order->biaya_unit); ?></th>
                                                </tr>
                                             <?php } ?>

                                             <?php if ($order->free_paid_services_amount > 0) { ?>
                                                <tr>
                                                   <td width="80%" class="purchase_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 15px; color: #51545E; line-height: 18px; padding: 10px 0;"><span class="f-fallback">Voucher </span></td>
                                                   <td class="align-right" width="20%" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: right;" align="right"><span class="f-fallback"> hdhdhdh</span></td>
                                                </tr>
                                                <tr>
                                                   <th class="purchase_heading" align="left" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                                   </th>
                                                   <th class="purchase_heading" align="right" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-bottom: 8px; border-bottom-width: 1px; border-bottom-color: #EAEAEC; border-bottom-style: solid;">
                                                   </th>
                                                </tr>
                                             <?php } ?>


                                             <tr>
                                                <td width="80%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                   <p class="f-fallback purchase_total purchase_total--label" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0; padding: 0 15px 0 0;" align="right">Jumlah Bayar</p>
                                                </td>
                                                <td width="20%" class="purchase_footer" valign="middle" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding-top: 15px; border-top-width: 1px; border-top-color: #EAEAEC; border-top-style: solid;">
                                                   <p class="f-fallback purchase_total" style="font-size: 16px; line-height: 1.625; text-align: right; font-weight: bold; color: #333333; margin: 0;" align="right">Rp. <?= rate_exchange_order($order->total_jumlah, $order->biaya_unit); ?></p>
                                                </td>
                                             <tr>
                                                <td width="80%" class="purchase_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 15px; color: #51545E; line-height: 18px; padding: 10px 0;"><span class="f-fallback"></span></td>
                                                <td class="align-right" width="20%" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: right;" align="right"><span class="f-fallback"> </span></td>
                                             </tr>

                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                                 <p style="font-size: 16px; line-height: 1.625; color: #333; margin: .4em 0 1.1875em;">jika ada pertanyaan seputar pemesanan, anda bisa menghubungi menghubungi kami dengan no <?= $setting->no_telepon ?> atau melalui email kami <a href="mailto:<?= $setting->email ?>" style="color: #3869D4;"><?= $setting->email ?></a>.
                                    <p style="font-size: 16px; line-height: 1.625; color: #333; margin: .4em 0 1.1875em;">Terima Kasih,
                                       <br /><?= $setting->nama ?></p>
                                    <!-- Sub copy -->
                              </div>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                     <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 0 auto; padding: 0;">
                        <tr>
                           <td class="content-cell" align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 35px;">
                              <p class="f-fallback sub align-center" style="font-size: 13px; line-height: 1.625; text-align: center; color: #A8AAAF; margin: .4em 0 1.1875em;" align="center">© <?= date('Y') ?> <?= $setting->nama ?>. All rights reserved.</p>
                              <p class="f-fallback sub align-center" style="font-size: 13px; line-height: 1.625; text-align: center; color: #A8AAAF; margin: .4em 0 1.1875em;" align="center">
                                 <?= $setting->nama ?>
                                 <br /><?= $setting->alamat ?>
                              </p>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</body>
</html>