<{$xoops_module_header}>

<div id="moduleName"><img src="<{$xoops_url}>/<{$imgdir}>/icon/open.png" width="36"
                          height="24">&nbsp;<{$lang_modulename}>&nbsp;<img
            src="<{$xoops_url}>/<{$imgdir}>/icon/close.png" width="36"
            height="24"></div>
<div id="pagePath"><a href="<{$xoops_url}>"><{$smarty.const._MD_SOAPBOX_HOME}></a> &bull; <a
            href="<{$xoops_url}>/modules/<{$lang_moduledirname}>/"><{$lang_modulename}></a> &bull; <{$category.name}>
</div>

<table class="clean" cellspacing="0" cellpadding="0">
    <tr>
        <td>

            <{if $category.image != 'blank.png'}>
                <span class="picleft"><img class="pic" src="<{$xoops_url}>/<{$uploaddir}>/<{$category.image}>"></span>
            <{/if}>

            <h3 class="reddish"><{$category.name}></h3>
            <div class="byline"><{$smarty.const._MD_SOAPBOX_BY}><{$category.author}></div>
            <div class="intro"><{$category.description}></div>
            <div class="nine"><{$smarty.const._MD_SOAPBOX_MAININDEXTOTAL}>: <{$category.total}></div>
    </tr>
    </td></table>
<!-- Start topic loop -->
<{foreach item=articles from=$articles}>
    <div class="art">
        <div>
            <table>
                <tbody>
                <tr>
                    <td>
                        <h3 class="reddish"><a href="article.php?articleID=<{$articles.id}>"><{$articles.headline}></a>
                        </h3>
                    </td>
                    <td style="text-align: right;"><{$articles.adminlinks}><{$articles.userlinks}></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="intro8"><{$articles.teaser}></div>

        <table class="clean" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top">
                    <div class="coldesc8"><{$smarty.const._MD_SOAPBOX_POSTED}>: <{$articles.datesub}>
                        | <{$smarty.const._MD_SOAPBOX_TIMESREAD}>
                        : <{$articles.counter}> <{if $showrating == 1}> | <{$articles.rating}> [<{$articles.votes}>]<{/if}></div>
                </td>
                <td>
                    <div class="coldesc8" align="right"><a
                                href="article.php?articleID=<{$articles.id}>"><b><{$smarty.const._MD_SOAPBOX_MORE}></b></a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<{/foreach}>

<div align='left'><{$category.navbar}></div>
<p>
<div align='center'> [ <a href='javascript:history.go(-1)'><{$smarty.const._MD_SOAPBOX_RETURN}></a><b> | </b><a
            href='./index.php'><{$smarty.const._MD_SOAPBOX_RETURN2INDEX}></a> ]
</div>
<{include file='db:system_notification_select.tpl'}>
