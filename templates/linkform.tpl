            (All fields required apart from reciprocal. Non reciprocated links accepted at our discretion.)<br /><br />

            <form method="post" name="submitlink" action="{$SITEURL}/lx/">
            <div class="lx-form">
            <label for="name">Name:</label>
            <input type="text" size="30" name="name" id="name" value="{$name}" /><br />

            <label for="email">Email:</label>
            <input type="text" size="30" name="email" id="email" value="{$email}" /><br />

            <label for="url">Website URL:</label>
            <input type="text" size="30" name="url" id="url" value="{$url}" /><br />

            <label for="title">Link Text:</label>
            <input type="text" size="30" name="linktitle" id="linktitle" value="{$linktitle}" /><br />

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
