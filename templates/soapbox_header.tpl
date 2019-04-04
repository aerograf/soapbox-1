<div class="header">
<span class="left"><b><{$smarty.const.MD_SOAPBOX_TITLE}></b>&#58;&#160;</span>
<span class="left"><{$smarty.const.MD_SOAPBOX_DESC}></span><br>
</div>
<div class="head">
    <{if $adv != ''}>
        <div class="center"><{$adv}></div>
    <{/if}>
</div>
<br>
<ul class = "nav nav-pills">
                 <li class = "active"><a href="<{$soapbox_url}>"><{$smarty.const.MD_SOAPBOX_INDEX}></a></li>

            <li><a href="<{$soapbox_url}>/sbcolumns.php"><{$smarty.const.MD_SOAPBOX_SBCOLUMNS}></a></li>
            <li><a href="<{$soapbox_url}>/sbarticles.php"><{$smarty.const.MD_SOAPBOX_SBARTICLES}></a></li>
            <li><a href="<{$soapbox_url}>/sbvotedata.php"><{$smarty.const.MD_SOAPBOX_SBVOTEDATA}></a></li>
 </ul>

 <br>