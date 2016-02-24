<?php

/**
 * Checks the declaration of the class is correct.
 *
 * @author Jan Dolecek <juzna.cz@gmail.com> (THX for the original inspiration)
 * @author Jaroslav Hranička <hranicka@outlook.com>
 */
class Etten_Sniffs_Classes_ClassDeclarationSniff extends PEAR_Sniffs_Classes_ClassDeclarationSniff
{

	/** @var int */
	public $numBlankLinesBeforeClosingBrace = 1;

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		parent::process($phpcsFile, $stackPtr);
		$this->processClose($phpcsFile, $stackPtr);
	}

	public function processClose(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		// Check that the closing brace comes right after the code body.
		$closeBrace = $tokens[$stackPtr]['scope_closer'];
		$prevContent = $phpcsFile->findPrevious(T_WHITESPACE, ($closeBrace - 1), NULL, TRUE);
		if ($tokens[$prevContent]['line'] !== ($tokens[$closeBrace]['line'] - $this->numBlankLinesBeforeClosingBrace - 1)) {
			$error = 'The closing brace for the %s must go on the next line after the body';
			$data = array($tokens[$stackPtr]['content']);
			$phpcsFile->addError($error, $closeBrace, 'CloseBraceAfterBody', $data);
		}
	}

}
