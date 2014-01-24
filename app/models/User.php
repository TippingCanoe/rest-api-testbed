<?php

class User extends Eloquent {

	protected $guarded = array();

	protected $table = 'users';
	public $timestamps = true;
	protected $softDelete = false;

}