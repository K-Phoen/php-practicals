<?php

namespace Model;


class JsonWriter implements WriterInterface
{
	private static $index=0;
	
	public function postOneComment(\Http\Request $request){
		$StringContent= file_get_contents(__DIR__ ."/../../data/statuses.json");
		$jsonContent= json_decode($StringContent,true);
		$data=array(
		'user'   => $request->getParameter('username'),
		'message'=> $request->getParameter('message'),
		'date'   => date("d.m.y")
		);
		echo("data");
		array_push($jsonContent,$data);
		file_put_contents(__DIR__ ."/../../data/statuses.json",json_encode($jsonContent));
		JsonWriter::$index++;
	}
	
}
