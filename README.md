# Search user by email

## Installation

Copy the extension to phpBB/ext/ssyt/usersearch

Go to "ACP" > "Customise" > "Extensions" and enable the "Search user by email" extension.

Go to "../public_html/adm/style" > "acp_users.html" and before
```
<form id="select_user" method="post" action="{U_ACTION}">
```
add that line
```
	<!-- IF SSYT_USERSEARCH_ENABLE -->
	{{ USER_SEARCH_TMP }}

	<form id="select_user_email" method="post" action="{{ U_ACTION }}">
		<fieldset>
			<legend>{L_SELECT_USER}</legend>

			<dl>
				<dt><label for="user">{L_ENTER_USER}{L_COLON}</label></dt>
				<dd><input class="text medium" type="email" id="userMail" name="userMail" /></dd>
			</dl>

			<p class="quick">
				<input type="submit" name="submituser_search" value="{L_SUBMIT}" class="button1" />
			</p>
		</fieldset>
	</form>
	<!-- ENDIF -->
```

## Tests and Continuous Integration

We use Travis-CI as a continuous integration server and phpunit for our unit testing. See more information on the [phpBB Developer Docs](https://area51.phpbb.com/docs/dev/32x/testing/index.html).
To run the tests locally, you need to install phpBB from its Git repository. Afterwards run the following command from the phpBB Git repository's root:

Windows:

    phpBB\vendor\bin\phpunit.bat -c phpBB\ext\ssyt\usersearch\phpunit.xml.dist

others:

    phpBB/vendor/bin/phpunit -c phpBB/ext/ssyt/usersearch/phpunit.xml.dist

## License

[GPLv2](license.txt)
