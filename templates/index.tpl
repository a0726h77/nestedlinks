{include file="findInclude:common/templates/header.tpl"}

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
function initMenu()
{
    jQuery('#menu ul').hide();
    jQuery('#menu li a').click(
        function()
        {
            var checkElement = jQuery(this).next();
            if((checkElement.is('ul')))
            {
                checkElement.toggle('fast');
                return false;
            }
        }
    );
}

jQuery(document).ready(function(){
    //jQuery(".block_content li:even").addClass("alt");
    initMenu();
});
</script>

{if isset($description) && strlen($description)}
{block name="linksHeader"}
  <p class="{block name='headingClass'}nonfocal smallprint{/block}">
    {$description}
  </p>
{/block}
{/if}

<ul id="menu" class="nav">
{foreach from=$linkGroups key=k item=links}
<li>
	<a href="#"><b>{$k}</b></a>
	<ul>
	{foreach from=$links item=v}
		<li><a href="{$v['BASE_URL']}">{$v['TITLE']}</a></li>
	{/foreach}
	</ul>
</li>
{/foreach}
</ul>

<p class="clear"> </p>

{if isset($description_footer) && strlen($description_footer)}
{block name="linksFooter"}
  <p class="{block name='headingClass'}nonfocal smallprint{/block}">
    {$description_footer}
  </p>
{/block}
{/if}

{include file="findInclude:common/templates/footer.tpl"}
