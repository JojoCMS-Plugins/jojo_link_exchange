{include file="admin-header.tpl"}


<!-- [Tree] -->
  <div id="tree">


  </div><!-- [end tree] -->



  <!-- [Fields] -->
  <div id="fields-wrap">

<table class="stdtable" width="100%">

	<tr class="rowheader">
		<td class="rowheader">Website</td>
		<td class="rowheader">Status</td>
		<td class="rowheader">Reciprocal</td>
		<td class="rowheader">PR</td>
		<td class="rowheader">Links</td>
		<td class="rowheader">Last Checked</td>
		<td class="rowheader">Hits</td>
		<td class="rowheader">&nbsp;<!-- email --></td>
		<td class="rowheader">&nbsp;<!-- action --></td>

	</tr>
{section name=lx loop=$linkexchanges}
	<!----------[{$linkexchanges[lx].lx_name}]---------->
	<tr class="{cycle values="row1,row2"}">
		<td>
			<a href="{$linkexchanges[lx].lx_url}" target="new" title="{$linkexchanges[lx].lx_url|replace:"http://":""}">{$linkexchanges[lx].lx_name}</a>
		</td>

		<td>
			{$linkexchanges[lx].lx_status}
		</td>

		<td>
		{if $linkexchanges[lx].lx_reciprocalurl}
			<a href="{$linkexchanges[lx].lx_reciprocalurl}" target="new" title="{$linkexchanges[lx].lx_reciprocalurl|replace:"http://":""}">Reciprocal</a>
		{/if}
		</td>

		<td>
			{$linkexchanges[lx].lx_pagerank}
		</td>

		<td>
			{$linkexchanges[lx].lx_linksonpage}
		</td>

		<td>
			{$linkexchanges[lx].date}
		</td>

		<td>
			{$linkexchanges[lx].lx_hits}
		</td>

		<td>
		{if $linkexchanges[lx].lx_webmasteremail}
			<a href="mailto:{$linkexchanges[lx].lx_webmasteremail}"><img src="images/envelope.gif" border="0"></a>
		{/if}
		</td>

		<td>
			<a href="{$BASE_PHP_SELF}?action=update&id={$linkexchanges[lx].linkexchangeid}"><img src="images/uparrow{if $THEME}_{$THEME}{/if}.gif" border="0"></a>
		</td>

	</tr>
{/section}
</table>

<div align="center"><a href="lx-manager/update/all/">Update</a></div>

  </div><!-- [end fields-wrap] -->

{include file="admin-footer.tpl"}