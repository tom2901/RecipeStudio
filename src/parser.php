<?php
include 'src/data.php';
class Parser
{

public function parse($filename)
{

	$data = new ParserData;

	$xml = simplexml_load_file($filename);
	$json = json_encode($xml);
	$xml = json_decode($json,TRUE);

	//VARIABLES


	//General Information
	$data->version = $xml['@attributes']['version'];
	$data->title = $xml['Information']['Title'];
	$data->category = $xml['Information']['Category'];
	$data->author = $xml['Information']['Meta']['@attributes']['author'];
	$data->date = $xml['Information']['Meta']['@attributes']['date'];
	$data->lang = $xml['Information']['Meta']['@attributes']['lang'];
	$data->recipeID = $xml['Information']['Meta']['@attributes']['recipeID'];
	$data->workTime = $xml['Information']['Time']['@attributes']['Work'];
	$data->totalTime = $xml['Information']['Time']['@attributes']['Total'];

	//Ingredients
	$ing = array();
	for($c = 0;$c < count($xml['Information']['Ingredients']['Item']);$c++)
		array_push($ing, $xml['Information']['Ingredients']['Item'][$c]);
	$data->ingredients = array();
	for($c = 0;$c < count($ing);$c++)
		//name, amount, ntype
		array_push($data->ingredients, $ing[$c]['@attributes']['name'].",".$ing[$c]['@attributes']['amount'].",".$ing[$c]['@attributes']['ntype']);

	//Steps
	$data->stepCount = count($xml['Steps']['Step']);
	$data->steps = $xml['Steps']['Step'];

	//Return ParserData Object
	return $data;
}
}
?>
