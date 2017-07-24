<?php

/**
 * Test: Latte\Compiler and htmlNode.
 */

use Latte\Compiler;
use Latte\IMacro;
use Latte\MacroNode;
use Latte\Parser;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class MockMacro implements IMacro
{
	public function initialize()
	{
	}


	public function finalize()
	{
	}


	public function nodeOpened(MacroNode $node)
	{
		Assert::same(2, $node->htmlNode->startLine);
	}


	public function nodeClosed(MacroNode $node)
	{
		Assert::same(6, $node->htmlNode->endLine);
	}
}


$parser = new Parser;
$compiler = new Compiler;
$compiler->addMacro('foo', new MockMacro);
$compiler->compile($parser->parse('
	<div
	n:foo
	>

	</div
	>'), 'Template');