<?php

/**
 * @author Vašek Purchart, https://github.com/consistence/coding-standard
 */
class Etten_Sniffs_NamingConventions_ValidVariableNameSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
{

	const CODE_CAMEL_CAPS = 'NotCamelCaps';

	/** @var string[] */
	private static $phpReservedVars = [
		'_SERVER',
		'_GET',
		'_POST',
		'_REQUEST',
		'_SESSION',
		'_ENV',
		'_COOKIE',
		'_FILES',
		'GLOBALS',
	];

	/**
	 * @param \PHP_CodeSniffer_File $file
	 * @param integer $stackPointer position of the double quoted string
	 */
	protected function processVariable(PHP_CodeSniffer_File $file, $stackPointer)
	{
		$tokens = $file->getTokens();
		$varName = ltrim($tokens[$stackPointer]['content'], '$');
		if (in_array($varName, self::$phpReservedVars, TRUE)) {
			return; // skip PHP reserved vars
		}
		$objOperator = $file->findPrevious([T_WHITESPACE], ($stackPointer - 1), NULL, TRUE);
		if ($tokens[$objOperator]['code'] === T_DOUBLE_COLON) {
			return; // skip MyClass::$variable, there might be no control over the declaration
		}
		if (PHP_CodeSniffer::isCamelCaps($varName, FALSE, TRUE, FALSE) === FALSE) {
			$error = 'Variable "%s" is not in valid camel caps format';
			$data = [$varName];
			$file->addError($error, $stackPointer, self::CODE_CAMEL_CAPS, $data);
		}
	}

	/**
	 * @codeCoverageIgnore
	 *
	 * @param \PHP_CodeSniffer_File $file
	 * @param integer $stackPointer position of the double quoted string
	 */
	protected function processMemberVar(PHP_CodeSniffer_File $file, $stackPointer)
	{
		// handled by PSR2.Classes.PropertyDeclaration
	}

	/**
	 * @codeCoverageIgnore
	 *
	 * @param \PHP_CodeSniffer_File $file
	 * @param integer $stackPointer position of the double quoted string
	 */
	protected function processVariableInString(PHP_CodeSniffer_File $file, $stackPointer)
	{
		// Consistence standard does not allow variables in strings, handled by Squiz.Strings.DoubleQuoteUsage
	}

}
