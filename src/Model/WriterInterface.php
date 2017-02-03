<?php

namespace Model;


interface WriterInterface
{
	public function postOneComment(\Http\Request $request);
	
}
