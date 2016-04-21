# Etten\Codestyle

## Coding Standards for PHP CodeSniffer

* Based on [Consistence](https://github.com/consistence/coding-standard/tree/master/Consistence), so read it carefully.
* But it differs in some cases:
	* Arrays: Arrays without key are allowed also when the first key is specified (Nette\Database $criteria).
	* Comments: Inline comments are allowed (code conditions, code folding).
	* Comments: Type parameters are not checked (allow shortcuts like int, bool).
	* Constants: Uppercase constants including TRUE, FALSE, NULL (Nette Code Style).
	* Formatting: There is not space after type cast.
	* Formatting: Heredoc syntax is allowed (eg. in tests).
	* Functions: Opening brace of function with multiline arguments must be on the same line as closing parenthesis.
	* Strings: Double quotes are permitted when contains a variable.
	* Whitespace: There is no space after type cast.
	* and some other differences.

## Example Usage

Install into your project the best via [Composer](https://getcomposer.org):

	$ composer require etten/codestyle

Run [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) like this:

	$ vendor/bin/phpcs --standard=/path/to/Etten/ruleset.xml -sp src tests

## Versioning

This packages uses [semver.org](semver.org).
