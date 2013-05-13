<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <!-- Facebook sharing information tags -->
            <meta property="og:title" content="${email.subject}" />
            <title><tpl:element type="text" data="email.subject"></title>
            <style type="text/css">
                #outlook a{padding:0}
                body{width:100%!important;-webkit-text-size-adjust:none;margin:0;padding:0}
                img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}
                table td{border-collapse:collapse}
                #backgroundTable{height:100%!important;width:100%!important;margin:0;padding:0}
                #templateContainer{border:1px solid #DDD}
                h1,.h1{color:#202020;display:block;font-family:Arial;font-size:34px;font-weight:700;line-height:100%;text-align:left;margin:0 0 10px}
                h2,.h2{color:#202020;display:block;font-family:Arial;font-size:30px;font-weight:700;line-height:100%;text-align:left;margin:0 0 10px}
                h3,.h3{color:#202020;display:block;font-family:Arial;font-size:26px;font-weight:700;line-height:100%;text-align:left;margin:0 0 10px}
                h4,.h4{color:#202020;display:block;font-family:Arial;font-size:22px;font-weight:700;line-height:100%;text-align:left;margin:0 0 10px}
                .preheaderContent div{color:#505050;font-family:Arial;font-size:10px;line-height:100%;text-align:left}
                #templateHeader{background-color:#FFF;border-bottom:0}
                .headerContent{color:#202020;font-family:Arial;font-size:34px;font-weight:700;line-height:100%;text-align:center;vertical-align:middle;padding:0}
                #headerImage{height:auto;max-width:600px!important}
                #templateContainer,.bodyContent{background-color:#FFF}
                .bodyContent div{color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left}
                .bodyContent img{display:inline;height:auto}
                #templateFooter{background-color:#FFF;border-top:0}
                .footerContent div{color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:left}
                .footerContent img{display:inline}
                #social{background-color:#FAFAFA;border:0}
                #utility{background-color:#FFF;border:0}
                #monkeyRewards img{max-width:190px}
                .ReadMsgBody,.ExternalClass{width:100%}
                body,#backgroundTable,#templatePreheader{background-color:#FAFAFA}
                .preheaderContent div a:link,.preheaderContent div a:visited,.preheaderContent div a .yshortcuts,.headerContent a:link,.headerContent a:visited,.headerContent a .yshortcuts,.bodyContent div a:link,.bodyContent div a:visited,.bodyContent div a .yshortcuts ,.footerContent div a:link,.footerContent div a:visited, .footerContent div a .yshortcuts {color:#369;font-weight:400;text-decoration:underline}
                #social div,#utility div{text-align:center}
            </style>
        </head>
        <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
            <center>
                <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
                                <tpl:condition test="isset" data="email.headimgurl" value="1">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
                                                <tr>
                                                    <td class="headerContent">
                                                        <img src="${email.headimgurl}" style="max-width:600px;" id="headerImage campaign-icon"  />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tpl:condition>
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                            <tr>
                                                <td valign="top" class="bodyContent">
                                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td valign="top">
                                                                <tpl:block data="email.body" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <br />
                        </td>
                    </tr>
                </table>
            </center>
        </body>
    </html>
</tpl:layout>