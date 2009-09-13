            {if $linktarget}
            <b>Please Note:</b>
            <ul>
            <li>Our site {$SITEURL} will link to you.</li>
            <li>Please either:
                <ul>
                <li>Link to our associate website {$linktarget} or</li>
                <li>Set up your reciprocal link to {$SITEURL} from another of your websites, or</li>
                <li>Set up a standard reciprocal link.</li>
                </ul>
            </li>
            </ul>
            <br /><br />
            {/if}
            <textarea rows="5" cols="60"><a href="{if $linktarget}{$linktarget}{else}{$SITEURL}{/if}" target="_BLANK" title="{if $linktext}{$linktext}{else}{$sitetitle}{/if}"><b>{if $linktext}{$linktext}{else}{$sitetitle}{/if}</b></a> {if $linkbody}{$linkbody}{else}{$sitetitle}{/if}</textarea>
            <br /><br />

            <div>
            <b>Link to:</b> {if $linktarget}{$linktarget}{else}{$SITEURL}{/if}<br />
            <b>Link Title:</b> {if $linktext}{$linktext}{else}{$sitetitle}{/if}<br />
            <b>Link Description:</b> {if $linkbody}{$linkbody}{else}{$sitetitle}{/if}<br />
            </div>
