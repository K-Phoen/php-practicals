<?php

namespace Model;

class JsonWriter implements WriterInterface
{
	
	public function write(\Http\Request $request){
		$StringContent= file_get_contents(__DIR__ ."/../../data/statuses.json");
		$jsonContent= json_decode($StringContent,true);

		$data=array(
		'id'     => $id = time(),
		'user'   => $request->getParameter('username'),
		'title'   => $request->getParameter('title'),
		'message'=> $request->getParameter('message'),
		'date'   => date("d.m.y")
		);
		$jsonContent[$id] = $data;
		
		$created=file_put_contents(__DIR__ ."/../../data/statuses.json",json_encode($jsonContent));
		return $created;
		
	}
	
	public function delete ($id){
		$StringContent= file_get_contents(__DIR__ ."/../../data/statuses.json");
		$jsonContent= json_decode($StringContent,true);
		unset($jsonContent[$id]);
		file_put_contents(__DIR__ ."/../../data/statuses.json",json_encode($jsonContent));
		return $this->isDeleted($id);
	}
	
	private function isDeleted($id){
		$jsonFinder= new JsonFinder();
		$status = $jsonFinder->findOneById($id);
		if($status==null){
			return true;
		}
		return false;
	}
	
}
