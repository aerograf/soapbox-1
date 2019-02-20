<{include file="db:soapbox_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Sbarticles </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                  </tr>
            </thead><tbody>
            <tr>

                        <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_ARTICLEID}></td>       <td><{$sbarticles.articleID}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_COLUMNID}></td>       <td><{$sbarticles.columnID}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_HEADLINE}></td>       <td><{$sbarticles.headline}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_LEAD}></td>       <td><{$sbarticles.lead}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_BODYTEXT}></td>       <td><{$sbarticles.bodytext}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_TEASER}></td>       <td><{$sbarticles.teaser}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_UID}></td>       <td><{$sbarticles.uid}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_SUBMIT}></td>       <td><{$sbarticles.submit}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_DATESUB}></td>       <td><{$sbarticles.datesub}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_COUNTER}></td>       <td><{$sbarticles.counter}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_WEIGHT}></td>       <td><{$sbarticles.weight}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_HTML}></td>       <td><{$sbarticles.html}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_SMILEY}></td>       <td><{$sbarticles.smiley}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_XCODES}></td>       <td><{$sbarticles.xcodes}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_BREAKS}></td>       <td><{$sbarticles.breaks}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_BLOCK}></td>       <td><{$sbarticles.block}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_ARTIMAGE}></td>       <td><img src="<{$xoops_url}>/uploads/soapbox/images/<{$sbarticles.artimage}>" alt="sbarticles"></td>
            </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_VOTES}></td>       <td><{$sbarticles.votes}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_RATING}></td>       <td><{$sbarticles.rating}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_COMMENTABLE}></td>       <td><{$sbarticles.commentable}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_OFFLINE}></td>       <td><{$sbarticles.offline}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBARTICLES_NOTIFYPUB}></td>       <td><{$sbarticles.notifypub}></td>
             </tr>
        <tr><td><{$smarty.const.MD_SOAPBOX_ACTION}></td>                   <td>
                       <!--<a href="sbarticles.php?op=view&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                       <{if $xoops_isadmin == true}>
                       <a href="admin/sbarticles.php?op=edit&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" /></a>
                       &nbsp;<a href="admin/sbarticles.php?op=delete&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                       <{/if}>
                   </td>
                </tr>
               </tbody>

    </table>
</div>
    <div id="pagenav"><{$pagenav}></div>
    <{$commentsnav}> <{$lang_notice}>
    <{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:soapbox_footer.tpl"}>
