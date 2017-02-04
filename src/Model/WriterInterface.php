<?php

namespace Model;


interface WriterInterface
{
	public function write(\Http\Request $request);
	
}
