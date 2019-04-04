<{include file="db:soapbox_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Sbarticles</strong> </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                    <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_ARTICLEID}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_COLUMNID}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_HEADLINE}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_LEAD}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_BODYTEXT}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_TEASER}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_UID}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_SUBMIT}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_DATESUB}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_COUNTER}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_WEIGHT}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_HTML}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_SMILEY}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_XCODES}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_BREAKS}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_BLOCK}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_ARTIMAGE}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_VOTES}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_RATING}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_COMMENTABLE}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_OFFLINE}></th>  <th><{$smarty.const.MD_SOAPBOX_SBARTICLES_NOTIFYPUB}></th><th  width="10%"><{$smarty.const.MD_SOAPBOX_ACTION}></th>
            </tr>
            </thead>
        <{foreach item=sbarticles from=$sbarticles}>
            <tbody>
            <tr>

                             <td><{$sbarticles.articleID}></td>
                    <td><{$sbarticles.columnID}></td>
                    <td><{$sbarticles.headline}></td>
                    <td><{$sbarticles.lead}></td>
                    <td><{$sbarticles.bodytext}></td>
                    <td><{$sbarticles.teaser}></td>
                    <td><{$sbarticles.uid}></td>
                    <td><{$sbarticles.submit}></td>
                    <td><{$sbarticles.datesub}></td>
                    <td><{$sbarticles.counter}></td>
                    <td><{$sbarticles.weight}></td>
                    <td><{$sbarticles.html}></td>
                    <td><{$sbarticles.smiley}></td>
                    <td><{$sbarticles.xcodes}></td>
                    <td><{$sbarticles.breaks}></td>
                    <td><{$sbarticles.block}></td>
                    <td><img src="<{$xoops_url}>/uploads/soapbox/thumbs/<{$sbarticles.artimage}>" style="max-width:100px" alt="sbarticles"></td>
                   <td><{$sbarticles.votes}></td>
                    <td><{$sbarticles.rating}></td>
                    <td><{$sbarticles.commentable}></td>
                    <td><{$sbarticles.offline}></td>
                    <td><{$sbarticles.notifypub}></td>
                                <td>
                       <a href="sbarticles.php?op=view&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;
                       <{if $xoops_isadmin == true}>
                       <a href="admin/sbarticles.php?op=edit&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" /></a>
                       &nbsp;<a href="admin/sbarticles.php?op=delete&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                       <{/if}>
                   </td>
                </tr>
               </tbody>
        <{/foreach}>
    </table>
</div>
<{$pagenav}>
    <{$commentsnav}> <{$lang_notice}>
    <{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:soapbox_footer.tpl"}>
