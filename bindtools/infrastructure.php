<?php

class BindType {
	public $name;
	public $type;
	public $checker;
	public $getter;
	public $alloc;
	public $destructor;

	public function __construct($name, $type, $checker, $getter, $alloc, $destructor = 'free') {
		$this->name = $name;
		$this->type = $type;
		$this->checker = $checker;
		$this->getter = $getter;
		$this->alloc = $alloc;
		$this->destructor = $destructor;
	}

	public function alloc($name) {
		$alloc = $this->alloc;
		return $alloc($name);
	}
}

class BindArgument {
	public $type;
	public $name;
	public $check;
	public $get;

	public function __construct(BindType $type, $name) {
		$this->type = $type;
		$this->name = $name;
		$checker = $type->checker;
		$getter = $type->getter;
		$this->check = $checker($name);
		$this->get = $getter($name);
	}
}

class BindFunction {
	public $retval;
	public $name;
	/** @var Argument[] $args */
	public $args;

	public function __construct(BindType $retval, $name, array $args) {
		$this->retval = $retval;
		$this->name = $name;
		$this->args = $args;
	}
}

function type($name, $destructor = 'free') {
	return new BindType(
		$name,
		"{$name}*",
		function($v) use ($name) { return "kind_{$name}_check($v)"; },
		function($v) use ($name) { return "kind_{$name}_get($v)"; },
		function($v) use ($name) { return "kind_{$name}_alloc($v)"; },
		$destructor
	);
}
function prim_type($name, $type, $checker, $getter, $setter) { return new BindType($name, $type, $checker, $getter, $setter, ''); };
function enum_type($name) {
	return prim_type(
		$name,
		$name,
		function($v) use ($name) { return "val_check($v, int)"; },
		function($v) use ($name) { return "(($name)val_get_int($v))"; },
		function($v) use ($name) { return "alloc_int($v)"; }
	);
}
function prim_prim_type($name, $type) {
	return prim_type(
		$name,
		$type,
		function($v) use ($name) { return "val_check($v, {$name})"; },
		function($v) use ($name) { return "val_get_{$name}($v)"; },
		function($v) use ($name) { return "alloc_{$name}($v)"; }
	);
}
function func($retval, $name, $args) { return new BindFunction($retval, $name, $args); }
function arg($type, $name) { return new BindArgument($type, $name); }
