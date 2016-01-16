<?php
include 'src/parser.php';
$parser = new Parser;
$xml = $parser->parse("examples/1.0/spec.xml");
include 'src/renderer.php';

?>
