 <!DOCTYPE html>
<html lang="en">
  <head>
    <title>Kode Central - Email</title>
    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--[if !mso]>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <![endif]-->
    <style type="text/css">
      /* CLIENT-SPECIFIC STYLES */

      #outlook a {
        padding: 0;
      }

      .ReadMsgBody {
        width: 100%;
      }

      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div,
      .ExternalClass * {
        line-height: 100%;
      }

      body,
      table,
      td,
      a {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        -ms-interpolation-mode: bicubic;
      }

      /* RESET STYLES */

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
      }

      table {
        border-collapse: collapse !important;
      }

      /* Remove margin on email wrapper in Android 4.4 KitKat */

      /* See more at: https://blog.jmwhite.co.uk/2015/09/19/revealing-why-emails-appear-off-centre-in-android-4-4-kitkat/ */

      div[style*="margin: 16px 0"] {
        margin: 0 !important;
        font-size: 100% !important;
      }

      /* Remove ios blue links */

      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
      }

      /* Outline styles */

      @media only screen and (max-width: 599px) {
        .content-table {
          width: 100% !important;
        }
        img[class="img-max"] {
          width: 100% !important;
          height: auto !important;
        }
        table[class="mobile-button-wrap"] {
          margin: 0 auto;
          width: 100% !important;
        }
        a[class="mobile-button"] {
          width: 80% !important;
          padding: 8px !important;
          border: 0 !important;
        }
        .mobile-align-center {
          text-align: center !important;
          margin-right: auto;
          margin-left: auto;
        }
      }
    </style>
  </head>
  <body style="margin: 0 !important; padding: 0 !important;">
    <!-- hidden preheader text - Remember to change it! -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Roboto', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;mso-hide:all;"> Kode Central - <?=$username?> </div>
    <!-- Include all your body email components here -->
    <!-- Hero image, title, text, cta centre -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td style="padding: 32px 0 32px 0;" bgcolor="#ffffff" align="center">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td align="center">
                <table class="content-table" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                  <tr>
                    <td style="padding: 0 16px 0 16px;" align="center" valign="top">
                      <!-- content -->
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td align="center" style="padding: 0 0 8px 0; color: #03A9F4; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 28px; font-weight: 400; line-height: 32px;"> Kode Central </td>
                        </tr>
                        <tr>
                          <td align="center" style="padding: 0 0 16px 0; color: #424242; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; line-height: 28px;"><?=$body?></td>
                        </tr>
                        <tr>
                          <?php if(isset($btn)){ ?>
                          <td>
                            <!-- Button -->
                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
                              <tr>
                                <td align="center">
                                  <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td align="center">
                                        <a style="background-color: #03A9F4; border-top: 10px solid #03A9F4; border-right: 22px solid #03A9F4; border-bottom: 8px solid #03A9F4; border-left: 22px solid #03A9F4; display: inline-block; color: #fff; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 24px; text-decoration: none; box-shadow: 1px 1px 1px rgba(0,0,0,0.5); text-transform: uppercase;"
                                          href="<?=$url?>" target="_blank"><?=$btn?></a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <!-- /Button -->
                          </td>
                        <?php } ?>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!-- /Hero image, title, text, cta centre -->
    <!-- Articles title -->
    <?php if(isset($posts)) { ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td style="padding: 32px 0 0 0;" bgcolor="#ffffff" align="center">
          <table class="content-table" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
              <td style="padding: 0 16px 0 16px;" align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <?php foreach($posts as $post) { ?>
                  <tr>
                    <td>
                      <table class="content-table" border="0" cellpadding="0" cellspacing="0" width="28%" align="left">
                        <tr>
                          <td align="center" valign="top">
                            <a href="<?=urlFront()."/post/".$post->getHyperlink()?>" target="_blank">
                              <img style="display: block; padding: 0 0 8px 0; font-family: 'Roboto', Helvetica, Arial, sans-serif; color: #333333; font-size: 14px; width: 150px; height: 84px;" class="img-max" src="<?=$post->getFirstImgSrc()?>" alt="Kode Central"
                                width="150" height="84" border="0"> </a>
                          </td>
                        </tr>
                      </table>

                      <table class="content-table" border="0" cellpadding="0" cellspacing="0" width="70%" align="right">
                        <tr>
                          <td valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                <td style="padding: 0 0 8px 0; color: #333333; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 20px; font-weight: normal; line-height: 30px;" align="left"><?=$post->getTitle()?> </td>
                              </tr>
                              <tr>
                                <td style="padding: 0 0 16px 0; color: #333333; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: normal; line-height: 24px;" align="left"><?=$post->getSummary(120)?></td>
                              </tr>
                              <tr>
                                <td style="padding: 0 0 32px 0;">
                                  <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tr>
                                      <td align="left">
                                        <table class="mobile-button-wrap" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td align="center">
                                              <a style="background-color: #03A9F4; border-top: 10px solid #03A9F4; border-right: 22px solid #03A9F4; border-bottom: 8px solid #03A9F4; border-left: 22px solid #03A9F4; display: inline-block; color: #fff; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 24px; text-decoration: none; box-shadow: 1px 1px 1px rgba(0,0,0,0.5); text-transform: uppercase;"
                                                href="<?=urlFront()."/post/".$post->getHyperlink()?>" target="_blank">View</a>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <?php } ?>

                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <?php } ?>
    <!-- /Articles title -->
    <!-- Don't forget to include a footer -->
    <!-- footer full centre -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td style="padding: 32px 0 0 0;" align="center">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td bgcolor="#546E7A" align="center">
                <table class="content-table" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                  <tr>
                    <td style="padding: 16px 16px 16px 16px;" align="center" valign="top">
                      <!-- content -->
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td style="color: #90A4AE; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 21px;" align="center"> Kode Central is a project by
                            <a style="color: #CFD8DC; text-decoration: none;" href="https://aszend.com">Aszend Digital, LLC</a>
                          </td>
                        </tr>
                        <tr>
                          <td style="color: #90A4AE; font-family: 'Roboto', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 21px;" align="center">
                            <?php if(isset($subscribed)) { ?>
                              <a style="color: #CFD8DC; text-decoration: none;" href="<?=$subscribed?>"> Unsubscribe</a>
                            <?php } ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!-- /footer full centre -->
  </body>
</html>
