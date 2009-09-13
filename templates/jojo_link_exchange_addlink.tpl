<div class="lx">
    <div>
        <div>
            <h2>Request a Link Exchange</h2>
            {if $content}{$content}<br /><br />{/if}
        </div>

        <!-- [About Link Exchange] -->
        <div>
            <h2>Tutorial</h2>

            <i>It is one thing to create relevant content, it is another thing to become <b>important</b> relevant content in the eyes of the search engines. To help you understand about how links work, we put together this short tutorial:</i><br />
            <br />
            Most search engines consider the amount of incoming links to your website an important factor in determining your overall ranking. If many sites link to you, then the Search engines consider your site to be more important than other competing sites that don't have any incoming links.<br />
            <br />
            Ideally, our content is so interesting and compelling that other webmasters will naturally want to link to it. Natural links are the best kind of links to have. They require no extra effort, are on other sites relevant to our topic and are given freely without requiring a reciprocal link (ie a link in return). It can take a long time to build natural links as good content takes time to prepare, and other webmasters will take time to find our sites and link to them.<br />
            <br />
            A popular way to build incoming links is Link Exchange. Many websites have a "links" page where they place links to other related websites. Reciprocal link building is approaching these webmasters and asking them to place a link to our site in return for us placing a link to them. It's a topic of debate amongst SEO experts as to whether Reciprocal links are as effective as one way incoming links. While many agree that non-reciprocal links are best, it is also clear that reciprocal links (if done correctly) will help with your Page Rank and Search Engine Position.<br />
            <br />
            When choosing sites to exchange links with, there are a few things to keep in mind: <br />
            <ul>
                <li>Incoming links are most valuable on pages that are related to your content.</li>
                <li>Do not link to any site that has been banned by Google (or other Search Engines), or looks like it's spam (which may be banned in the future). If you link to a banned site, this can negatively effect your ranking.</li>
                <li>Links from pages with a high PageRank are more valuable to you than pages with little or no PageRank. You can use the Google Toolbar to check the pagerank of any page on the web. While PageRank is important, it's only a small part of the equation. Keep in mind that PageRank is only updated every 3 months (approx) so the Google Toolbar is not always an accurate reflection of this (especially on new websites).</li>
                <li>The value you get from a link exchange is proportional to the number of links on the page. A link on a page with 100 other links is worth much less than a page with only 5 other links. Ideally, you should aim to get your links on pages with less than 20 other links on them.</li>
                <li>The text in your link and the surrounding text is important. Good link exchanges let you place a short text description next to your link.</li>
                <li>Some webmasters will place a link to you, then remove it a few weeks later. You should check your link every so often to ensure it is still active.</li>
            </ul>
            <br />
            We are interested in exchanging links with other websites that have content similar to ours. Please use the form on the "Add Your Link" tab to begin this process.<br />
        </div>

        <!-- [Add Your Link] -->
        <div>
            <h2>Add Your Link</h2>

            {if $error}<div class="error">{$error}</div>{/if}

            We may be interested in a link exchange with other well-maintained websites similar to ours. We prefer to exchange links with sites that are similar to ours, but will consider high quality websites on other topics that meet our Guidelines...<br />

            We feel our sites are of a high standard, and as such are only interested in sites of a similar quality.<br />

    		We are <strong>only</strong> interested in links on pages that...<br />
            <ul>
                <li>Are designed for humans, not just search engines</li>
                <li>Are somewhat relevant to our site</li>
                <li>Are well spidered and indexed by search engines</li>
                <li>Will place our link within unique content</li>
                <li>Will place our link on pages with few other outgoing links, preferably less than 20</li>
                <li>Are not linking to low quality websites</li>
            </ul>
            Just to be clear, and because we get hundreds of link exchange emails that don't meet the above criteria, we are specifically <strong>not</strong> looking for...
            <ul>
                <li>Link directories with hundreds of links per page</li>
                <li>Link directories where the design does not match the rest of the site</li>
                <li>Links on pages not spidered or indexed by the major search engines</li>
                <li>Links on sites covered with ads, or "Made for Adsense" sites</li>
                <li>Links on sites with no apparent uniqueness or value to offer</li>
                <li>Links on sites not related to ours</li>
            </ul>

            <br />
            <b>Important note:</b>
            <br />
            We do automatic checks on your site every so often to ensure that our link is still active and working. We also review each site manually, so it may take a couple of days for your link to appear on the site.<br />
            <br />
            <h4>Step 1: Please read the above guidelines</h4>
            If you are unsure as to whether your links page could be considered "quality", you might want to check out the <a href="http://www.ragepank.com/spam-o-meter/" rel="nofollow">spam-o-meter</a>.<br /><br />

            <h4>Step 2: Add our link to your website</h4>

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

            <br /><strong>PLEASE edit</strong> the link description text so that it is NOT the same as the above -  as long as the basic message stays intact. Google does not like duplicate content.<br /><br />

            <h4>Step 3: Enter your details so we can add your link</h4>
            (All fields required apart from reciprocal. Non reciprocated links accepted at our discretion.)<br /><br />

            <form method="post" name="submitlink" action="{$REQUEST_URI}">
            <div class="lx-form">
            <label for="name">Name:</label>
            <input type="text" size="30" name="name" id="name" value="{$name}" /><br />

            <label for="email">Email:</label>
            <input type="text" size="30" name="email" id="email" value="{$email}" /><br />

            <label for="url">Website URL:</label>
            <input type="text" size="30" name="url" id="url" value="{$url}" /><br />

            <label for="title">Title:</label>
            <input type="text" size="30" name="title" id="title" value="{$title}" /><br />

            <label for="description">Description*:</label>
            <div class="form-field">
            <textarea name="description" rows="5" cols="30">{$description}</textarea><br /><i>Max 250 characters</i>
            </div><br />

            <label for="reciprocalurl">Your URL with our link (reciprocal):</label>
            <input type="text" size="30" name="reciprocalurl" id="reciprocalurl" value="{$reciprocalurl}" /><br />

            <label for="captchacode">Spam prevention:</label>
            <div class="form-field">
            <input type="text" size="8" name="captchacode" id="captchacode" value="" /><br />
            Please enter the 3 letter code below. This helps us prevent spam.<br />
            <img src="external/php-captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" /><br />
            <em>Code is not case-sensitive</em>
            </div><br />

            <label>Submit Form:</label><input type="submit" name="submit" value="Add Link &gt;&gt;" class="button" onmouseover="this.className='button buttonrollover';" onmouseout="this.className='button'" />
            </div>
            </form>
        </div>
    </div>
</div>