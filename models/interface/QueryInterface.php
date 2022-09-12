<?php

interface QueryInterface
{
	// function getAll($fields);
	// function findById($id);
	// function deleteById($id);
	function insert($data);
	function update( $data,$conditions);
}