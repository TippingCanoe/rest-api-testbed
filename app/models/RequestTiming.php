<?php

class RequestTiming extends Eloquent {

	protected $guarded = array();

	protected $table = 'requests';
	public $timestamps = true;
	protected $softDelete = false;

}