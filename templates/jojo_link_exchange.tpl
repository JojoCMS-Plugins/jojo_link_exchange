<div class="lx">
<!-- {$linkexchangehome} -->
{if $linkexchange}

    {if $linkexchange.lx_body}
        {if $linkexchange.lx_image}<img src="images/250/linkexchanges/{$linkexchange.lx_image}" class="boxed" align="right" alt="{$linkexchange.lx_linktext}" />
        {/if}
        {$linkexchange.lx_body}
    {else}
        <a href="{$linkexchange.lx_url}" target="new" title="{$linkexchange.lx_url|replace:"http://":""}">{if $linkexchange.lx_linktext}{$linkexchange.lx_linktext}{else}{$linkexchange.lx_name}{/if}</a>
        {if $linkexchange.lx_desc} - {$linkexchange.lx_desc}{/if}<br />
    {/if}


    {if $similarlinkexchanges}

        <br /><br /><br />
        <hr />
        <br /><br /><br />

        <h3>Other {$category.lc_name} Websites</h3>
    {section name=lx loop=$similarlinkexchanges}
        <!-- [{$similarlinkexchanges[lx].lx_name}] -->
        <a href="{$similarlinkexchanges[lx].internalurl}" title="{$similarlinkexchanges[lx].lx_url|replace:"http://":""}">{if $similarlinkexchanges[lx].lx_linktext}{$similarlinkexchanges[lx].lx_linktext}{else}{$similarlinkexchanges[lx].lx_name}{/if}</a>{if $similarlinkexchanges[lx].lx_desc} - {$similarlinkexchanges[lx].lx_desc}{/if}<br />
    {/section}
    {/if}

{else}

<div>

    <div>
        <h2>Sites of Interest</h2>
    {if $linkexchangecategorys}
        <b>Categories</b><br />
        <ul>
        {section name=lc loop=$linkexchangecategorys}
            <li><a href="{$linkexchangecategorys[lc].url}"{if $linkexchangecategorys[lc].lc_desc} title="{$linkexchangecategorys[lc].lc_desc}"{/if}>{$linkexchangecategorys[lc].lc_name}</a></li>
        {/section}
        </ul>
        {/if}

    {if $category.lc_body}
        <hr />
        {$category.lc_body}
    {/if}

    {if $linkexchanges}
        <hr />
    <ul class="le">
    {section name=lx loop=$linkexchanges}
        <!-- [{$linkexchanges[lx].lx_name}] -->
        <li><a href="{$linkexchanges[lx].$linkdirect}">{if $linkexchanges[lx].lx_linktext}{$linkexchanges[lx].lx_linktext}{else}{$linkexchanges[lx].lx_name}{/if}</a>{if $linkexchanges[lx].lx_desc} - {$linkexchanges[lx].lx_desc}{/if}</li>
    {/section}
    </ul>
    {/if}
    {if $content && $linkexchangehome}{$content}<br /><br />{/if}
    </div>
{if $linkexchangehome}
    <br /><br />

    The content management system used for this site is also used for several other sites including some of the below. If your websites relate to any of the following please contact

    <a href="contact/" onmouseover="this.href={php}echo Jojo::obfuscateEmail(_WEBMASTERADDRESS);{/php}"><span id="e-3987"></span>
    <script type="text/javascript" language="javascript">
    document.getElementById('e-3987').innerHTML = {php}echo Jojo::obfuscateEmail(_WEBMASTERADDRESS,false);{/php};
    </script>
    </a>
    <noscript><a href="contact/" title="contact/">Email</a></noscript>

{**<a href="contact/" onmouseover="{php}echo Jojo::obfuscateEmail(_WEBMASTERADDRESS);{/php}"><script type="text/javascript">document.write({php}echo Jojo::obfuscateEmail(_WEBMASTERADDRESS,false);{/php});</script></a><noscript><a href="contact/" title="contact/">Email</a></noscript>**}
         for a Listing.<br /><br />

    {section name=s loop=$sites}
    <b>{if $sites[s].displayurl}{$sites[s].displayurl|replace:"http://":""}{else}{$sites[s].url|replace:"http://":""}{/if}</b> - <a href="{$sites[s].url}" target="new">{$sites[s].description}</a>, PR{$sites[s].pagerank}<br />
    {/section}
{else}

    <br />
    <a href="{$SITEURL}/lx/"><b>Click to Request a Listing for your Website.</b></a>


{/if}


</div>

{/if}
</div>